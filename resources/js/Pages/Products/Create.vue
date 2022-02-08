<template>
    <app-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Create product
            </h2>

            <div class="container my-5 pt-1 px-5">
                <form @submit.prevent="createProduct">
                    <text-input v-model="form.name" label="Name" :error="form.errors.name" />
                    <select-input v-model="form.category_id" label="Category" :error="form.errors.category_id">
                        <option disabled selected>Please select category...</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select-input>
                    <textarea-input v-model="form.description" label="Description" :error="form.errors.description" />
                    <div class="mb-3">
                        <label for="photo">Photo</label>
                        <input @change="form.photo = $event.target.files[0]" ref="photo" class="form-control" type="file" id="photo">
                        <div class="invalid-feedback" v-if="form.errors.photo">{{ form.errors.photo }}</div>
                    </div>
                    <number-input v-model="form.in_stock" label="Quantity in stock" :error="form.errors.in_stock"></number-input>
                    <button type="submit" class="btn btn-dark float-end">Create</button>
                </form>
            </div>
        </template>
    </app-layout>

</template>

<script>
import AppLayout from "@/Layouts/AppLayout"
import Card from "@/Shared/Content/Card";
import TextInput from "@/Shared/Form/TextInput";
import {useForm} from "@inertiajs/inertia-vue3";
import SelectInput from "@/Shared/Form/SelectInput";
import TextareaInput from "@/Shared/Form/TextareaInput";
import NumberInput from "@/Shared/Form/NumberInput";

export default {
    name: "Edit",
    components: {
        NumberInput,
        TextareaInput,
        AppLayout,
        Card,
        TextInput,
        SelectInput
    },

    props: {
        categories: Object,
    },

    data() {
        return {
            form: useForm({
                name: null,
                category_id: null,
                description: null,
                photo: null,
                in_stock: null,
            }),

            photoPreview: null,
        }
    },

    methods: {
        createProduct() {
            this.form.post(this.route('product.store'), {
                onError: () => {
                    console.log(this.form.errors)
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
