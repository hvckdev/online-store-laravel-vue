<template>
    <app-layout title="categories">
        <template #header>
            <h2 class="h4 font-weight-bold">
                Categories
                <button class="btn btn-dark float-end" @click="createCategoryModalOpen">
                    Add
                </button>
            </h2>
        </template>

        <div class="container my-5 pt-1 px-5 card">
            <table-layout>
                <template #head>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </template>

                <template #body>
                    <tr v-for="category in categories.data" :key="category.id">
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td>
                            <div class="btn-group">
                                <button @click="editCategoryModalOpen(category)"
                                        class="btn btn-sm btn-primary text-white">Edit
                                </button>
                                <button @click="this.currentCategory = category"
                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                        class="btn btn-sm btn-danger text-white">Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </table-layout>
        </div>

        <!-- Creating / editing category modal -->
        <modal id="categoryModal">
            <template #title>{{ isEdit ? 'Edit' : 'Create' }} category</template>

            <template #content>
                <form method="post" @submit.prevent="createOrUpdateCategory">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="form.name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">{{ isEdit ? 'Edit' : 'Create' }}</button>
                    </div>
                </form>
            </template>
        </modal>

        <!-- Delete category modal -->
        <modal id="deleteCategoryModal">
            <template #title>Delete category</template>

            <template #content>
                <div class="card-body">
                    Are u sure? You will permanently delete {{ this.currentCategory.name }} category!
                </div>
                <form method="post" @submit.prevent="destroyCategory">
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
import CreateForm from "@/Pages/Categories/Partials/Form";
import {Link, useForm} from "@inertiajs/inertia-vue3";

export default {
    name: "Index",
    components: {
        AppLayout,
        TableLayout,
        Modal,
        CreateForm,
        Link
    },

    data() {
        return {
            isEdit: false,
            currentCategory: {},

            form: useForm({
                name: ''
            }),
        }
    },

    props: {
        categories: Object,
    },

    methods: {
        modal() {
            return bootstrap.Modal.getOrCreateInstance(document.getElementById('categoryModal'))
        },

        createCategoryModalOpen() {
            this.isEdit = false
            this.form.reset()

            this.modal().show()
        },

        editCategoryModalOpen(category) {
            this.isEdit = true
            this.form.name = category.name

            this.currentCategory = category

            this.modal().show()
        },

        createOrUpdateCategory() {
            this.modal().hide()

            if(!this.isEdit) {
                this.form.post(this.route('category.store'))
            }
            else {
                this.form.put(this.route('category.update', this.currentCategory.id))
            }
        },

        destroyCategory() {
            bootstrap.Modal.getOrCreateInstance(document.getElementById('deleteCategoryModal')).hide()

            this.form.delete(this.route('category.destroy', this.currentCategory.id))
        }
    },
}
</script>

<style scoped>

</style>
