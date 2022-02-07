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
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
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
                                    <button type="button" class="btn btn-sm btn-outline-dark">Buy</button>
                                    <small class="text-muted">{{ product.in_stock }} available</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "Welcome",
    components: {AppLayout},
    props: {
        products: Object,
    }
}
</script>

<style scoped>

</style>
