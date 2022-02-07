<template>
    <app-layout title="Orders">
        <template #header>
            <h2 class="h4 font-weight-bold">
                Your orders
            </h2>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "Index",
    components: {
        AppLayout
    }
}
</script>

<style scoped>

</style>
