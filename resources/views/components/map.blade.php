<div id="map" style="height: 300px;"></div>

<!-- Leaflet CSS without integrity -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" crossorigin="anonymous" />

<!-- Leaflet JS without integrity -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" crossorigin="anonymous"></script>

<script>
    var map = L.map('map').setView([51.505, -0.09], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    function updateLatLngFields(lat, lng) {
        // Ensure that these inputs actually exist before trying to update them
        var latInput = document.querySelector('input[name="latitude"]');
        var lngInput = document.querySelector('input[name="longitude"]');
        
        if (latInput && lngInput) {
            latInput.value = lat;
            lngInput.value = lng;
        }
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
    var existingLat = document.querySelector('input[name="latitude"]')?.value;
    var existingLng = document.querySelector('input[name="longitude"]')?.value;

    if (existingLat && existingLng) {
        marker = L.marker([existingLat, existingLng]).addTo(map);
        map.setView([existingLat, existingLng], 12);
    }
</script>
