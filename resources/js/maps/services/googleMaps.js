import {Loader} from '@googlemaps/js-api-loader'

class GoogleMap {

    loadMaps() {
        const loader = new Loader({
            apiKey: process.env.MIX_MAP_GOOGLE_API_KEY,
            version: 'weekly',
        })
        return loader.load()
    }

    render = (LatLng) => {
        this.loadMaps().then(() => {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: LatLng,
                zoom: process.env.MIX_DEFAULT_ZOOM_MAP ?? 13,
            })
            new google.maps.Marker({
                position: LatLng,
                map,
            })
        })
    }
}

export default new GoogleMap()



