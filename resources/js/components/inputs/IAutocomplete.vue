<template>
    <section>
        <b-field
            :label="label"
            horizontal>
            <b-autocomplete
                :id="id"
                :name="name"
                :placeholder="placeholder"
                :keep-first="keepFirst"
                :open-on-focus="openOnFocus"
                :data="data"
                icon="magnify"
                clearable>
                <template #empty>No results found</template>
            </b-autocomplete>
        </b-field>
    </section>
</template>

<script>
export default {
    props: {
        label: {
            type: String,
        },
        id: {
            type: String,
        },
        name: {
            type: String,
        },
        placeholder: {
            type: String,
        },
        data: {
            type: Array,
        },
    },
    data() {
        console.log(this.data);
        return {
            keepFirst: true,
            openOnFocus: true,
            clearable: false
        }
    },
}
</script>
