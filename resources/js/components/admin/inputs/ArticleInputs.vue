<template>
    <div class="form" v-if="oneItem === null">
        <h3>Article</h3>
        <label for="title">Titre</label>
        <input id="title" type="text" placeholder="Titre" v-model="form.title" @input="setTitle($event.target.value)" :class="{error: $v.form.title.$error}">

        <label for="summary">Summary</label>
        <textarea id="summary" v-model="form.summary" @input="setSummary($event.target.value)" :class="{error: $v.form.summary.$error}"></textarea>

        <label for="content">Contenu</label>
        <textarea id="content" v-model="form.content" @input="setContent($event.target.value)" :class="{error: $v.form.content.$error}"></textarea>

        <label for="">Auteur</label>
        <div class="dFlex mrTop10 mrBottom10 flexWrap justifySpaceB">
            <p class="userButton cPointer bRadius5 paddingTop5 paddingBottom5 paddingLeft10 paddingRight10" v-for="user in users" :key="user.id" v-model="form.user" @click.prevent="setUser(user)" :class="{isSelected: userTmp.lastname === user.lastname}">
                {{user.lastname}}
            </p>
        </div>

        <label for="image">Image</label>
        <input type="file" id="image" :change="form.image">

        <label for="banner">Banner</label>
        <input type="file" id="banner" :change="form.banner">

        <div>
            <button class="button sendForm" @click.prevent="sendForm">Envoyer</button>
        </div>
    </div>

    <div class="form" v-else>
        <h3>Article</h3>
        <label for="title">Titre</label>
        <input id="title" type="text" placeholder="Titre" v-model="oneItem.title" @input="setTitle($event.target.value)" :class="{error: $v.form.title.$error}">

        <label for="summary">Summary</label>
        <textarea id="summary" :class="{error: $v.form.summary.$error}" @input="setSummary($event.target.value)" v-model="oneItem.summary"></textarea>

        <label for="content">Contenu</label>
        <textarea id="content" :class="{error: $v.form.content.$error}" @input="setContent($event.target.value)" v-model="oneItem.content"></textarea>

        <label for="">Auteur</label>
        <div class="dFlex mrTop10 mrBottom10 flexWrap justifySpaceB">
            <p class="userButton cPointer bRadius5 paddingTop5 paddingBottom5 paddingLeft10 paddingRight10" v-for="user in users" :key="user.id" v-model="oneItem.author" @click.prevent="setUser(user)" :class="{isSelected: userTmp.lastname === user.lastname}">
                {{user.lastname}}
            </p>
        </div>

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
    </div>
</template>
<script>
    import Editor from '@tinymce/tinymce-vue'
    import {required} from "vuelidate/lib/validators"
    import {mapGetters} from 'vuex'

    export default {
        props: ['oneItem'],
        data() {
            return {
                imgArrayTmp: [],
                isAdding: false,
                loading: null,
                routeName: this.$route.name,
                userTmp: '',
                form: {
                    title: '',
                    summary: '',
                    content: '',
                    author: '',
                    image: null,
                    banner: null
                }
            }
        },
        computed: {
            ...mapGetters({
                users: 'users/users'
            })
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
            setUser(value) {
                this.userTmp = value
            },
            sendForm() {
                this.$v.form.$touch()
                if (this.$v.$invalid) {
                    this.$store.dispatch('notifications/AddNotification', {notification: "Le formulaire n'est pas rempli correctement, veuillez bien remplir les champs en rouge", type: 0})
                } else {
                    if (this.oneItem == null && document.getElementById('image').files[0] !== undefined) {
                        this.form.image = document.getElementById('image').files[0]
                        this.form.banner = document.getElementById('banner').files[0]
                        this.form.author = this.userTmp.lastname
                        this.$emit('sendEvent', {form: this.form, id: this.oneItem !== null ? this.oneItem.id : null})
                        this.form = {}
                        this.$v.$reset()
                    } else {
                        this.$store.dispatch('notifications/AddNotification', {notification: "L'image principale est obligatoire !", type: 0})
                    }
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    .userButton {
        background: #f0f3ff;
        color: #93a2dd;
        border: 1px solid transparent;
        transition: all .2s ease;
    }

    .userButton:hover {
        color: #591df1;
        border: 1px solid #591df1;
    }
    .isSelected {
        background: #591df1!important;
        color: white!important;
        transition: all .2s ease;
    }
</style>
