<template>
    <div class="mb-3">
        <label v-if="label" :for="id">{{ label }}</label>
        <textarea :id="id" class="form-control" v-bind="{ ...$attrs, class: null }" :class="{ 'is-invalid': error }"
                  @input="$emit('update:modelValue', $event.target.value)" :value="modelValue"/>
        <div v-if="error" class="invalid-feedback">{{ error }}</div>
    </div>
</template>

<script>
export default {
    name: "TextareaInput",
    props: {
        error: String,
        id: {
            type: String,
            default: 'text',
        },
        label: String,
        modelValue: String,
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
