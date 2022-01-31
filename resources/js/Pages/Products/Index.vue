<template>
    <app-layout title="products">
        <template #header>
            <h2 class="h4 font-weight-bold">
                Products
                <button class="btn btn-dark float-end">Add</button>
            </h2>
        </template>

        <div class="container my-5 pt-1 px-5 card">
            <table-layout>
                <template #head>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Actions</th>
                </template>

                <template #body>
                    <tr v-for="product in products.data" :key="product.id">
                        <td>{{ product.id }}</td>
                        <td> {{ product.name }}</td>
                        <td> {{ product.category.name }}</td>
                        <td>
                            <div class="btn-group">
                                <button
                                        class="btn btn-sm btn-primary text-white">Edit
                                </button>
                                <button
                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                        class="btn btn-sm btn-danger text-white">Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </table-layout>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TableLayout from "@/Components/Content/TableLayout";
import ModalForm from "@/Components/Content/ModalForm";

export default {
    name: "Index",
    components: {
        AppLayout,
        TableLayout,
        ModalForm
    },

    data() {
        return {

        }
    },

    props: {
        products: Object,
    },

    createProduct() {

    }

}
</script>

<style scoped>

</style>
