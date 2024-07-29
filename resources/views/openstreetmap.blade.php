<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Njajal Leaflet</title>
    {{-- <link rel="stylesheet" href="{{ asset('node_modules/leaflet/dist/leaflet.css') }}"/> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <link rel="stylesheet" href="{{ asset('node_modules/@ansur/leaflet-pulse-icon/dist/L.Icon.Pulse.css') }}">
    <link href="https://cdn.osmbuildings.org/4.0.0/OSMBuildings.css" rel="stylesheet">
    <style>
        #map { width:100%; height: 900px; }
    </style>
</head>
<body>
<div x-data="startFunction()">
    <div id="map">
    </div>
    <div class="contohdiv">
        <button onClick="ShowBackground()">Tampil Background</button>
        <button onClick="window.HideBackground()">Hide Background</button>
    </div>
</div>

<script defer src="{{ asset('node_modules/alpinejs/dist/cdn.min.js') }}"></script>
{{-- <script src="{{ asset('node_modules/leaflet/dist/leaflet.js') }}"></script> --}}

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="{{ asset('node_modules/@ansur/leaflet-pulse-icon/dist/L.Icon.Pulse.js') }}"></script>
 {{-- <script src="https://cdn.osmbuildings.org/4.0.0/OSMBuildings.js"></script> --}}
<script src="{{ asset('node_modules/osmbuildings/dist/OSMBuildings-Leaflet.js') }}"></script>
{{-- <script src="{{ asset('node_modules/leaflet-highlightable-layers/dist/L.HighlightableLayers.js') }}"></script> --}}
{{-- "leaflet-highlightable-layers": "https://esm.sh/leaflet-highlightable-layers" --}}
<script type="importmap">
	{
		"imports": {
			"leaflet": "https://esm.sh/leaflet",
			"leaflet-highlightable-layers": "{{ asset('node_modules/leaflet-highlightable-layers/dist/L.HighlightableLayers.js') }}",
            "@ansur/leaflet-pulse-icon": "{{ asset('node_modules/@ansur/leaflet-pulse-icon/dist/L.Icon.Pulse.js') }}"
		}
	}
</script>
<script type="module">
	import L from "leaflet";
    import "@ansur/leaflet-pulse-icon";
	import { HighlightablePolyline } from "leaflet-highlightable-layers";

    let locationTitik = [];
	const map = L.map('map', { minZoom: 0 });
    // Kumpulan Layer Group


	L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
		attribution: '&copy; <a href="http://www.example.com/">Example</a>',
		maxNativeZoom:19,
        maxZoom:25
	}).addTo(map);


    var markersGroup = L.layerGroup().addTo(map);
    var backgroudGroup = L.layerGroup().addTo(map);
    var BuildingsGroup = L.layerGroup().addTo(map);
    var RoutesGroup = L.layerGroup().addTo(map);


    var pulsingIcon = L.icon.pulse({iconSize:[20,20],color:'red'});
    var marker = L.marker([-7.267698877124566, 112.7588251233101],{icon: pulsingIcon}).addTo(map);

    map.setView([-7.26764, 112.75861], 19);
    //[-7.26597210551155, 112.75694757699969], [-7.26624, 112.76058], [-7.27048, 112.76050], [-7.270339574343977, 112.75656871497632]
    var imageUrl = "{{ asset('images/background.jpg') }}",

    imageBounds = [[-7.265921552775756, 112.75710046291353], [-7.265969112257622, 112.75966197252275], [-7.266549470564387, 112.75964587926866]];
    L.imageOverlay(imageUrl, imageBounds).addTo(backgroudGroup);

    var geojsonDataBuildings = {
        "type": "FeatureCollection",
        "features": [{
            "type": "Feature",
            "id": 134,
            "geometry": {
            "type": "Polygon",
            "coordinates": [[
                [112.75825632736088, -7.267323058752204],
                [112.75840904563668, -7.26732522054021],
                [112.75840854272248, -7.267401880861663],
                [112.75825599208476, -7.267398388743191],
                [112.75825632736088, -7.267323058752204],
            ]]
            },
            "properties": {
                "label" : "Gedung A",
                "coordinatelabel": [112.75832413739339, -7.267379597819473],
                "color": "rgb(255,0,0)",
                //"wallColor": "rgb(255,0,0)",
                "roofColor": "rgb(255,128,0)",
                "height": 2,
                "minHeight": 0
            }
        }]
    };

    var osmb = new OSMBuildings(BuildingsGroup).set(geojsonDataBuildings);
    // Definisikan data GeoJSON
    var geojsonRoutes = {
        "type": "FeatureCollection",
        "features": [
            {
                "type": "Feature",
                "geometry": {
                    "type": "LineString",
                    "coordinates": [
                        [112.75845359342502, -7.2676925580572],
                        [112.7584816940823, -7.266554126731154],
                        [112.75884716077508, -7.2665567873978505]
                    ]
                },
                "properties": {
                    "name": "LineString Example",
                }
            },
        ]
    };

    L.geoJSON(geojsonRoutes, {
        style: style
    }).addTo(RoutesGroup);

    map.on('click', onMapClickLine);
    // Tambah event listener untuk perubahan zoom
    map.on('zoomend', updateMarkers);

    function ShowBackground() {
        map.addLayer(backgroudGroup);
    }
    window.ShowBackground = ShowBackground;

    function HideBackground() {
        //console.log("HHide Background");
        map.removeLayer(backgroudGroup);
    }
    window.HideBackground = HideBackground;

    function updateMarkers() {
        var zoomLevel = map.getZoom();
        console.log(zoomLevel);

        if (zoomLevel >= 20) {
            geojsonDataBuildings.features.forEach(function (label) {
                console.log(label.properties.label);
                const centroid = [label.properties.coordinatelabel[1], label.properties.coordinatelabel[0]];
                const marker = L.marker(centroid, {
                    icon: L.divIcon({
                        className: 'city-label',
                        html: "<div class='city-info'><strong>"+label.properties.label+"</strong></div>",
                        iconSize: [100, 10], // Set the size of the icon
                        iconAnchor: [15, 25], // Set the anchor point of the icon
                    })
                }).addTo(markersGroup);
            })
        } else {
            // Hapus semua marker jika level zoom < 18
            markersGroup.clearLayers();
        }
    }


    function style(feature) {
        return {
            color: "#eaeaea",  // Warna garis
            weight: 10,  // Ketebalan garis berdasarkan properti 'width'
            opacity: 1         // Transparansi garis (1 berarti tidak transparan)
        };
    }

    //map.eachLayer((layer) => {
    //    layer.remove();
    //`});

    function onMapClick(e) {
        let lokasi = [e.latlng.lat, e.latlng.lng];
        locationTitik.push(lokasi);
         // create a red polyline from an array of LatLng points
        var latlngs = locationTitik;

        var polygon = L.polygon(latlngs, {color: '#fff'}).addTo(map);

        // zoom the map to the polygon
        map.fitBounds(polygon.getBounds());
    }

    function onMapClickLine (e) {
        console.log(e.latlng)
        /*let lokasi = [e.latlng.lat, e.latlng.lng];
        locationTitik.push(lokasi);
        //console.log(locationTitik);
        const line = new HighlightablePolyline(locationTitik, {
            color: "#0000ff",
            weight: 10,
            dashArray: "0 16"
        }).addTo(map);*/
    }
</script>
<script>


const startFunction = function () {
    return {
        init () {
            /*var map = L.map('map', {
                minZoom: 0,
            });

            L.tileLayer('', {

                maxNativeZoom:19,
                maxZoom:25
            }).addTo(map);

            map.setView([-7.26764, 112.75861], 19);

            map.on('click', this.onMapClick);*/
        },


    };
}
</script>
