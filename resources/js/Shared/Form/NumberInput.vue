<template>
    <div class="mb-3">
        <label v-if="label" :for="id">{{ label }}</label>
        <input type="number" :id="id" v-bind="{ ...$attrs, class: null }" :value="modelValue"
               @input="$emit('update:modelValue', $event.target.value)" class="form-control"
               :class="{ 'is-invalid': error }" :min="min" :max="max">
        <div v-if="error" class="invalid-feedback">{{ error }}</div>
    </div>
</template>

<script>
export default {
    name: "NumberInput",
    props: {
        error: String,
        id: {
            type: String,
            default: 'text',
        },
        label: String,
        modelValue: Number,
        min: Number,
        max: Number,
    },
    emits: ['update:modelValue'],
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
