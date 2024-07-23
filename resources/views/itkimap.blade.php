<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PETA ITKI</title>
    <link rel="stylesheet" href="{{ asset('node_modules/leaflet/dist/leaflet.css') }}"/>
    <link rel="stylesheet" href="{{ asset('node_modules/leaflet-routing-machine/dist/leaflet-routing-machine.css') }}"/>
    <style>
        #map { width:50%; height: 1000px; }
    </style>
</head>
<body>
    <div x-data="startFunction()">
        <div id="map"></div>
        <button x-on:click="showRoute(0)">TEST</button>
        <button x-on:click="clearRoute()">Clear Route</button>
    </div>
    <script defer src="{{ asset('node_modules/alpinejs/dist/cdn.min.js') }}"></script>
    <script src="{{ asset('node_modules/leaflet/dist/leaflet.js') }}"></script>
    <script src="{{ asset('node_modules/leaflet-polylinedecorator/dist/leaflet.polylineDecorator.js') }}"></script>
    <script>
        const startFunction = function () {
            return {
                routes : [
                    [
                        L.latLng(100.00, 200.00),
                        L.latLng(100.00, 700.00)
                    ],
                    [
                        L.latLng(150, 250),
                        L.latLng(450, 550)
                    ],
                    // Tambahkan 8 rute lainnya
                    [
                        L.latLng(200, 300),
                        L.latLng(500, 600)
                    ],
                    [
                        L.latLng(250, 350),
                        L.latLng(550, 650)
                    ],
                    [
                        L.latLng(300, 400),
                        L.latLng(600, 700)
                    ],
                    [
                        L.latLng(350, 450),
                        L.latLng(650, 750)
                    ],
                    [
                        L.latLng(400, 500),
                        L.latLng(700, 800)
                    ],
                    [
                        L.latLng(450, 550),
                        L.latLng(750, 850)
                    ],
                    [
                        L.latLng(500, 600),
                        L.latLng(800, 900)
                    ],
                    [
                        L.latLng(550, 650),
                        L.latLng(850, 950)
                    ]
                ],
                control : null,
                map: null,

                routesPath : [
                    [334, 73], [327, 123], [270.25, 115.25], [269.5, 53]
                ],

                init () {
                    this.map = L.map('map', {
                        crs: L.CRS.Simple
                    });

                    var bounds = [[0,0], [350,350]];
                    var image = L.imageOverlay('{{ $mapImage2 }}', bounds).addTo(this.map);
                    //var image = L.imageOverlay('{{ asset("images/contoh.png") }}', bounds).addTo(map);
                    this.map.fitBounds(bounds);

                    this.map.on('click', this.onMapClick);



                },

                showRoute(routeIndex) {
                    var arrow = L.polyline(this.routesPath, {}).addTo(this.map);
                    var arrowHead = L.polylineDecorator(arrow, {
                        patterns: [
                            {offset: '100%', repeat: 1, symbol: L.Symbol.arrowHead({pixelSize: 15, polygon: false, pathOptions: {stroke: true}})}
                        ]
                    }).addTo(this.map);
                },

                clearRoute() {
                    this.routesPath = [];
                },

                onMapClick(e) {
                    console.log(e.latlng)
                }

            }
        }
    </script>
</body>
</html>
