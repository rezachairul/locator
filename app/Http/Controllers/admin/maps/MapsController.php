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
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|max:2097152', // 2GB, satuannya KB
        ]);

        $file = $request->file('file');
        $ext = strtolower($file->getClientOriginalExtension());

        // Tentukan type file
        $type = match ($ext) {
            'ecw' => 'ecw',
            'mbtiles' => 'mbtiles',
            default => null,
        };

        if (!$type) {
            return back()->withErrors(['file' => 'File harus bertipe .ecw atau .mbtiles']);
        }

         // === AUTO-REPLACE LOGIC START ===
        $latestMap = Maps::orderBy('created_at', 'desc')->first();
        if ($latestMap) {
            Storage::disk('public')->delete($latestMap->path);
            $latestMap->delete();
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/maps', $filename, 'public');

        $map = Maps::create([
            'name' => $request->name,
            'type' => $type,
            'filename' => $filename,
            'path' => $path,
            'size' => $file->getSize(),
        ]);
        // dd($map);

        return redirect()->route('admin.maps.index')->with('success', 'File uploaded and replaced successfully!');
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
        $maps = Maps::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|max:2097152', // sama seperti store, 2GB
        ]);

        $maps->name = $request->name;

        // Jika ada file baru diupload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = strtolower($file->getClientOriginalExtension());

            // Tentukan type file
            $type = match ($ext) {
                'ecw' => 'ecw',
                'mbtiles' => 'mbtiles',
                default => null,
            };

            if (!$type) {
                return back()->withErrors(['file' => 'File harus bertipe .ecw atau .mbtiles']);
            }

            // Hapus file lama jika ada
            if ($maps->path && Storage::disk('public')->exists($maps->path)) {
                Storage::disk('public')->delete($maps->path);
            }

            // Upload file baru
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/maps', $filename, 'public');

            // Update kolom terkait
            $maps->filename = $filename;
            $maps->path = $path;
            $maps->size = $file->getSize();
            $maps->type = $type;
        }

        $maps->save();

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
        $maps = Maps::findOrFail($id);
        Storage::disk('public')->delete($maps->path);
        
        $maps->delete();

        return redirect()->route('admin.maps.index')->with('success', 'Data and file deleted.');
    }

    
}
