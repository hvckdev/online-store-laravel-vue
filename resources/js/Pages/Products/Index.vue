<template>
    <app-layout title="products">
        <template #header>
            <h2 class="h4 font-weight-bold">
                Products
                <a :href="route('product.create')" class="btn btn-dark float-end">Create</a>
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
                        <td> {{ product.id }}</td>
                        <td><img :src="product.photo_url" width="32" height="32" alt="Photo"> {{ product.name }}</td>
                        <td> {{ product.category.name }}</td>
                        <td> {{ product.in_stock }}</td>
                        <td>
                            <div class="btn-group">
                                <button @click="updateProductModalOpen(product)"
                                        class="btn btn-sm btn-primary text-white">
                                    Edit
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
            <template #title>Edit product</template>

            <template #content>
                <form method="post" @submit.prevent="updateProduct" enctype="multipart/form-data">
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
                            <div class="invalid-feedback" v-if="form.errors.category_id">
                                {{ form.errors.category_id }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" v-model="form.description" id="description"
                                      placeholder="Description of product..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="photo">Photo</label>
                            <div v-show="photoPreview" class="block w-20 mt-3 mb-3 h-20 photo-preview"
                                 :style="'background-image: url(\'' + photoPreview + '\');'">
                            </div>

                            <input @change="updateFormAndPhotoPreview" ref="photo" class="form-control" type="file"
                                   id="photo">
                            <div class="invalid-feedback" v-if="form.errors.photo">{{ form.errors.photo }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="quantity">Quantity</label>
                            <input class="form-control" type="number" id="quantity" v-model="form.in_stock">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Edit</button>
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
import TableLayout from "@/Shared/Content/Table";
import Modal from "@/Shared/Content/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import {Method} from "@inertiajs/inertia";

export default {
    name: "Index",
    components: {
        AppLayout,
        TableLayout,
        Modal
    },
    data() {
        return {
            currentProduct: {},
            photoPreview: null,

            form: useForm({
                _method: Method.PUT,
                category_id: null,
                name: null,
                description: null,
                photo: null,
                in_stock: null
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
        updateProductModalOpen(product) {
            this.currentProduct = product

            this.photoPreview = product.photo_url
            this.form.name = product.name
            this.form.description = product.description
            this.form.category_id = product.category_id
            this.form.in_stock = product.in_stock

            this.modal().show()
        },
        updateProduct() {
            this.form.post(this.route('product.update', this.currentProduct.id), {
                onSuccess: () => {
                    this.modal().hide()
                    this.form.reset()
                },

                onError: () => {
                    console.log(this.form.errors)
                }
            })
        },
        destroyProduct() {
            bootstrap.Modal.getOrCreateInstance(document.getElementById('deleteProductModal')).hide()

            this.form.delete(this.route('product.destroy', this.currentProduct.id))
        },
        updateFormAndPhotoPreview(e) {
            this.form.photo = e.target.files[0]
            const reader = new FileReader()
            reader.onload = (e) => {
                this.photoPreview = e.target.result
            };
            reader.readAsDataURL(this.$refs.photo.files[0])
        },
    }
}
</script>

<style scoped>
.photo-preview {
    width: 5rem;
    height: 5rem;
    border-radius: 999px;
    display: block;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}
</style>
