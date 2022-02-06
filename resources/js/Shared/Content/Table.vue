<template>
    <table class="table overflow-auto">
        <thead>
            <tr>
                <slot name="head"></slot>
            </tr>
        </thead>

        <tbody>
            <slot name="body"></slot>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "Table"
}
</script>

<style scoped>

</style>
