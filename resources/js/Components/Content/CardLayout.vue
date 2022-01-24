<template>
    <div class="card">
        <div class="card-header">
            <slot name="header" />
        </div>
        <div class="card-body">
            <slot name="body" />
        </div>
    </div>
</template>

<script>
export default {
    name: "CardLayout"
}
</script>

<style scoped>

</style>
