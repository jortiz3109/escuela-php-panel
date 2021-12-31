import GoogleMap from './services/googleMaps'
import LeafLetMap from './services/leafLetMap'

class Map {
    services = {
        google: GoogleMap,
        leaflet: LeafLetMap
    }
    service = null

    constructor() {
        this.service = this.services[process.env.MIX_MAP_SERVICE]
    }

    renderMap = (LatLng) => {
        this.service.render(LatLng)
    }
}

export default new Map()
