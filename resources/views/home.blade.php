<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Njajal Leaflet</title>
    <link rel="stylesheet" href="{{ asset('node_modules/leaflet/dist/leaflet.css') }}" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map { height: 180px; }
    </style>
</head>
<body>
<div x-data="startFunction()">
    <img src="{{ $mapImage }}" alt="" width="50px">
    <div id="map">
    </div>
</div>
{{ $mapImage }}

<script defer src="{{ asset('node_modules/alpinejs/dist/cdn.min.js') }}"></script>
<script src="{{ asset('node_modules/leaflet/dist/leaflet.js') }}"></script>
<script>

    const startFunction = function () {
        return {
            init () {
                var map = L.map('map', {
                    crs: L.CRS.Simple
                });

                var bounds = [[0,0], [1000,1000]];
                 var image = L.imageOverlay('{{ $mapImage }}', bounds, {
                    crossOrigin: false
                 }).addTo(map);
                //var image = L.imageOverlay('{{ asset("images/contoh.png") }}', bounds).addTo(map);
                map.fitBounds(bounds);
            },
        };
    }
</script>
</body>
</html>
