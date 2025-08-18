<?php

namespace App\Http\Controllers\admin\maps;

use App\Models\Maps;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use PDO;

class MapsController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Maps';
        $search = $request->input('search', '');
        $keywords = !empty($search) ? preg_split('/\s+/', $search) : [];

        $maps = Maps::when($search, function ($query) use ($keywords) {
                foreach ($keywords as $word) {
                    $query->where(function ($q) use ($word) {
                        $q->where('name', 'ILIKE', "%{$word}%")
                          ->orWhere('type', 'ILIKE', "%{$word}%")
                          ->orWhere('filename', 'ILIKE', "%{$word}%");
                    });
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.maps.maps', compact('title', 'maps', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file_maps' => 'required|file|max:102400', // 100MB
            'file_point' => 'nullable|file|max:102400',
        ]);

        // ==== FILE MAPS ====
        $fileMaps = $request->file('file_maps');
        $extMaps = strtolower($fileMaps->getClientOriginalExtension());
        $typeMaps = match($extMaps) {
            'ecw' => 'ecw',
            'mbtiles' => 'mbtiles',
            'tif', 'tiff' => 'tiff',
            default => null,
        };
        if (!$typeMaps) {
            return back()->withErrors(['file_maps' => 'File Maps harus bertipe .ecw, .mbtiles, .tif, atau .tiff']);
        }

        $filenameMaps = time().'_'.$fileMaps->getClientOriginalName();
        $pathMaps = $fileMaps->storeAs('uploads/maps', $filenameMaps, 'public');

        // ==== FILE POINT (optional) ====
        $filenamePoint = null;
        $pathPoint = null;
        if ($request->hasFile('file_point')) {
            $filePoint = $request->file('file_point');
            $extPoint = strtolower($filePoint->getClientOriginalExtension());
            if (!in_array($extPoint, ['json','geojson'])) {
                return back()->withErrors(['file_point' => 'File Points harus JSON / GeoJSON']);
            }

            $filenamePoint = time().'_'.$filePoint->getClientOriginalName();
            $pathPoint = $filePoint->storeAs('uploads/points', $filenamePoint, 'public');
        }

        // ==== CREATE MAP RECORD ====
        Maps::create([
            'name' => $request->name,
            'type' => $typeMaps,
            'filename' => $filenameMaps,
            'path' => $pathMaps,
            'size' => $fileMaps->getSize(),
            'point_filename' => $filenamePoint,
            'point_path' => $pathPoint,
        ]);

        return redirect()->route('admin.maps.index')->with('success', 'File uploaded successfully!');
    }

    public function show($id)
    {
        $maps = Maps::findOrFail($id);
        if ($maps->type === 'mbtiles') {
            return $this->readMbtiles($maps);
        }

        if($maps->type === 'ecw') {
            // Handle ECW file display logic here if needed
            return response()->json(['message' => 'ECW file handling not implemented yet.'], 501);
        }

        return response()->json(['error' => 'Unsupported map type.'], 400);

    }

     public function update(Request $request, $id)
    {
        $map = Maps::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'file_maps' => 'nullable|file|max:102400',
            'file_point' => 'nullable|file|max:102400',
        ]);

        $map->name = $request->name;

        // ==== FILE MAPS ====
        if ($request->hasFile('file_maps')) {
            $fileMaps = $request->file('file_maps');
            $extMaps = strtolower($fileMaps->getClientOriginalExtension());
            $typeMaps = match($extMaps) {
                'ecw' => 'ecw',
                'mbtiles' => 'mbtiles',
                'tif', 'tiff' => 'tiff',
                default => null,
            };
            if (!$typeMaps) {
                return back()->withErrors(['file_maps' => 'File Maps harus bertipe .ecw, .mbtiles, .tif, atau .tiff']);
            }

            // Hapus file lama
            if ($map->path && Storage::disk('public')->exists($map->path)) {
                Storage::disk('public')->delete($map->path);
            }

            $filenameMaps = time().'_'.$fileMaps->getClientOriginalName();
            $pathMaps = $fileMaps->storeAs('uploads/maps', $filenameMaps, 'public');

            $map->filename = $filenameMaps;
            $map->path = $pathMaps;
            $map->size = $fileMaps->getSize();
            $map->type = $typeMaps;
        }

        // ==== FILE POINT ====
        if ($request->hasFile('file_point')) {
            $filePoint = $request->file('file_point');
            $extPoint = strtolower($filePoint->getClientOriginalExtension());
            if (!in_array($extPoint, ['json','geojson'])) {
                return back()->withErrors(['file_point' => 'File Points harus JSON / GeoJSON']);
            }

            // Hapus file lama
            if ($map->point_path && Storage::disk('public')->exists($map->point_path)) {
                Storage::disk('public')->delete($map->point_path);
            }

            $filenamePoint = time().'_'.$filePoint->getClientOriginalName();
            $pathPoint = $filePoint->storeAs('uploads/points', $filenamePoint, 'public');

            $map->point_filename = $filenamePoint;
            $map->point_path = $pathPoint;
        }

        $map->save();

        return redirect()->route('admin.maps.index')->with('success', 'Data updated successfully!');
    }

    private function readMbtiles(Maps $map)
    {
        $filePath = storage_path('app/public/' . $map->path);

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        try {
            $pdo = new PDO('sqlite:' . $filePath);
            $stmt = $pdo->query('SELECT name, value FROM metadata');
            $metadata = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return response()->json(['metadata' => $metadata]);
        } catch (\PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getTile($id, $z, $x, $y)
    {
        $map = Maps::findOrFail($id);
        $filePath = storage_path('app/public/' . $map->path);

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        try {
            $pdo = new PDO('sqlite:' . $filePath);
            $tmsY = (1 << $z) - 1 - $y;

            $stmt = $pdo->prepare('SELECT tile_data FROM tiles WHERE zoom_level = ? AND tile_column = ? AND tile_row = ? LIMIT 1');
            $stmt->execute([$z, $x, $tmsY]);
            $tile = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($tile && isset($tile['tile_data'])) {
                return response($tile['tile_data'], 200)->header('Content-Type', 'image/png');
            } else {
                return response(null, 204);
            }
        } catch (\PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $map = Maps::findOrFail($id);

        // Hapus file maps
        if ($map->path && Storage::disk('public')->exists($map->path)) {
            Storage::disk('public')->delete($map->path);
        }

        // Hapus file point
        if ($map->point_path && Storage::disk('public')->exists($map->point_path)) {
            Storage::disk('public')->delete($map->point_path);
        }

        $map->delete();

        return redirect()->route('admin.maps.index')->with('success', 'Data and file deleted.');
    }

    
}
