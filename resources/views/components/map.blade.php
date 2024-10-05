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
        // Use Livewire to set the values dynamically
        @this.set('data.latitude', lat);
        @this.set('data.longitude', lng);
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
    var existingLat = @this.get('data.latitude');
    var existingLng = @this.get('data.longitude');

    if (existingLat && existingLng) {
        marker = L.marker([existingLat, existingLng]).addTo(map);
        map.setView([existingLat, existingLng], 12);
    }
</script>
