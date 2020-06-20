<template>
    <div class="form" v-if="oneItem === null">
        <h3>Utilisateur</h3>
        <input type="text" placeholder="Nom" value="" v-model="form.lastname" @input="setLastname($event.target.value)" :class="{error: $v.form.lastname.$error}">
        <input type="text" placeholder="Prénom" value="" v-model="form.firstname" @input="setFirstname($event.target.value)" :class="{error: $v.form.firstname.$error}">
        <input type="email" placeholder="E-mail" value="" v-model="form.email" @input="setEmail($event.target.value)" :class="{error: $v.form.email.$error}">
        <input type="password" placeholder="Mot de passe" value="" v-model="form.password" @input="setPassword($event.target.value)" :class="{error: $v.form.password.$error}">
        <input type="tel" placeholder="Numéro" value="" v-model="form.phone">
        <input type="text" placeholder="Adresse" value="" v-model="form.address">
        <input type="text" placeholder="Informations additionnelles" value="" v-model="form.additional_info">
        <input type="text" placeholder="Ville" value="" v-model="form.city">
        <input type="number" placeholder="Code postal" value="" v-model="form.zipcode">
        <div>
            <button class="button sendForm" @click.prevent="sendForm">Envoyer</button>
        </div>
        <div class="notifError" v-if="error != ''">{{error}}</div>
    </div>

    <div class="form" v-else>
        <h3>Utilisateur</h3>
        <input type="text" placeholder="Nom" v-model="oneItem.lastname" @input="setLastname($event.target.value)" :class="{error: $v.form.lastname.$error}">
        <input type="text" placeholder="Prénom" v-model="oneItem.firstname" @input="setFirstname($event.target.value)" :class="{error: $v.form.firstname.$error}">
        <input type="email" placeholder="E-mail" v-model="oneItem.email" @input="setEmail($event.target.value)" :class="{error: $v.form.email.$error}">
        <input type="password" placeholder="Mot de passe" v-model="oneItem.password" @input="setPassword($event.target.value)" :class="{error: $v.form.password.$error}">
        <input type="tel" placeholder="Numéro" v-model="oneItem.phone">
        <input type="text" placeholder="Adresse" v-model="oneItem.address">
        <input type="text" placeholder="Informations additionnelles" v-model="oneItem.additional_info">
        <input type="text" placeholder="Ville" v-model="oneItem.city">
        <input type="number" placeholder="Code postal" v-model="oneItem.zipcode">
        <div>
            <button class="button sendForm" @click.prevent="sendForm">Envoyer</button>
        </div>
        <div class="notifError" v-if="error != ''">{{error}}</div>
    </div>
</template>
<script>
    import {required} from "vuelidate/lib/validators";

    export default {
        props: ['oneItem'],
        data() {
            return {
                error: '',
                routeName: this.$route.name,
                form: {
                    lastname: '',
                    firstname: '',
                    email: '',
                    password: '',
                    address: '',
                    city: '',
                    zipcode: '',
                    additional_info: '',
                    phone: ''
                }
            }
        },
        validations: {
            form: {
                lastname: {
                    required
                },
                firstname: {
                    required
                },
                email: {
                    required
                },
                password: {
                    required
                }
            }
        },
        methods: {
            setLastname(value) {
                this.form.lastname = value
                this.$v.form.lastname.$touch()
            },
            setFirstname(value) {
                this.form.firstname = value
                this.$v.form.firstname.$touch()
            },
            setEmail(value) {
                this.form.email = value
                this.$v.form.email.$touch()
            },
            setPassword(value) {
                this.form.password = value
                this.$v.form.password.$touch()
            },
            sendForm() {
                this.$v.form.$touch()
                if (this.$v.$invalid) {
                    this.error = "Le formulaire n'est pas rempli correctement, veuillez bien remplir les champs en rouge"
                } else {
                    this.$emit('sendEvent', {form: this.form, id: this.oneItem !== null ? this.oneItem.id : null})
                    this.form = {}
                    this.$v.$reset()
                }
            }
        }
    }
</script>
