document.addEventListener('DOMContentLoaded', () => {
  const mapElement = document.getElementById('requestMap');
  if (!mapElement || typeof L === 'undefined') return;
  const latInput = document.getElementById('latitud');
  const lngInput = document.getElementById('longitud');
  const status = document.getElementById('mapStatus');
  const center = [Number(mapElement.dataset.lat || 3.4516), Number(mapElement.dataset.lng || -76.5320)];
  const map = L.map(mapElement).setView(center, 12);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19, attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);
  let marker = null;
  const setPoint = (lat, lng) => {
    latInput.value = Number(lat).toFixed(7);
    lngInput.value = Number(lng).toFixed(7);
    if (marker) marker.setLatLng([lat, lng]); else marker = L.marker([lat, lng]).addTo(map);
    status.textContent = `Ubicación seleccionada: ${latInput.value}, ${lngInput.value}`;
  };
  map.on('click', e => setPoint(e.latlng.lat, e.latlng.lng));
  if (latInput.value && lngInput.value) {
    const lat = Number(latInput.value), lng = Number(lngInput.value);
    if (Number.isFinite(lat) && Number.isFinite(lng)) { setPoint(lat, lng); map.setView([lat, lng], 16); }
  }
  const locate = document.getElementById('locateMe');
  if (locate) locate.addEventListener('click', () => {
    if (!navigator.geolocation) { status.textContent = 'Este navegador no permite geolocalización.'; return; }
    status.textContent = 'Solicitando ubicación al navegador…';
    navigator.geolocation.getCurrentPosition(pos => {
      const { latitude, longitude } = pos.coords;
      map.setView([latitude, longitude], 17); setPoint(latitude, longitude);
    }, () => { status.textContent = 'No fue posible obtener la ubicación. Puedes marcarla haciendo clic en el mapa.'; }, { enableHighAccuracy: true, timeout: 10000 });
  });
});
