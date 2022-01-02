import GoogleMap from './services/googleMaps'
import LeafLetMap from './services/leafLetMap'

class Map {
    services = {
        google: GoogleMap,
        leaflet: LeafLetMap,
    }
    service = null

    constructor() {
        this.service = this.services[process.env.MIX_MAP_SERVICE] ?? LeafLetMap
    }

    renderMap = (LatLng) => {
        if (typeof this.service.render === 'function') {
            this.service.render(LatLng)
        } else {
            throw new Error('Service has not render function')
        }
    }
}

export default new Map()
