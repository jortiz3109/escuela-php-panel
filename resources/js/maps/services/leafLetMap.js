import L from 'leaflet'

class LeafLetMap {

    render = (LatLng) => {
        const map = L.map('map').setView([ LatLng.lat, LatLng.lng ], 13)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map)
        L.marker().setLatLng([ LatLng.lat, LatLng.lng ]).addTo(map)
    }
}

export default new LeafLetMap()
