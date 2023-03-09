var map = L.map('map').setView([42.30031812670491, 12.412028984726453], 50);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.aicanet.it/">AICA</a>'
}).addTo(map);

var greenIcon = L.icon({
    iconUrl: 'leaf-green.png',

    iconSize:     [38, 95], // size of the icon
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

L.marker([42.30031812670491, 12.412028984726453]).addTo(map)
    .bindPopup('ITT "U. Midossi"')
    .openPopup();
