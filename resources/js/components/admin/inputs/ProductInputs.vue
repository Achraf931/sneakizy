<template>
    <div class="form" v-if="oneItem === null">
        <h3>Produit</h3>
        <label for="name">Nom</label>
        <input id="name" type="text" placeholder="Nom" v-model="form.name" @input="setName($event.target.value)" :class="{error: $v.form.name.$error}">
        <label for="brand">Marque</label>
        <input id="brand" type="text" placeholder="Marque" v-model="form.brand" @input="setBrand($event.target.value)" :class="{error: $v.form.brand.$error}">

        <label for="description">Description</label>
        <editor
            id="description"
            v-model="form.description"
            api-key="aurm6hyuh28jihz3rr0alf6vphzbd5xo471xz1nzal5iyptm"
            :init="{
         height: 200,
         menubar: true,
         plugins: [
           'advlist autolink lists link image charmap print preview anchor',
           'searchreplace visualblocks code fullscreen',
           'insertdatetime media table paste code help wordcount'
         ],
         toolbar:
           'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help'
       }"
        />

        <label for="price">Prix</label>
        <input id="price" type="number" placeholder="Prix" v-model="form.price" @input="setPrice($event.target.value)" :class="{error: $v.form.price.$error}">
        <label for="image">Image</label>
        <input type="file" id="image" :change="form.image">
        <div>
            <button class="button sendForm" @click.prevent="sendForm">Envoyer</button>
        </div>
        <div class="notifError" v-if="error != ''">{{error}}</div>
    </div>

    <div class="form" v-else>
        <h3>Produit</h3>
        <label for="name">Nom</label>
        <input id="name" type="text" placeholder="Nom" v-model="oneItem.name" @input="setName($event.target.value)" :class="{error: $v.form.name.$error}">
        <label for="brand">Marque</label>
        <input id="brand" type="text" placeholder="Marque" v-model="oneItem.brand" @input="setBrand($event.target.value)" :class="{error: $v.form.brand.$error}">

        <label for="description">Description</label>
        <editor
            :class="{error: $v.form.price.$error}"
            @input="setDescription($event.target.value)"
            id="description"
            v-model="oneItem.description"
            api-key="aurm6hyuh28jihz3rr0alf6vphzbd5xo471xz1nzal5iyptm"
            :init="{
         height: 200,
         menubar: true,
         plugins: [
           'advlist autolink lists link image charmap print preview anchor',
           'searchreplace visualblocks code fullscreen',
           'insertdatetime media table paste code help wordcount'
         ],
         toolbar:
           'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help'
       }"
        />

        <label for="price">Prix</label>
        <input id="price" type="number" placeholder="Prix" v-model="oneItem.price" @input="setPrice($event.target.value)" :class="{error: $v.form.price.$error}">
        <label for="image">Image</label>
        <input type="file" id="image" :change="oneItem.image">
        <h3>Image principale</h3>
        <img style="width: 200px" :src="oneItem.image" :alt="oneItem.name">
        <h3>Images secondaires</h3>
        <div style="display: grid; grid-gap: 20px; grid-template-columns: repeat(auto-fit, 126px);">
            <img style="width: 120px; height: 120px; object-fit: cover;" v-for="img in oneItem.images" :key="img.id" :src="img.image" :alt="img.name">
        </div>
        <div>
            <button class="button sendForm" @click.prevent="sendForm">Envoyer</button>
        </div>
        <div class="notifError" v-if="error != ''">{{error}}</div>
    </div>
</template>
<script>
    import Editor from '@tinymce/tinymce-vue'
    import {required} from "vuelidate/lib/validators";

    export default {
        props: ['oneItem'],
        data() {
            return {
                error: '',
                routeName: this.$route.name,
                form: {
                    name: '',
                    price: '',
                    description: '',
                    image: null,
                    is_published: 1,
                    brand: '',
                    brand_id: 1
                }
            }
        },
        components: {
            Editor
        },
        validations: {
            form: {
                name: {
                    required
                },
                price: {
                    required
                },
                description: {
                    required
                },
                brand: {
                    required
                }
            }
        },
        methods: {
            setName(value) {
                if (this.oneItem !== null) {
                    this.form.name = this.oneItem.name
                }
                else {
                    this.form.name = value
                }
                this.$v.form.name.$touch()
            },
            setBrand(value) {
                if (this.oneItem !== null) {
                    this.form.brand = this.oneItem.brand
                }
                else {
                    this.form.brand = value
                    this.$v.form.brand.$touch()
                }
                this.$v.form.brand.$touch()
            },
            setDescription(value) {
                if (this.oneItem !== null) {
                    this.form.description = this.oneItem.description
                }
                else {
                    this.form.description = value
                    this.$v.form.description.$touch()
                }
                this.$v.form.description.$touch()
            },
            setPrice(value) {
                if (this.oneItem !== null) {
                    this.form.price = this.oneItem.price
                }
                else {
                    this.form.price = value
                    this.$v.form.price.$touch()
                }
                this.$v.form.price.$touch()
            },
            deleteImage() {
                console.log('delete img')
            },
            sendForm() {
                this.$v.form.$touch()
                if (this.$v.form.$invalid) {
                    console.log(this.form)
                    this.error = "Le formulaire n'est pas rempli correctement, veuillez bien remplir les champs en rouge"
                } else {
                    this.form.image = document.getElementById('image').files[0]
                    this.$emit('sendEvent', {form: this.form, id: this.oneItem !== null ? this.oneItem.id : null})
                }
            }
        }
    }
</script>
