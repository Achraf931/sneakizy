<template>
    <div class="register">
        <form>
            <h2>Register</h2>
            <label for="name">Name</label>
            <input id="name" type="text" v-model="lastname" required autofocus>
            <label for="firstname">Firstname</label>
            <input id="firstname" type="text" v-model="firstname" required autofocus>
            <label for="email">E-Mail Address</label>
            <input id="email" type="email" v-model="email" required>
            <label for="password">Password</label>
            <input id="password" type="password" v-model="password" required>
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" v-model="password_confirmation" required>
            <button type="submit" @click.prevent="handleSubmit">Register</button>
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
        methods: {
            handleSubmit(e) {
                if (this.password === this.password_confirmation && this.password !== '') {
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
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                } else {
                    this.password = ""
                    this.passwordConfirm = ""
                    return alert('Passwords do not match')
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    .register {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;

        form {
            max-width: 300px;
            width: 100%;
            display: flex;
            flex-direction: column;
            background: #F7F7F7;
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
                color: white;
                background: black;
                cursor: pointer;
                border: 1px solid black;
                padding: 10px 15px;
                font-weight: bold;
                font-size: 16px;
                border-radius: 10px;
                transition-duration: 400ms;
            }
            button:hover {
                transition-duration: 400ms;
                background: white;
                color: black;
            }
        }
    }
</style>
