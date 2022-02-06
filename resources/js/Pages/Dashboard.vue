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
import {defineComponent} from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import Welcome from "@/Jetstream/Welcome.vue"
import CardLayout from "@/Shared/Content/Card";

export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        CardLayout,
    }
});
</script>
