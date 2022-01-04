<template>
    <button type="button" class="button" @click="switchUserStatus" :class="buttonColor" :disabled="!emailVerified">
        <span>{{ isEnabled ? 'Enabled' : 'Disabled' }}</span>
        <b-icon
            v-if="!emailVerified"
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
        userId: { type: String, required: true },
        isEnabled: { type: String, required: true },
        emailVerified: { type: String, required: true }
    },
    computed: {
        buttonColor: function () {
            return this.isEnabled ? 'is-success' : 'is-danger'
        }
    },
    methods: {
        switchUserStatus: async function () {
            if (!this.$props.emailVerified) return;
            const response = await axios.get(`${this.$props.url}/api/toggle-user-status/${this.$props.userId}`);
            this.isEnabled = !!response.data.enabled_at;
        }
    }
}
</script>
