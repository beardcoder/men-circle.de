import './Detail.entry.css';
import 'leaflet/dist/leaflet.css';

const mapEle = document.getElementById('map');
if (mapEle) {
  //@ts-ignore
  import('leaflet').then((L) => {
    const map = L.map('map', {
      zoomControl: false,
      scrollWheelZoom: false,
      gestureHandling: true,
    }).setView([mapEle.dataset.lat, mapEle.dataset.long], 100);

    const greenIcon = L.icon({
      iconUrl:
        'data:image/svg+xml,%3Csvg xmlns="http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg" width="24" height="24" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="9.5" r="1.5" fill="%23008478"%2F%3E%3Cpath fill="%23008478" d="M12 2a8 8 0 0 0-8 7.92c0 5.48 7.05 11.58 7.35 11.84a1 1 0 0 0 1.3 0C13 21.5 20 15.4 20 9.92A8 8 0 0 0 12 2m0 11a3.5 3.5 0 1 1 3.5-3.5A3.5 3.5 0 0 1 12 13"%2F%3E%3C%2Fsvg%3E',
      iconSize: [40, 40],
      iconAnchor: [0, 0],
      popupAnchor: [20, 0],
    });

    const marker = L.marker([mapEle.dataset.lat, mapEle.dataset.long], {
      icon: greenIcon,
    }).addTo(map);

    marker.bindPopup(mapEle.dataset.popup).openPopup();

    L.tileLayer(
      'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.svg',
      {
        attribution: '©OpenStreetMap, ©CartoDB',
      },
    ).addTo(map);
  });
}
