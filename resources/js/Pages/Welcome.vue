<template>
    <app-layout title="home">
        <template #header>
            <h2 class="h4 font-weight-bold">
                Home
            </h2>
        </template>
        <div class="container-fluid my-5 pt-5 px-5 card">
            <div class="container p-5">
                <div class="row">
                    <div class="col animated fadeIn" data-appear-anim-style="fadeIn">
                        <h1 class="display-4 fw-bold text-center">
                            My merch
                        </h1>
                        <h3 class="mg-md float-none text-center">
                            The best merch that u ever seen
                        </h3>
                        <div class="text-center">
                            <a href="#available" class="btn btn-outline-dark">Let&rsquo;s check</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="album p-3 card" id="available">
            <div class="container card">
                <h3 class="text-center">Available to buy</h3>
                <hr>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" v-if="products.length >= 1">
                    <div class="col" v-for="product in products" :key="product.id">
                        <div class="card shadow-sm">
                            <img :src="product.photo_url" class="bd-placeholder-img card-img-top" width="300"
                                 height="300"
                                 xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                 preserveAspectRatio="xMidYMid slice" focusable="false">

                            <div class="card-body">
                                <small class="small text-muted">{{ product.category.name }}</small>
                                <p class="card-title fw-bolder">{{ product.name }}</p>
                                <p class="card-text">{{ product.description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button v-if="$page.props.user !== null" type="button" class="btn btn-sm btn-outline-dark"
                                            @click="orderProductModalOpen(product)">Buy
                                    </button>
                                    <button disabled v-else class="btn btn-sm btn-outline-dark">Login to buy</button>
                                    <small class="text-muted">{{ product.in_stock }} available</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center" v-else>
                    Nothing here... <small class="text-muted">for now</small>
                </div>
            </div>
        </div>

        <modal v-if="$page.props.user !== null" id="orderProductModal">
            <template #title>Order {{ currentProduct.name }}</template>
            <template #content>
                <form @submit.prevent="orderCreate">
                    <div class="modal-body">
                        <text-input v-model="form.address" label="Address"></text-input>
                        <hr>
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="">
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="">
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="">
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="">
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark" data-bs-dismiss="modal">Buy</button>
                    </div>
                </form>
            </template>
        </modal>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Modal from "@/Shared/Content/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import TextInput from "@/Shared/Form/TextInput";


export default {
    name: "Welcome",
    components: {TextInput, Modal, AppLayout},
    data() {
        return {
            currentProduct: {},

            form: useForm({
                product_id: null,
                address: null,
                tracking_number: null
            }),
        }
    },

    props: {
        products: Object,
    },

    methods: {
        modal() {
            return bootstrap.Modal.getOrCreateInstance(document.getElementById('orderProductModal'))
        },

        orderProductModalOpen(product) {
            this.form.reset()

            this.currentProduct = product

            this.form.product_id = product.id
            this.form.tracking_number = '222TRACKINGNUMBER222'

            this.modal().show()
        },

        orderCreate() {
            this.form.post(this.route('order.store'), {
                preserveScroll: true,
            })
        }
    }
}
</script>

<style scoped>

</style>
