<template>
    <div class="login">
        <div class="leftBlack"></div>
        <div class="rightBlock">
            <form>
                <h2>Login</h2>

                <label for="email">E-Mail Address</label>

                <input id="email" type="email" v-model="email" required autofocus>

                <label for="password">Password</label>

                <input id="password" type="password" v-model="password" required>

                <button type="submit" @click="handleSubmit">Login</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'login',
        data() {
            return {
                email: "",
                password: ""
            }
        },
        methods: {
            handleSubmit(e) {
                e.preventDefault()

                if (this.password.length > 0) {
                    axios.post('api/login', {
                        email: this.email,
                        password: this.password
                    })
                        .then(response => {
                            let is_admin = response.data.user.is_admin
                            localStorage.setItem('user', JSON.stringify(response.data.user))
                            localStorage.setItem('jwt', response.data.token)

                            if (localStorage.getItem('jwt') != null) {
                                this.$emit('loggedIn')
                                if (this.$route.params.nextUrl != null) {
                                    this.$router.push(this.$route.params.nextUrl)
                                } else {
                                    if (is_admin) {
                                        this.$router.push('admin')
                                    } else {
                                        this.$router.push('dashboard')
                                    }
                                }
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                }
            }
        },
    }
</script>
<style lang="scss" scoped>
    main {
        padding-bottom: 0;
    }
    .login {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;

        & > div {
            width: 50%;
            height: 100%;
        }

        & > .leftBlack {
            background: url('https://mir-s3-cdn-cf.behance.net/project_modules/1400_opt_1/87210d28129331.5637016dd9d83.jpg') no-repeat;
            background-size: 100% 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 80px;
        }

        & > .rightBlock {
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
    }
</style>
