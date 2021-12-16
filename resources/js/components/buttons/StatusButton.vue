<template>
    <button class="button" @click="switchUserStatus" :class="status === 'Enabled' ? 'is-success' : 'is-danger'">
        <span class="text-red-500">{{ status }}</span>
        <b-icon
            icon="check-circle"
            size="is-small">
        </b-icon>
    </button>
</template>

<script>
import axios from 'axios';

export default {
    name: 'StatusButton',
    data() {
        return {
            status: this.userStatus
        }
    },
    props: {
        url: { type: String, required: true },
        userId: { type: String, required: true },
        userStatus: { type: String, required: true },
        emailVerified: { type: Boolean, required: true }
    },
    methods: {
        switchUserStatus: async function () {
            const response = await axios.get(`${this.$props.url}/api/toggle-user-enable/${this.$props.userId}`);
            this.status = response.data.status
        }
    }
}
</script>
