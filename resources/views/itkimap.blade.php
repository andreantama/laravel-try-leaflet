<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PETA ITKI</title>
    <link rel="stylesheet" href="{{ asset('node_modules/leaflet/dist/leaflet.css') }}"/>
    <style>
        #map { width:50%; height: 1000px; }
    </style>
</head>
<body>
    <div x-data="startFunction()">
        <div id="map"></div>
    </div>
    <script defer src="{{ asset('node_modules/alpinejs/dist/cdn.min.js') }}"></script>
    <script src="{{ asset('node_modules/leaflet/dist/leaflet.js') }}"></script>
    <script>
        const startFunction = function () {
            return {
                init () {
                    var map = L.map('map', {
                        crs: L.CRS.Simple
                    });

                    var bounds = [[0,0], [350,350]];
                    var image = L.imageOverlay('{{ $mapImage2 }}', bounds).addTo(map);
                    //var image = L.imageOverlay('{{ asset("images/contoh.png") }}', bounds).addTo(map);
                    map.fitBounds(bounds);
                }
            }
        }
    </script>
</body>
</html>
