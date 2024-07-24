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
    <style>
        #map { width:100%; height: 400px; }
    </style>
</head>
<body>
<div x-data="startFunction()">
    <div id="map">
    </div>
</div>

<script defer src="{{ asset('node_modules/alpinejs/dist/cdn.min.js') }}"></script>
{{-- <script src="{{ asset('node_modules/leaflet/dist/leaflet.js') }}"></script> --}}

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="{{ asset('node_modules/@ansur/leaflet-pulse-icon/dist/L.Icon.Pulse.js') }}"></script>
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

	const map = L.map('map', { minZoom: 0, });
	L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
		attribution: '&copy; <a href="http://www.example.com/">Example</a>',
		maxNativeZoom:19,
        maxZoom:25
	}).addTo(map);

    var pulsingIcon = L.icon.pulse({iconSize:[20,20],color:'red'});
    var marker = L.marker([-7.267698877124566, 112.7588251233101],{icon: pulsingIcon}).addTo(map);

    map.setView([-7.26764, 112.75861], 19);

    map.on('click', onMapClick);

	const line = new HighlightablePolyline([[-7.267698877124566, 112.7588251233101], [-7.267696216464638, 112.75847107172014]], {
        color: "#0000ff",
        weight: 10,
        dashArray: "0 16"
    }).addTo(map);

    //map.eachLayer((layer) => {
    //    layer.remove();
    //`});

    function onMapClick (e) {
        console.log(e.latlng)
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
