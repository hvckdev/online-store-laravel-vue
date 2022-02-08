<template>
    <app-layout title="Orders">
        <template #header>
            <h2 class="h4 font-weight-bold">
                Your orders
            </h2>

            <div class="container my-5 pt-1 px-5 card">
                <Table>
                    <template #head>
                        <th>#</th>
                        <th>Item</th>
                        <th>Address</th>
                        <th>Tracking number</th>
                        <th>Status</th>
                    </template>

                    <template #body>
                        <tr v-for="order in orders" :key="order.id">
                            <td>{{ order.id }}</td>
                            <td>
                                <img :src="order.item.photo_url" width="32" height="32" alt="Photo">
                                {{ order.item.name }}
                            </td>
                            <td>{{ order.address }}s</td>
                            <td>{{ order.tracking_number }}</td>
                            <td class="text-success">Delivered</td>
                        </tr>
                    </template>
                </Table>
            </div>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Table from "@/Shared/Content/Table";

export default {
    name: "Index",
    components: {
        Table,
        AppLayout,
    },
    props: {
        orders: Object
    },
    mounted() {
      console.log(this.orders)
    }
}
</script>

<style scoped>

</style>
