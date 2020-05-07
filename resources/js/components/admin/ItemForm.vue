<template>
    <div class="form" v-if="routeName === 'admin/users' && oneItem === null">
        <h3>Utilisateur</h3>
<!--        <input type="text" placeholder="Nom" v-model="$v.form.user.lastname.$model" :class="{error: $v.form.user.lastname.$error}">
        <input type="text" placeholder="Prénom" v-model="$v.form.user.firstname.$model" :class="{error: $v.form.user.firstname.$error}">
        <input type="email" placeholder="E-mail" v-model="$v.form.user.email.$model" :class="{error: $v.form.user.email.$error}">
        <input type="password" placeholder="Mot de passe" v-model="$v.form.user.password.$model" :class="{error: $v.form.user.password.$error}">
        -->
        <input type="text" placeholder="Nom" v-model="user.lastname" :class="{error: $v.form.user.lastname.$error}">
        <input type="text" placeholder="Prénom" v-model="user.firstname" :class="{error: $v.form.user.firstname.$error}">
        <input type="email" placeholder="E-mail" v-model="user.email" :class="{error: $v.form.user.email.$error}">
        <input type="password" placeholder="Mot de passe" v-model="user.password" :class="{error: $v.form.user.password.$error}">
        <input type="tel" placeholder="Numéro" v-model="user.phone">
        <input type="text" placeholder="Adresse" v-model="user.address">
        <input type="text" placeholder="Informations additionnelles" v-model="user.additional_info">
        <input type="text" placeholder="Ville" v-model="user.city">
        <input type="number" placeholder="Code postal" v-model="user.zipcode">
        <div>
            <button class="button sendForm" @click="sendForm(user)">Envoyer</button>
        </div>
        <div class="notifError" v-if="error != ''">{{error}}</div>
    </div>

    <div class="form" v-else-if="routeName === 'admin/products' && oneItem === null">
        <h3>Produit</h3>
        <input type="text" placeholder="Nom" v-model="$v.form.product.name.$model" :class="{error: $v.form.product.name.$error}">
        <input type="text" placeholder="Marque" v-model="$v.form.product.brand.$model" :class="{error: $v.form.product.brand.$error}">
        <textarea placeholder="Description" v-model="$v.form.product.description.$model" :class="{error: $v.form.product.description.$error}">{{product.description}}</textarea>
        <input type="number" placeholder="Prix" v-model="$v.form.product.price.$model" :class="{error: $v.form.product.price.$error}">
        <input type="file" id="image"> <!--v-on:change="product.image"-->
          <div>
              <button class="button sendForm" @click="sendForm(product)">Envoyer</button>
        </div>
        <div class="notifError" v-if="error != ''">{{error}}</div>
    </div>




    <div class="form" v-else-if="routeName === 'admin/users' && oneItem !== null">
        <h3>Utilisateur</h3>
<!--        <input type="text" placeholder="Nom" v-model="$v.form.user.lastname.$model" :class="{error: $v.form.user.lastname.$error}">
        <input type="text" placeholder="Prénom" v-model="$v.form.user.firstname.$model" :class="{error: $v.form.user.firstname.$error}">
        <input type="email" placeholder="E-mail" v-model="$v.form.user.email.$model" :class="{error: $v.form.user.email.$error}">
        <input type="password" placeholder="Mot de passe" v-model="$v.form.user.password.$model" :class="{error: $v.form.user.password.$error}">
        -->
        <input type="text" placeholder="Nom" v-model="oneItem.lastname" :class="{error: $v.form.user.lastname.$error}">
        <input type="text" placeholder="Prénom" v-model="oneItem.firstname" :class="{error: $v.form.user.firstname.$error}">
        <input type="email" placeholder="E-mail" v-model="oneItem.email" :class="{error: $v.form.user.email.$error}">
        <input type="password" placeholder="Mot de passe" v-model="oneItem.password" :class="{error: $v.form.user.password.$error}">
        <input type="tel" placeholder="Numéro" v-model="oneItem.phone">
        <input type="text" placeholder="Adresse" v-model="oneItem.address">
        <input type="text" placeholder="Informations additionnelles" v-model="oneItem.additional_info">
        <input type="text" placeholder="Ville" v-model="oneItem.city">
        <input type="number" placeholder="Code postal" v-model="oneItem.zipcode">
        <div>
            <button class="button sendForm" @click="sendForm(user)">Envoyer</button>
        </div>
        <div class="notifError" v-if="error != ''">{{error}}</div>
    </div>

    <div class="form" v-else-if="routeName === 'admin/products' && oneItem !== null">
        <h3>Produit</h3>
        <input type="text" placeholder="Nom" v-model="oneItem.name" :class="{error: $v.form.product.name.$error}">
        <input type="text" placeholder="Marque" v-model="oneItem.brand" :class="{error: $v.form.product.brand.$error}">
        <textarea style="min-height: 100px" placeholder="Description" v-model="oneItem.description" :class="{error: $v.form.product.description.$error}">{{product.description}}</textarea>
        <input type="number" placeholder="Prix" v-model="oneItem.price" :class="{error: $v.form.product.price.$error}">
        <input type="file">
        <h3>Image principale</h3>
        <img style="width: 200px" :src="oneItem.image" :alt="oneItem.name">
        <h3>Images secondaires</h3>
        <div style="display: grid; grid-gap: 20px; grid-template-columns: repeat(auto-fit, 126px);">
            <img style="width: 120px; height: 120px; object-fit: cover;" v-for="img in oneItem.images" :key="img.id" :src="img.image" :alt="img.name">
        </div>
          <div>
              <button class="button sendForm" @click="sendForm(product)">Envoyer</button>
        </div>
        <div class="notifError" v-if="error != ''">{{error}}</div>
    </div>
</template>
<script>
    import {required} from 'vuelidate/lib/validators'

    export default {
        props: ['itemForEdit', 'oneItem'],
        data() {
            return {
                error: '',
                routeName: this.$route.name,
                product: {
                    name: '',
                    price: '',
                    description: '',
                    image: null,
                    is_published: 1,
                    brand: '',
                    brand_id: 1
                },
                user: {
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
                product: {
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
                },
                user: {
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
            }
        },
        methods: {
            sendForm(item) {
/*                this.$v.form.$touch()
                console.log(this.$v.$invalid)
                if (this.$v.$invalid) {
                    this.error = "Le formulaire n'est pas rempli correctement, veuillez bien remplir les champs en rouge"
                } else {
                    this.$emit('send', item)
                }*/


                if (this.oneItem !== null) {
                    this.$emit('send', this.oneItem)
                }
                else {
                    this.$emit('send', item)
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    .notifError {
        width: 100%;
        border-radius: 5px;
        background: #F8D7DA;
        color: #934D55;
        text-align: center;
        padding: 15px;
        margin-top: 15px;
        transition: all .2s ease;
    }
    .error {
        color: red;
        border: 1px solid red!important;
    }

    .form {
        width: 100%;
        display: flex;
        flex-direction: column;

        h3 {
            color: #591df1;
            font-family: NormsBold, Norms, Arial, sans-serif;
            margin-bottom: 15px;
        }

        input, textarea {
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1.5px solid #EEEEEE;
            font-size: 13px;
            color: #595d6e;
            line-height: 1.4;
            text-transform: none;
            background-clip: padding-box;
            background-color: white;
            box-sizing: border-box;
        }

        .sendForm {
            margin-top: 15px;
            padding: 10px 15px;
            border-radius: 5px;
        }
    }
</style>
