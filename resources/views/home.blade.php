<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Njajal Leaflet</title>
    <link rel="stylesheet" href="{{ asset('node_modules/leaflet/dist/leaflet.css') }}"/>
    <style>
        #map { height: 580px; }
    </style>
</head>
<body>
<div x-data="startFunction()">
    <div id="map">
    </div>
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

                var bounds = [[0,0], [1000,1000]];
                 var image = L.imageOverlay('{{ $mapImage }}', bounds).addTo(map);
                //var image = L.imageOverlay('{{ asset("images/contoh.png") }}', bounds).addTo(map);
                map.fitBounds(bounds);

                var sol = L.latLng([ 366, 117 ]);
                
                for(var i = 0; i <= 1; i++) {

                    var marker1 = L.circle(sol, {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 50
}).bindPopup("Marker "+i).addTo(map);
                }

                //map.removeLayer(marker1);


                map.on('click', this.onMapClick);
            },

            onMapClick(e) {
                console.log(e.latlng)
            }
        };
    }
</script>
</body>
</html>
