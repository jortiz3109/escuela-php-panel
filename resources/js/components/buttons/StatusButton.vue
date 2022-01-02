<template>
    <button class="button" @click="switchUserStatus" :class="isEnabled ? 'is-success' : 'is-danger'">
        <span class="text-red-500">{{ isEnabled ? 'Enabled' : 'Disabled' }}</span>
        <b-icon
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
        isEnabled: { type: Boolean, required: true },
        emailVerified: { type: Boolean, required: true }
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
