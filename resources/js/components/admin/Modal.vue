<template>
    <section class="bgWhite bRadius padding15 fullWidth">
        <div id="bg"></div>

        <ItemForm :oneItem="oneItem" :itemForEdit="itemForEdit" @send="sendForm"/>
    </section>
</template>
<script>
    import ItemForm from './ItemForm'
    export default {
        props: ['action', 'itemForEdit', 'oneItem'],
        components: {
            ItemForm
        },
        methods: {
            sendForm(form) {
                if (this.$route.name === 'admin/products') {
                    let formData = new FormData()
                    this.product.image = document.getElementById('image').files[0]
                    formData.append("image", this.product.image)
                    formData.append("name", this.product.name)
                    formData.append("price", this.product.price)
                    formData.append("description", this.product.description)
                    formData.append("release_date", this.product.release_date)
                    formData.append("is_published", this.product.is_published)
                    formData.append("brand", this.product.brand)
                    formData.append("brand_id", this.product.brand_id)
                    this.$emit('close', formData)
                }
                else if (this.$route.name === 'admin/users') {
                    this.$emit('close', {item: form, action: this.action})
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    section {
        position: fixed;
        max-width: 600px;
        overflow: scroll;
        max-height: 98vh;
        left: 50%;
        top: 50%;
        z-index: 170;
        transform: translate(-50%, -50%);
    }
</style>
