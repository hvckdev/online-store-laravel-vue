<template>
    <app-layout title="products">
        <template #header>
            <h2 class="h4 font-weight-bold">
                Products
                <button class="btn btn-dark float-end" @click="createProductModalOpen">Add</button>
            </h2>
        </template>

        <div class="container my-5 pt-1 px-5 card">
            <table-layout>
                <template #head>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Quantity in stock</th>
                    <th>Actions</th>
                </template>

                <template #body>
                    <tr v-for="product in products.data" :key="product.id">
                        <td> {{ product.id }} </td>
                        <td> {{ product.name }} </td>
                        <td> {{ product.category.name }} </td>
                        <td> {{ product.in_stock }} </td>
                        <td>
                            <div class="btn-group">
                                <button @click="updateProductModalOpen(product)"
                                        class="btn btn-sm btn-primary text-white">Edit
                                </button>
                                <button @click="currentProduct = product"
                                    data-bs-toggle="modal" data-bs-target="#deleteProductModal"
                                    class="btn btn-sm btn-danger text-white">Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </table-layout>
        </div>

        <!-- Creating / editing category modal -->
        <modal id="productModal">
            <template #title>{{ isEdit ? 'Edit' : 'Create' }} product</template>

            <template #content>
                <form method="post" @submit.prevent="createOrUpdateProduct">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="form.name">
                        </div>
                        <div class="mb-3">
                            <label for="categories">Category</label>
                            <select id="categories" class="form-select" v-model="form.category_id">
                                <option disabled selected>Please select category...</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" v-model="form.description" id="description"
                                      placeholder="Description of product..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="photo">Photo</label>
                            <input class="form-control" type="file" id="photo">
                        </div>
                        <div class="mb-3">
                            <label for="quantity">Quantity</label>
                            <input class="form-control" type="number" id="quantity" v-model="form.in_stock">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">{{ isEdit ? 'Edit' : 'Create' }}</button>
                    </div>
                </form>
            </template>
        </modal>

        <!-- Delete category modal -->
        <modal id="deleteProductModal">
            <template #title>Delete category</template>

            <template #content>
                <div class="card-body">
                    Are u sure? You will permanently delete {{ this.currentProduct.name }}!
                </div>
                <form method="post" @submit.prevent="destroyProduct">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger text-white">Delete</button>
                    </div>
                </form>
            </template>
        </modal>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TableLayout from "@/Components/Content/TableLayout";
import Modal from "@/Components/Content/ModalForm";
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    name: "Index",
    components: {
        AppLayout,
        TableLayout,
        Modal
    },

    data() {
        return {
            isEdit: false,
            currentProduct: {},

            form: useForm({
                category_id: '',
                name: '',
                description: '',
                photo_path: null,
                in_stock: ''
            })
        }
    },

    props: {
        products: Object,
        categories: Object,
    },

    methods: {
        modal() {
            return bootstrap.Modal.getOrCreateInstance(document.getElementById('productModal'))
        },

        createProductModalOpen() {
            this.isEdit = false
            this.form.reset()

            this.modal().show()
        },

        updateProductModalOpen(product) {
            this.isEdit = true
            this.currentProduct = product

            this.form.name = product.name
            this.form.description = product.description
            this.form.category_id = product.category_id
            this.form.in_stock = product.in_stock

            this.modal().show()
        },

        createOrUpdateProduct() {
            this.modal().hide()

            if (!this.isEdit) {
                this.form.post(this.route('product.store'))
            } else {
                this.form.put(this.route('product.update', this.currentProduct.id))
            }
        },

        destroyProduct() {
            bootstrap.Modal.getOrCreateInstance(document.getElementById('deleteProductModal')).hide()

            this.form.delete(this.route('product.destroy', this.currentProduct.id))
        }
    }

}
</script>

<style scoped>

</style>
