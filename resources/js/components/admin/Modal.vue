<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div v-if="action === 'create'" class="modal-container">

                <div class="modal-body">
                    <h1>{{action}}</h1>
                    <slot name="body">
                        Name: <input type="text" v-model="product.name">
                        Marque: <input type="text" v-model="product.brand">
                        Price: <input type="text" v-model="product.price">
                        Release Date: <input type="date" v-model="product.release_date">
                        <textarea v-model="product.description" placeholder="description"></textarea>
                        <input id="image" name="image" type="file">
                    </slot>
                </div method="post" enctype="multipart/form-data">

                <div class="modal-footer">
                    <slot name="footer">
                        <button class="modal-default-button" @click="newProduct">
                            Finish
                        </button>
                    </slot>
                </div>
            </div>

            <div v-else-if="action === 'edit'">
                <form action="">
                    <input type="text" placeholder="formulaire edit">
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['action'],
        data() {
            return {
                product: {
                    name: "",
                    price: "",
                    description: "",
                    image: null,
                    is_published: 1,
                    brand: "",
                    brand_id: 1
                }
            }
        },
        methods: {
            newProduct() {
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
        }
    }
</script>
<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>
