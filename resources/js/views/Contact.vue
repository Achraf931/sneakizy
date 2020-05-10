<template>
    <div class="contact animation">
        <div class="boxShadow">
            <div class="left">
                <h2 class="sendTitle colorUmbrella">Envoyez nous un message</h2>
                <div class="formGroup">
                    <div class="vuelidate" :class="{errorForm: $v.form.lastname.$error}">
                        <label for="lastname">Nom</label>
                        <input type="text" id="lastname" v-model.trim="$v.form.lastname.$model" placeholder="Entrez votre nom">
                    </div>
                    <div class="vuelidate" :class="{errorForm: $v.form.firstname.$error}">
                        <label for="firstname">Prénom</label>
                        <input type="text" id="firstname" v-model.trim="$v.form.firstname.$model" placeholder="Entrez votre prénom">
                    </div>
                </div>
                <div class="group vuelidate" :class="{errorForm: $v.form.email.$error}">
                    <label for="email">Email</label>
                    <input type="email" id="email" v-model.trim="$v.form.email.$model" placeholder="Entrez votre adresse mail">
                </div>
                <div class="group vuelidate" :class="{errorForm: $v.form.object.$error}">
                    <label for="object">Objet</label>
                    <input type="text" id="object" v-model.trim="$v.form.object.$model" placeholder="Objet">
                </div>
                <div class="vuelidate" :class="{errorForm: $v.form.message.$error}">
                    <label for="message">Message</label>
                    <textarea id="message" v-model.trim="$v.form.message.$model" placeholder="Entrez votre message"></textarea>
                </div>
                <button class="buttonSend" @click.prevent="sendMail">Envoyer</button>
                <p>Tous les champs sont obligatoires.</p>
            </div>
            <div class="right bgUmbrella">
                <h2>Contact</h2>
                <p>19 rue Yves Toudic 75010 Paris</p>
                <p>01 42 41 97 76</p>
                <p>contact@ecole-webstart.com</p>
            </div>
        </div>
        <iframe class="boxShadow" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.3564642210686!2d2.3608514158922684!3d48.87048077928859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e0989542143%3A0x9384848c375ced98!2s%C3%89cole%20Webstart!5e0!3m2!1sfr!2sfr!4v1587739659654!5m2!1sfr!2sfr" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
</template>
<script>
    import {required} from 'vuelidate/lib/validators'

    export default {
        name: 'contact',
        data() {
            return {
                form: {
                    lastname: '',
                    firstname: '',
                    email: '',
                    object: '',
                    message: ''
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
                object: {
                    required
                },
                message: {
                    required
                }
            }
        },
        beforeMount() {
            setTimeout(() => {
                document.querySelectorAll('.animation').forEach(elem => {
                    elem.style.display = 'flex'
                    elem.style.opacity = '1'
                })
            }, 50)
        },
        methods: {
            sendMail() {
                this.$v.form.$touch()
                if (this.$v.form.required) {
                    console.log('test')
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    .errorForm {
        label {
            color: red;
        }
        input, textarea {
            border: 1px solid red!important;
        }
    }
    .notError {
        label {
            color: initial;
        }
        input, textarea {
            border: 1px solid rgba(116, 142, 170, 0.25);
        }
    }
    .contact {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        iframe {
            margin: 40px 0 20px 0;
            max-width: 1000px;
            width: 100%;
        }
        h2 {
            margin-bottom: 20px;
        }

        & > div {
            border-radius: 10px;
            max-width: 1000px;
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;

            .left {
                background-color: white;
                width: 60%;
                padding: 20px;
                border-radius: 10px;

                .buttonSend {
                    color: white;
                    background-color: #6FBD13;
                    border-color: #6FBD13;
                    display: inline-block;
                    font-weight: 400;
                    text-align: center;
                    margin-top: 20px;
                    vertical-align: middle;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                    padding: .375rem .75rem;
                    font-size: 1rem;
                    line-height: 1.5;
                    border-radius: 10px;
                    cursor: pointer;
                }
                p {
                    font-size: 10px;
                    font-style: italic;
                    margin-top: 10px;
                }
                #message {
                    min-height: 100px;
                }
                .group {
                    margin-bottom: 20px;
                }
                .formGroup {
                    display: flex;
                    margin-bottom: 20px;
                    flex-direction: row;
                    justify-content: space-between;

                    & > div {
                        display: flex;
                        flex-direction: column;
                        width: 50%;
                    }
                    & > div:first-child {
                        padding-right: 10px;
                    }
                    & > div:last-child {
                        padding-left: 10px;
                    }
                }

                input, textarea {
                    display: block;
                    width: 100%;
                    height: calc(1.5em + .75rem + 2px);
                    padding: .375rem .75rem;
                    font-weight: 400;
                    line-height: 1.5;
                    background-color: #fff;
                    background-clip: padding-box;
                    border-radius: .25rem;
                    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
                    border: 1px solid rgba(116, 142, 170, 0.25);
                    color: #748EAA!important;
                    font-size: 12px;
                }
                input:focus, textarea:focus {
                    border: 1px solid #591df1;
                }
            }
            .right {
                color: white;
                border-radius: 0 10px 10px 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-evenly;
                padding: 40px;
                width: 40%;
                font-family: NormsBold, Norms, Arial, sans-serif;
            }
        }
    }
    @media all and (max-width: 837px) {
        .contact > div {
            flex-direction: column;

            .left, .right {
                border-radius: 0;
                width: 100%;
            }
        }
    }
</style>
