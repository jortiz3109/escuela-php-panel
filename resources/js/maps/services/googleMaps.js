import { Loader } from '@googlemaps/js-api-loader'

class GoogleMap {

    loadMaps() {
        const loader = new Loader({
            apiKey: process.env.MIX_MAP_API_KEY,
            version: "weekly",
        });
        return loader.load()
    }

    render = (LatLng) => {
        this.loadMaps().then(() => {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: LatLng,
                zoom: 8,
            });
            new google.maps.Marker({
                position: LatLng,
                map,
            });
        })
    }
}

export default new GoogleMap()



