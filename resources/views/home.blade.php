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

            // Data koordinat yang sama untuk semua marker
                var sharedCoordinates = [366, 117];

                for(var i = 0; i <= 3; i++) {
                    var sol = L.latLng(this.getCoordinatesAroundDistance(sharedCoordinates[0] + i, sharedCoordinates[1] + i, 10000));
                    console.log(sol);
                    var marker1 = L.marker(sol, {
                        riseOnHover : true
                    }).bindPopup("Marker "+i).addTo(map);
                }

                //map.removeLayer(marker1);


                map.on('click', this.onMapClick);
            },

            getCoordinatesAroundDistance(lat, lon, distance) {
                const earthRadius = 6371.0;
                const distanceInKm = distance / 1000.0;
                const angularDistance = distanceInKm / earthRadius;
                const latRad = (Math.PI / 180.0) * lat;
                const lonRad = (Math.PI / 180.0) * lon;
                const newLatRad = latRad + angularDistance;
                const newLonRad = lonRad + (angularDistance / Math.cos(latRad));
                const newLat = (180.0 / Math.PI) * newLatRad;
                const newLon = (180.0 / Math.PI) * newLonRad;
                return [newLat, newLon];
            },


            onMapClick(e) {
                console.log(e.latlng)
            }
        };
    }
</script>
</body>
</html>
