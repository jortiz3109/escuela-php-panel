<template>
    <button type="button" class="button" @click="switchUserStatus" :class="buttonColor" :disabled="!buttonEnabled">
        <span>{{ isEnabled ? 'Enabled' : 'Disabled' }}</span>
        <b-icon
            v-if="!buttonEnabled"
            icon="cancel"
            size="is-small">
        </b-icon>
        <b-icon
            v-else
            icon="account-switch-outline"
            size="is-small">
        </b-icon>
    </button>
</template>

<script>
import axios from 'axios';

export default {
    name: 'StatusButton',
    props: {
        url: { type: String, required: true },
        isEnabled: { type: String, required: true },
        buttonEnabled: { type: String, required: true }
    },
    computed: {
        buttonColor: function () {
            return this.isEnabled ? 'is-success' : 'is-danger'
        }
    },
    methods: {
        switchUserStatus: async function () {
            if (!this.buttonEnabled) return;
            const response = await axios.patch(`${this.url}`);
            this.isEnabled = !!response.data.enabled_at;
        }
    }
}
</script>
