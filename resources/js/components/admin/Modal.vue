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
                    formData.append("image", form.form.image)
                    formData.append("name", form.form.name)
                    formData.append("price", form.form.price)
                    formData.append("description", form.form.description)
                    formData.append("release_date", form.form.release_date)
                    formData.append("is_published", form.form.is_published)
                    formData.append("brand", form.form.brand)
                    formData.append("brand_id", form.form.brand_id)
                    this.$emit('close', {id: form.id !== null ? form.id : null, item: formData, action: this.action})
                }
                else if (this.$route.name === 'admin/users') {
                    this.$emit('close', {id: form.id !== null ? form.id : null, item: form, action: this.action})
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
