<template>
    <div class="form" v-if="oneItem === null">
        <h3>Produit</h3>
        <label for="name">Nom</label>
        <input id="name" type="text" placeholder="Nom" v-model="form.name" @input="setName($event.target.value)" :class="{error: $v.form.name.$error}">
        <label for="brand">Marque</label>
        <input id="brand" type="text" placeholder="Marque" v-model="form.brand" @input="setBrand($event.target.value)" :class="{error: $v.form.brand.$error}">
        <label for="color">Couleur</label>
        <input id="color" type="text" placeholder="Couleur" v-model="form.color">

        <label for="description">Description</label>
 <!--       <editor
            id="description"
            v-model="form.description"
            @input="setDescription($event.target.value)"
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
        />-->

        <textarea name="description" id="description" v-model="form.description" @input="setDescription($event.target.value)"></textarea>

        <label for="price">Prix</label>
        <input id="price" type="number" placeholder="Prix" v-model="form.price" @input="setPrice($event.target.value)" :class="{error: $v.form.price.$error}">
        <label for="image">Image</label>
        <input type="file" id="image" :change="form.image">

        <h3>Images secondaires</h3>
        <div style="display: grid; grid-gap: 20px; grid-template-columns: repeat(auto-fit, 126px);">
            <div class="cPointer pRelative" style="width: 126px; height: 126px; border-radius: 5px; border: 1px dashed #591df1; color: #591df1; font-size: 20px; display: flex; justify-content: center; align-items: center; flex-direction: column">
                <div v-if="isAdding" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                <input @change="inputFileStyleTmp" class="input-file-container input-file" id="my-file" type="file">
                <font-awesome-icon class="icon mrBottom5" icon="plus"/>
                <label style="font-size: 13px" @click="inputFileStyleTmp" tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>
            </div>
            <div v-if="imgArrayTmp.length > 0" class="pRelative boxShadow" v-for="img in imgArrayTmp" :key="img.id">
                <div v-if="loading === img.id" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                <img style="width: 126px; height: 126px; object-fit: cover; border-radius: 5px;" :src="img.image" :alt="img.image">
                <button :class="{disabled: loading === img.id}" :disabled="loading === img.id" class="cPointer button buttonDelete" style="border: none!important; width: 100%; background: red; padding: 5px; border-radius: 5px; text-align: center; color: white; font-size: 13px" @click="deleteImageTmp(img)">Supprimer</button>
            </div>
        </div>
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
        <label for="color">Couleur</label>
        <input id="color" type="text" placeholder="Couleur" v-model="form.color">

        <label for="description">Description</label>
<!--        <editor
            id="description"
            v-model="oneItem.description"
            @input="setDescription($event.target.value)"
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
        />-->

        <textarea name="description" id="description" v-model="oneItem.description" @input="setDescription($event.target.value)"></textarea>

        <label for="price">Prix</label>
        <input id="price" type="number" placeholder="Prix" v-model="oneItem.price" @input="setPrice($event.target.value)" :class="{error: $v.form.price.$error}">
        <label for="image">Image</label>
        <input type="file" id="image" :change="oneItem.image">
        <h3>Image principale</h3>
        <img class="boxShadow" style="width: 200px; border-radius: 10px" :src="oneItem.image" :alt="oneItem.name">
        <h3>Images secondaires</h3>
        <div style="display: grid; grid-gap: 20px; grid-template-columns: repeat(auto-fit, 126px);">
            <div class="cPointer pRelative" style="width: 126px; height: 126px; border-radius: 5px; border: 1px dashed #591df1; color: #591df1; font-size: 20px; display: flex; justify-content: center; align-items: center; flex-direction: column">
                <div v-if="isAdding" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                <input @change="inputFileStyle" class="input-file-container input-file" id="my-file" type="file">
                <font-awesome-icon class="icon mrBottom5" icon="plus"/>
                <label style="font-size: 13px" @click="inputFileStyle" tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>
            </div>
            <div class="pRelative boxShadow" v-for="img in oneItem.images" :key="img.id">
                <div v-if="loading === img.id" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                <img style="width: 126px; height: 126px; object-fit: cover; border-radius: 5px;" :src="img.image" :alt="img.image">
                <button :class="{disabled: loading === img.id}" :disabled="loading === img.id" class="cPointer button buttonDelete" style="border: none!important; width: 100%; background: red; padding: 5px; border-radius: 5px; text-align: center; color: white; font-size: 13px" @click="deleteImage(img)">Supprimer</button>
            </div>
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
                imgArrayTmp: [],
                idImgArrayTmp: [],
                isAdding: false,
                error: '',
                loading: null,
                routeName: this.$route.name,
                form: {
                    name: '',
                    price: '',
                    color: '',
                    description: '',
                    image: null,
                    release_date: '2020-01-01',
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
                brand: {
                    required
                },
                description: {
                    required
                }
            }
        },
        methods: {
            inputFileStyle() {
                this.isAdding = true
                let formData = new FormData()
                formData.append('image', event.target.files[0])
                formData.append('product_id', this.oneItem.id)
                document.querySelector( ".input-file" ).focus()
                axios.post('/api/images', formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(res => {
                    if (res.data.status) {
                        this.oneItem.images.push(res.data.image)
                        this.isAdding = false
                    }
                })
            },
            inputFileStyleTmp() {
                this.isAdding = true
                let formData = new FormData()
                formData.append('image', event.target.files[0])
                document.querySelector( ".input-file" ).focus()
                axios.post('/api/images', formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(res => {
                    if (res.data.status) {
                        this.imgArrayTmp.push(res.data.image)
                        this.idImgArrayTmp.push(res.data.image.id)
                        this.isAdding = false
                    }
                })
            },
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
            deleteImage(img) {
                this.loading = img.id
                axios.delete('/api/images/' + img.id).then(res => {
                    if (res.data.status) {
                        this.oneItem.images.splice(this.oneItem.images.indexOf(img), 1)
                        this.loading = null
                    }
                })
            },
            deleteImageTmp(img) {
                this.loading = img.id
                axios.delete('/api/images/' + img.id).then(res => {
                    if (res.data.status) {
                        this.imgArrayTmp.splice(this.imgArrayTmp.indexOf(img), 1)
                        this.loading = null
                    }
                })
            },
            sendForm() {
                this.$v.form.$touch()
                if (this.$v.$invalid) {
                    this.error = "Le formulaire n'est pas rempli correctement, veuillez bien remplir les champs en rouge"
                } else {
                    this.form.image = document.getElementById('image').files[0]
                    this.form.images = this.idImgArrayTmp
                    this.$emit('sendEvent', {form: this.form, id: this.oneItem !== null ? this.oneItem.id : null})
                    this.form = {}
                    this.$v.$reset()
                }
            }
        }
    }
</script>
