<template>
    <section>
        <input type="hidden" :id="id" :name="name" v-model="value">
        <b-autocomplete
            v-model="item"
            :placeholder="placeholder"
            :keep-first="keepFirst"
            :open-on-focus="openOnFocus"
            :data="filteredDataObject"
            icon="magnify"
            field="name"
            clearable
            @select="option => (value = option ? option.id : '')">
            <template #empty>No results found</template>
        </b-autocomplete>
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
        initial_value: {
            type: String,
        },
        placeholder: {
            type: String,
        },
        data: {
            type: Array,
        },
    },
    mounted() {
        if (this.value && !this.item) {
            this.item = (this.data.find((option) => {
                return option.id.toString() === this.value.toString()
            }).name);
        }
    },
    data() {
        return {
            keepFirst: true,
            openOnFocus: true,
            clearable: true,
            item: '',
            value: this.initial_value,
        }
    },
    computed: {
        filteredDataObject() {
            return this.data.filter((option) => {
                return option.name
                    .toString()
                    .toLowerCase()
                    .indexOf(this.item.toLowerCase()) >= 0
            })
        }
    }
}
</script>
