<template>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" v-model="form.name">
    </div>
</template>

<script>
export default {
    name: "Form",

    data()
    {
        return {
            form: {
                name: ''
            }
        }
    }
}
</script>

<style scoped>

</style>
