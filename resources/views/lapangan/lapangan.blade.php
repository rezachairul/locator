<x-operator.layouts
    :title="$title"
    :totalExca="$totalExca"
    :totalDumping="$totalDumping"
    :latestWeather="$latestWeather"
    :latestWaterDepth="$latestWaterDepth"
>
    <!-- Maps -->
    <div class="min-w-0 p-4 h-full text-white bg-white shadow-xs dark:bg-gray-800">
        <div id="mbtiles-map" class="w-full h-full shadow-xs z-0 relative"></div>
    </div>
    <script>
        // Initialize map for MBTiles only (no baselayer)
        var mbtilesMap = L.map('mbtiles-map');

        // === BASELAYERS ===
        var street = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        });

        var satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles © Esri'
        }).addTo(mbtilesMap); // set default;

        var terrain = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenTopoMap'
        });

        // === MBTILES LAYER ===
        var firstMapId = "{{ $firstMapId }}";
        var mbtilesLayer;

        if (firstMapId) {
            fetch('/operator/maps/' + firstMapId)
                .then(response => response.json())
                .then(data => {
                    if (data.metadata) {
                        var bounds, minZoom, maxZoom;

                        const boundsMeta = data.metadata.find(m => m.name === 'bounds');
                        if (boundsMeta) {
                            const b = boundsMeta.value.split(',').map(parseFloat);
                            bounds = [[b[1], b[0]], [b[3], b[2]]];
                        }

                        const minZoomMeta = data.metadata.find(m => m.name === 'minzoom');
                        if (minZoomMeta) minZoom = parseInt(minZoomMeta.value);

                        const maxZoomMeta = data.metadata.find(m => m.name === 'maxzoom');
                        if (maxZoomMeta) maxZoom = parseInt(maxZoomMeta.value);

                        mbtilesLayer = L.tileLayer('/operator/maps/tiles/' + firstMapId + '/{z}/{x}/{y}', {
                            minZoom: minZoom || 0,
                            maxZoom: maxZoom || 18,
                            tileSize: 256,
                            attribution: 'MBTiles Layer'
                        }).addTo(mbtilesMap);

                        // Setelah mbtilesLayer dibuat
                        overlayMaps["MBTiles Layer"] = mbtilesLayer;
                        layerControl.addOverlay(mbtilesLayer, "MBTiles Layer");

                        if (bounds) {
                            var mbtilesBorder = L.rectangle(bounds, {
                                color: "red",
                                weight: 2,
                                fill: false
                            }).addTo(mbtilesMap);
                            mbtilesMap.fitBounds(bounds);
                            if (minZoom && mbtilesMap.getZoom() < minZoom) {
                                mbtilesMap.setZoom(minZoom);
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error("Error fetching metadata:", error);
                });
        }
        // === LAYER CONTROL ===
        var baseMaps = {
            "Street": street,
            "Satellite": satellite,
            "Terrain": terrain
        };

        var overlayMaps = {};

        if (mbtilesLayer) {
            overlayMaps["MBTiles Layer"] = mbtilesLayer;
        }

        // Layer control with MBTiles overlay (will populate after fetch)
        var layerControl = L.control.layers(baseMaps, overlayMaps, { collapsed: true }).addTo(mbtilesMap);

    </script>
</x-operator.layouts>
