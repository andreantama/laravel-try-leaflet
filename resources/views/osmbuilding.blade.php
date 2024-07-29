 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Njajal Leaflet</title>
    {{-- <link rel="stylesheet" href="{{ asset('node_modules/leaflet/dist/leaflet.css') }}"/> --}}

    <link href="https://cdn.osmbuildings.org/4.0.0/OSMBuildings.css" rel="stylesheet">
    <style>
        #map { width:100%; height: 900px; }
    </style>
</head>
<body>
<div x-data="startFunction()">
    <div id="map">
    </div>
</div>

<script defer src="{{ asset('node_modules/alpinejs/dist/cdn.min.js') }}"></script>
{{-- <script src="{{ asset('node_modules/leaflet/dist/leaflet.js') }}"></script> --}}

 <script src="https://cdn.osmbuildings.org/4.0.0/OSMBuildings.js"></script>
{{-- <script src="{{ asset('node_modules/osmbuildings/dist/OSMBuildings-Leaflet.js') }}"></script> --}}
{{-- <script src="{{ asset('node_modules/leaflet-highlightable-layers/dist/L.HighlightableLayers.js') }}"></script> --}}
{{-- "leaflet-highlightable-layers": "https://esm.sh/leaflet-highlightable-layers" --}}

<script>

var osmb = new OSMBuildings({
                container: 'map',
                position: { latitude: -7.267698877124566, longitude: 112.7588251233101 },
                zoom: 16,
                minZoom: 15,
                maxZoom: 22
            });

            osmb.addMapTiles(
                "http://{s}.tile.osm.org/{z}/{x}/{y}.png",
                {
                attribution: '© Data <a href="http://openstreetmap.org/copyright/">OpenStreetMap</a> · © Map <a href="http://mapbox.com">Mapbox</a>'
                }
            );

            osmb.addGeoJSONTiles('http://{s}.data.osmbuildings.org/0.2/anonymous/tile/{z}/{x}/{y}.json');

const startFunction = function () {
    return {
        init () {

        },


    };
}
</script>
