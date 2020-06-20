<template>
    <div class="form" v-if="oneItem === null">
        <h3>Article</h3>
        <label for="title">Titre</label>
        <input id="title" type="text" placeholder="Titre" v-model="form.title" @input="setTitle($event.target.value)" :class="{error: $v.form.title.$error}">

        <label for="summary">Summary</label>
        <editor
            id="summary"
            v-model="form.summary"
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

        <label for="content">Contenu</label>
        <editor
            id="content"
            v-model="form.content"
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
       }"/>

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
        <h3>Article</h3>
        <label for="title">Titre</label>
        <input id="title" type="text" placeholder="Titre" v-model="oneItem.title" @input="setTitle($event.target.value)" :class="{error: $v.form.title.$error}">

        <label for="summary">Summary</label>
        <editor
            :class="{error: $v.form.summary.$error}"
            @input="setSummary($event.target.value)"
            id="summary"
            v-model="oneItem.summary"
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

        <label for="content">Contenu</label>
        <editor
            :class="{error: $v.form.content.$error}"
            @input="setContent($event.target.value)"
            id="content"
            v-model="oneItem.content"
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

        <label for="image">Image</label>
        <input type="file" id="image" :change="oneItem.image">

        <h3>Image principale</h3>
        <img class="boxShadow" style="width: 200px; border-radius: 10px" :src="oneItem.image" :alt="oneItem.name">

        <label for="banner">Banner</label>
        <input type="file" id="banner" :change="oneItem.banner">

        <h3>Image secondaire</h3>
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
                    title: '',
                    summary: '',
                    content: '',
                    author: 'Achraf',
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
                title: {
                    required
                },
                summary: {
                    required
                },
                content: {
                    required
                }
            }
        },
        methods: {
            setTitle(value) {
                if (this.oneItem !== null) {
                    this.form.title = this.oneItem.title
                }
                else {
                    this.form.title = value
                }
                this.$v.form.title.$touch()
            },
            setSummary(value) {
                if (this.oneItem !== null) {
                    this.form.summary = this.oneItem.summary
                }
                else {
                    this.form.summary = value
                    this.$v.form.summary.$touch()
                }
                this.$v.form.summary.$touch()
            },
            setContent(value) {
                if (this.oneItem !== null) {
                    this.form.content = this.oneItem.content
                }
                else {
                    this.form.content = value
                    this.$v.form.content.$touch()
                }
                this.$v.form.content.$touch()
            },
            sendForm() {
                this.$v.form.$touch()
                if (this.$v.$invalid) {
                    this.error = "Le formulaire n'est pas rempli correctement, veuillez bien remplir les champs en rouge"
                } else {
                    this.form.image = document.getElementById('image').files[0]
                    this.form.banner = document.getElementById('banner').files[0]
                    this.$emit('sendEvent', {form: this.form, id: this.oneItem !== null ? this.oneItem.id : null})
                    this.form = {}
                    this.$v.$reset()
                }
            }
        }
    }
</script>
