<template>
    <div class="container-fluid">
        <div id="map" class="is-full" v-if="!mapError"></div>
        <div class="container has-text-centered" v-else>
            <img id="map-error" :src="'/img/mapError.png'" alt="Error while rendering map">
        </div>
    </div>
</template>

<script>
import Map from '../maps/map'

export default {
    name: 'PMapView',
    props: {
        lat: {
            type: Number,
            required: true
        },
        lng: {
            type: Number,
            required: true
        }
    },
    data: () => {
        return {
            mapError: false,
        }
    },
    methods: {
        renderMap() {
            Map.renderMap({lat: this.lat, lng: this.lng})
        },
    },
    mounted() {
        try {
            this.renderMap()
        } catch (e) {
            console.log(e)
            this.mapError = true
        }
    },
}
</script>
