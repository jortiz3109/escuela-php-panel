import GoogleMap from './services/googleMaps'
import LeafLetMap from './services/leafLetMap'

class Map {
    services = {
        google: GoogleMap,
        leaflet: LeafLetMap,
    }
    service = null

    constructor() {
        console.log(process.env.MIX_MAP_SERVICE)
        this.service = this.services[process.env.MIX_MAP_SERVICE] ?? LeafLetMap
    }

    renderMap = (LatLng) => {
        if (typeof this.service.render !== 'function') {
            throw new Error('Service has not render function')
        }

        this.service.render(LatLng)
    }
}

export default new Map()
