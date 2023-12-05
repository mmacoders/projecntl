<div id="map"></div>
<script>
    const getLatitude = "{{ $presence->latitude }}";
    const getLongitude = "{{ $presence->longitude }}";
    
    const map = L.map('map').setView([getLatitude, getLongitude], 16);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    const marker = L.marker([getLatitude, getLongitude]).addTo(map);
    marker.bindPopup("{{ $presence->fullname }}").openPopup();
</script>