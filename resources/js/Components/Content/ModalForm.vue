<template>
    <div class="modal fade" :id="id" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <slot name="title"/>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <slot name="content" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modal",
    props: {
        id: {
            type: String,
            default: 'modal'
        },
        action: {
            type: String,
            default: '/'
        }
    }
}
</script>

<style scoped>

</style>
