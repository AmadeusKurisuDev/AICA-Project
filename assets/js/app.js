var map = L.map('map').setView([42.30031812670491, 12.412028984726453], 50);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.aicanet.it/">AICA</a>'
}).addTo(map);

L.marker([42.30031812670491, 12.412028984726453]).addTo(map)
    .bindPopup('ITT "U. Siffredi ;D"')
    .openPopup();


