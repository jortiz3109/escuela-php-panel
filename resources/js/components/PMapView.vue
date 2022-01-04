<template>
    <div class="container-fluid">
        <div id="map" class="is-full" v-if="!mapError"></div>
        <div class="container has-text-centered" v-else>
            <img id="map-error" :src="'/img/mapError.png'" alt="Map Error">
        </div>
    </div>
</template>

<script>
import Map from '../maps/map'
import GeoIP from '../maps/services/GeoIP'

export default {
    name: 'PMapView',
    props: {
        ip: {
            type: String,
            default: null,
            required: true
        },
    },
    data: () => {
        return {
            mapError: false,
        }
    },
    methods: {
        getCoords(ip) {
            GeoIP.getLocation(ip).then(res => {
                const lat = res.data.latitude
                const long = res.data.longitude
                Map.renderMap({lat: lat, lng: long})
            }).catch(() => {
                this.mapError = true
            })
        },
    },
    async mounted() {
        await this.getCoords(this.ip)
    },
}
</script>
