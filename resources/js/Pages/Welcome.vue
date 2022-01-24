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
                            <a href="#1" class="btn btn-outline-dark">Let&rsquo;s check</a>
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
    components: {AppLayout}
}
</script>

<style scoped>

</style>
