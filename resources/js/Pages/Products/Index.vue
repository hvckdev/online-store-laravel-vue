<template>
    <app-layout title="products">
        <template #header>
            <h2 class="h4 font-weight-bold">
                Products
                <button class="btn btn-dark float-end">Add</button>
            </h2>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "Index",
    components: {AppLayout},

    data() {
        return {

        }
    },

    createProduct() {

    }

}
</script>

<style scoped>

</style>
