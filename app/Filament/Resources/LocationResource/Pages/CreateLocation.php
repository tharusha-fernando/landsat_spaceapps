<?php

namespace App\Filament\Resources\LocationResource\Pages;

use App\Filament\Resources\LocationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLocation extends CreateRecord
{
    protected static string $resource = LocationResource::class;

    protected function getFooter(): string
    {
        return '
            <script>
                var map = L.map("map").setView([51.505, -0.09], 2);

                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution: "&copy; OpenStreetMap contributors"
                }).addTo(map);

                var marker;

                function updateLatLngFields(lat, lng) {
                    document.querySelector(\'input[name="latitude"]\').value = lat;
                    document.querySelector(\'input[name="longitude"]\').value = lng;
                }

                map.on("click", function(e) {
                    var lat = e.latlng.lat;
                    var lng = e.latlng.lng;

                    if (marker) {
                        map.removeLayer(marker);
                    }

                    marker = L.marker([lat, lng]).addTo(map);
                    updateLatLngFields(lat, lng);
                });

                // Set default marker if lat/long already exist
                var existingLat = document.querySelector(\'input[name="latitude"]\').value;
                var existingLng = document.querySelector(\'input[name="longitude"]\').value;

                if (existingLat && existingLng) {
                    marker = L.marker([existingLat, existingLng]).addTo(map);
                    map.setView([existingLat, existingLng], 12);
                }
            </script>
        ';
    }
}
