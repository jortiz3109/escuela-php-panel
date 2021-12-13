<template>
    <button class="button">
        {{ userStatus }}
    </button>
</template>

<script>
export default {
    name: 'EnableButton',
    props: {
        userId: { type: String, required: true },
        userStatus: { type: String, required: true },
        emailVerified: { type: String, required: true }
    },
}
</script>
