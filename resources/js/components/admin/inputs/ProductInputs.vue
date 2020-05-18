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
                isAdding: false,
                error: '',
                loading: null,
                routeName: this.$route.name,
                form: {
                    name: '',
                    price: '',
                    description: '',
                    image: null,
                    release_date: '2020-01-01',
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
                if (this.$v.form.$invalid) {
                    this.error = "Le formulaire n'est pas rempli correctement, veuillez bien remplir les champs en rouge"
                } else {
                    this.form.image = document.getElementById('image').files[0]
                    this.$emit('sendEvent', {form: this.form, id: this.oneItem !== null ? this.oneItem.id : null})
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    .disabled {
        transition: background .2s ease;
        background-color: transparent!important;
        color: transparent!important;
    }
    .input-file {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .file-return {
        margin: 0;
    }
    .file-return:not(:empty) {
        margin: 1em 0;
    }
    .file-return {
        font-style: italic;
        font-size: .9em;
        font-weight: bold;
    }
    .file-return:not(:empty):before {
        content: "Selected file: ";
        font-style: normal;
        font-weight: normal;
    }


    .lds-ellipsis {
        display: inline-block;
        position: absolute;
        width: 126px;
        height: 126px;
        background: white;
        border-radius: 5px;
    }
    .lds-ellipsis div {
        position: absolute;
        top: 50%;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #591df1;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }
    .lds-ellipsis div:nth-child(1) {
        left: 35px;
        animation: lds-ellipsis1 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(2) {
        left: 35px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(3) {
        left: 59px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(4) {
        left: 81px;
        animation: lds-ellipsis3 0.6s infinite;
    }
    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
    }
    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(24px, 0);
        }
    }
</style>
