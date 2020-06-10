<template>
    <div class="form" v-if="oneItem === null">
        <h3>Marque</h3>
        <label for="name">Nom</label>
        <input id="name" type="text" placeholder="Nom" v-model="form.name" @input="setName($event.target.value)" :class="{error: $v.form.name.$error}">

        <label for="image">Image</label>
        <input type="file" id="image" :change="form.image">

        <label for="banner">Banner</label>
        <input type="file" id="banner" :change="form.banner">

        <div>
            <button class="button sendForm" @click.prevent="sendForm">Envoyer</button>
        </div>
        <div class="notifError" v-if="error != ''">{{error}}</div>
    </div>

    <div class="form" v-else>
        <h3>Marque</h3>
        <label for="name">Titre</label>
        <input id="name" type="text" placeholder="Nom" v-model="oneItem.name" @input="setName($event.target.value)" :class="{error: $v.form.name.$error}">

        <label for="image">Image</label>
        <input type="file" id="image" :change="oneItem.image">

        <h3>Image principale</h3>
        <img class="boxShadow" style="width: 50px; border-radius: 10px" :src="oneItem.image" :alt="oneItem.name">

        <label for="banner">Banner</label>
        <input type="file" id="banner" :change="oneItem.banner">

        <h3>Bannière</h3>
        <img class="boxShadow" style="width: 200px; border-radius: 10px" :src="oneItem.banner" :alt="oneItem.name">

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
                    image: null,
                    banner: null
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
            sendForm() {
                this.$v.form.$touch()
                if (this.$v.form.$invalid) {
                    this.error = "Le formulaire n'est pas rempli correctement, veuillez bien remplir les champs en rouge"
                } else {
                    this.form.image = document.getElementById('image').files[0]
                    this.form.banner = document.getElementById('banner').files[0]
                    this.$emit('sendEvent', {form: this.form, id: this.oneItem !== null ? this.oneItem.id : null})
                }
            }
        }
    }
</script>
