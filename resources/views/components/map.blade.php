<div id="map" style="height: 300px;"></div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"  crossorigin="anonymous" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"  crossorigin="anonymous"></script>
{{-- integrity="sha384-JxhK+SkSAfJYagLfihyJbG1Jp1wsPHLzlmrn/TXjqR6M5EGhB74xmrElnElw58Vw" --}}
{{-- integrity="sha384-xodZBNTC5n17Xt2mL7bI5IQ9JIZQ5gpT0OTXKTgF5r6o3CzrNlTXEj+rUMqqvMkg" --}}
{{-- integrity="sha384-xodZBNTC5n17Xt2mL7bI5IQ9JIZQ5gpT0OTXKTgF5r6o3CzrNlTXEj+rUMqqvMkg" --}}
{{-- integrity="sha384-xodZBNTC5n17Xt2mL7bI5IQ9JIZQ5gpT0OTXKTgF5r6o3CzrNlTXEj+rUMqqvMkg" --}}

<script>
    var map = L.map('map').setView([51.505, -0.09], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    function updateLatLngFields(lat, lng) {
        document.querySelector('input[name="latitude"]').value = lat;
        document.querySelector('input[name="longitude"]').value = lng;
    }

    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);
        updateLatLngFields(lat, lng);
    });

    // Set default marker if lat/long already exist
    var existingLat = document.querySelector('input[name="latitude"]').value;
    var existingLng = document.querySelector('input[name="longitude"]').value;

    if (existingLat && existingLng) {
        marker = L.marker([existingLat, existingLng]).addTo(map);
        map.setView([existingLat, existingLng], 12);
    }
</script
