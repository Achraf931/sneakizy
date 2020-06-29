<template>
    <div class="register animation">
        <form class="boxShadow">
            <h2>Register</h2>
            <div class="group vuelidate">
                <label for="name">Name</label>
                <input id="name" type="text" v-model="lastname" placeholder="Entrez votre nom">
            </div>
            <label for="firstname">Firstname</label>
            <input id="firstname" type="text" v-model="firstname" required autofocus>

            <label for="email">E-Mail Address</label>
            <input id="email" type="email" v-model="email" required>

            <label for="password">Password</label>
            <input id="password" type="password" v-model="password" required>

            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" v-model="password_confirmation" required>

            <button class="button" type="submit" @click.prevent="handleSubmit">Register</button>
            <p class="textCenter mrTop5">Vous avez déjà un compte ?<br><router-link class="colorUmbrella" :to="{name: 'login'}">Connectez-vous ici !</router-link></p>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'register',
        props: ['nextUrl'],
        data() {
            return {
                lastname: "",
                firstname: "",
                email: "",
                password: "",
                password_confirmation: ""
            }
        },
        beforeMount() {
            setTimeout(() => {
                let elem = document.querySelector('.animation')
                elem.style.display = 'flex'
                elem.style.opacity = '1'
            }, 50)
        },
        methods: {
            setLastname(value) {
                this.lastname = value
                this.$v.lastname.$touch()
            },
            setFirstname(value) {
                this.firstname = value
                this.$v.firstname.$touch()
            },
            setEmail(value) {
                this.email = value
                this.$v.email.$touch()
            },
            setPassword(value) {
                this.object = value
                this.$v.object.$touch()
            },
            setPasswordConfirm(value) {
                this.message = value
                this.$v.message.$touch()
            },
            handleSubmit(e) {
                if (this.password === this.password_confirmation && this.password !== '') {
                    this.$store.dispatch('loader/OpenLoader', true)
                    axios.post('/api/register', {
                        lastname: this.lastname,
                        firstname: this.firstname,
                        email: this.email,
                        password: this.password,
                        c_password: this.password_confirmation
                    })
                        .then(response => {
                            let data = response.data
                            localStorage.setItem('user', JSON.stringify(data.user))
                            localStorage.setItem('jwt', data.token)
                            if (localStorage.getItem('jwt') != null) {
                                this.$emit('loggedIn')
                                let nextUrl = this.$route.params.nextUrl
                                this.$router.push((nextUrl != null ? nextUrl : '/'))
                                this.$store.dispatch('loader/OpenLoader', false)
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                } else {
                    this.password = ""
                    this.passwordConfirm = ""
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
    .register {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

        form {
            max-width: 300px;
            width: 100%;
            display: flex;
            flex-direction: column;
            background: white;
            padding: 15px;
            border-radius: 10px;

            h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            label {
                font-weight: bold;
            }

            input {
                max-width: 300px;
                width: 100%;
                border: 1px solid lightgray;
                padding: 10px 15px;
                font-size: 16px;
                border-radius: 10px;
                margin-bottom: 10px;
            }
            button {
                margin-top: 10px;
                max-width: 300px;
                width: 100%;
                cursor: pointer;
                padding: 10px 15px;
                font-weight: bold;
                font-size: 16px;
                border-radius: 10px;
            }
        }
    }
</style>
