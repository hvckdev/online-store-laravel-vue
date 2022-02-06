<template>
    <div class="mb-3">
        <label v-if="label" :for="id">{{ label }}</label>
        <select :id="id" v-model="selected" v-bind="{ ...$attrs, class: null }" class="form-select" :class="{ 'is-invalid': error }">
            <slot />
        </select>
        <div v-if="error" class="invalid-feedback">{{ error }}</div>
    </div>
</template>

<script>
export default {
    name: "SelectInput",
    props: {
        error: String,
        id: {
            type: String,
            default: 'text',
        },
        label: String,
        modelValue: Number,
    },
    emits: ['update:modelValue'],
    data() {
        return {
            selected: this.modelValue,
        }
    },
    watch: {
        selected(selected) {
            this.$emit('update:modelValue', selected)
        },
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
    },
}
</script>

<style scoped>

</style>
