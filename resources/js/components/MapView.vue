<template>
    <div id="map" class="is-full"></div>
</template>

<script>
import Map from '../maps/mapService'
import GeoIP from '../maps/services/GeoIP'

export default {
    name: 'MapView',
    props: {
        ip: {
            type: String,
            default: null
        }
    },
    methods: {
        getCoords(ip) {
            GeoIP.getLocation(ip).then(res => {
                const  lat = res.data.latitude
                const long = res.data.longitude
                Map.renderMap({lat: lat, lng: long})
            }).catch(e => {
                const  lat = 4.644267
                const long = -74.1088087
                Map.renderMap({lat: lat, lng: long})
            })
        }
    },
    async mounted() {
        await this.getCoords(this.ip)
    }
}
</script>
