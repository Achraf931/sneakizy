<template>
    <div style="margin-bottom: 40px" class="containerCheckout dFlex justifySpaceB">
        <div class="containerForm justifySpaceB dFlex mrRight20" style="padding-right: 0!important;">
            <section style="height: fit-content" class="padding20 bgWhite bRadius boxShadow">
                <h3 class="mrBottom20">Infos</h3>

                <div class="dFlex justifySpaceB field">

                    <div class="mrRight10" :class="{errorForm: $v.user.lastname.$error}">
                        <label class="labelColor" for="lastname">Nom*</label>
                        <input id="lastname" class="input" type="text" v-model.trim="user.lastname" @input="setLastname($event.target.value)" placeholder="Nom">
                    </div>

                    <div :class="{errorForm: $v.user.firstname.$error}">
                        <label class="labelColor" for="firstname">Prénom*</label>
                        <input class="input" id="firstname" type="text" v-model.trim="user.firstname" @input="setFirstname($event.target.value)" placeholder="Prénom">
                    </div>
                </div>

                <div class="field" :class="{errorForm: $v.user.address.$error}">
                    <label class="labelColor" for="address">Adresse*</label>
                    <input class="input" id="address" type="text" v-model.trim="user.address" @input="setAddress($event.target.value)" placeholder="Adresse">
                </div>

                <div class="field">
                    <label class="labelColor" for="additional_info">Complément d'adresse</label>
                    <input class="input" id="additional_info" type="text" v-model.trim="user.additional_info" placeholder="Complément d'adresse">
                </div>

                <div class="dFlex justifySpaceB field">
                    <div class="mrRight10" :class="{errorForm: $v.user.city.$error}">
                        <label class="labelColor" for="city">Ville*</label>
                        <input class="input" id="city" type="text" v-model.trim="user.city" @input="setCity($event.target.value)" placeholder="Ville">
                    </div>
                    <div :class="{errorForm: $v.user.zipcode.$error}">
                        <label class="labelColor" for="zipcode">Code postal*</label>
                        <input class="input" id="zipcode" type="number" v-model.trim="user.zipcode" @input="setZipcode($event.target.value)" placeholder="Code postal">
                    </div>
                </div>

                <div class="field" :class="{errorForm: $v.user.email.$error}">
                    <label class="labelColor" for="email">E-mail</label>
                    <input class="input" id="email" type="text" v-model.trim="user.email" @input="setEmail($event.target.value)" placeholder="E-mail">
                </div>

                <small style="font-size: 10px" class="labelColor mrTop10 fontItalic">*Champs obligatoires.</small>
            </section>

            <section style="height: fit-content" class="paddingTop20 paddingBottom20 mrLeft20 bgWhite bRadius boxShadow">
                <h3 class="mrBottom20 paddingRight20 paddingLeft20">Payment</h3>
                <small class="paddingRight20 paddingLeft20 labelColor">Card type</small>
                <div class="containerCardType dFlex mrTop10 paddingRight20 paddingLeft20">
                    <p class="mrRight10" :class="{selected: cardType === 0}" @click="cardType = 0">CB</p>
                    <p :class="{selected: cardType === 1}" @click="cardType = 1">Paypal</p>
                </div>

                <div class="paddingRight20 paddingLeft20 mrTop20" v-if="cardType === 0">
                    <div class="field" :class="{errorForm: $v.user.cardName.$error}">
                        <label class="labelCardName" for="cardName">Nom complet*</label>
                        <input class="input" id="cardName" type="text" v-model.trim="user.cardName" @input="setCardName($event.target.value)" placeholder="Nom complet">
                    </div>
                    <div class="field" :class="{errorForm: $v.user.cardCode.$error}">
                        <label class="labelCardCode" for="cardCode">Numéro de carte*</label>
                        <input class="input" id="cardCode" type="text" v-model.trim="user.cardCode" maxlength="16" @input="setCardCode($event.target.value)" placeholder="Numéro de carte">
                    </div>


                    <div class="dFlex justifySpaceB field">
                        <div class="mrRight10" :class="{errorForm: $v.user.cardDate.$error}">
                            <label class="labelCardDate" for="cardDate">Expiration (mm/yy)*</label>
                            <input class="input" id="cardDate" type="text" v-model.trim="user.cardDate" maxlength="5" @keyup="formatDate($event.target.value)" @input="setCardDate($event.target.value)" placeholder="Expiration">
                        </div>
                        <div :class="{errorForm: $v.user.cardCVC.$error}">
                            <label class="labelCardCVC" for="cardCVC">CVC*</label>
                            <input class="input" id="cardCVC" type="text" v-model.trim="user.cardCVC" maxlength="4" @input="setCardCVC($event.target.value)" placeholder="CVC">
                        </div>
                    </div>
                </div>

                <div v-if="cardType === 0" class="dFlex paddingLeft20 paddingRight20 justifyEnd">
                    <button @click.prevent="sendForm" class="button bRadius payButton paddingRight20 paddingLeft20 cPointer">Payer</button>
                </div>
            </section>
        </div>

        <div class="containerProducts padding20 bRadius bgUmbrella boxShadow" style="height: fit-content">
            <h3 class="colorWhite mrBottom5">Produits</h3>

            <div>
                <div v-for="product in basket" class="dFlex justifySpaceB mrTop20">
                    <img style="width: 100px; height: 100px; object-fit: cover" class="bRadius" :src="product.product.image" :alt="product.product.name">
                    <div>
                        <p class="fontBold colorWhite">{{product.product.name.slice(0, 12)}}</p>
                        <p class="colorWhite" v-if="product.product.color != ''">{{product.product.color.slice(0, 12)}}</p>
                        <p class="colorWhite">Taille: {{product.size}}</p>
                    </div>
                    <div class="dFlex flexColumn alignEnd justifySpaceB">
                        <p class="quantity dFlex justifyCenter alignCenter cPointer colorUmbrella bgWhite borderWhite fontBold">{{product.quantity}}</p>
                        <p class="fontBold colorWhite">{{Math.round(product.product.price * product.quantity)}}€</p>
                    </div>
                </div>
            </div>

            <hr class="mrTop20" style="border: 1px solid white">

            <div class="mrTop5 colorWhite dFlex justifySpaceB">
                <p class="fontBold">Total</p>
                <p class="fontBold">{{basketTotalPrice}}€</p>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import {required, email, maxLength, minLength, numeric} from "vuelidate/lib/validators";

    export default {
        name: 'checkout',
        data() {
            return {
                loaded: false,
                paidFor: false,
                cardInfo: null,
                card: null,
                cardType: null,
                user: JSON.parse(localStorage.getItem('user')) ? JSON.parse(localStorage.getItem('user')) : {
                    lastname: '',
                    firstname: '',
                    email: '',
                    address: '',
                    zipcode: '',
                    city: '',
                    cardName: '',
                    cardDate: '',
                    cardCVC: '',
                    cardCode: ''
                }
            }
        },
        computed: {
            ...mapGetters({
                basket: 'basket/basket',
                basketItemCount: 'basket/basketItemCount',
                basketTotalPrice: 'basket/basketTotalPrice'
            })
        },
        validations: {
            user: {
                lastname: {
                    required
                },
                firstname: {
                    required
                },
                email: {
                    required,
                    email
                },
                address: {
                    required
                },
                zipcode: {
                    minLength: minLength(5),
                    maxLength: maxLength(5),
                    numeric,
                    required
                },
                city: {
                    required
                },
                cardName: {
                    required
                },
                cardDate: {
                    required,
                    minLength: minLength(5),
                    maxLength: maxLength(5)
                },
                cardCVC: {
                    required,
                    numeric,
                    minLength: minLength(3),
                    maxLength: maxLength(4)
                },
                cardCode: {
                    required,
                    numeric,
                    minLength: minLength(16),
                    maxLength: maxLength(16)
                }
            }
        },
        beforeMount() {
            if (!JSON.parse(localStorage.getItem('basket')))
                this.$router.replace({name: 'basket'})
        },
        methods: {
            setCardName(value) {
                this.user.cardName = value
                this.$v.user.cardName.$touch()
            },
            setCardDate(value) {
                this.user.cardDate = value
                this.$v.user.cardDate.$touch()
            },
            setCardCVC(value) {
                this.user.cardCVC = value
                this.$v.user.cardCVC.$touch()
            },
            setCardCode(value) {
                this.user.cardCode = value
                this.$v.user.cardCode.$touch()
            },
            setLastname(value) {
                this.user.cardCode = value
                this.$v.user.lastname.$touch()
            },
            setFirstname(value) {
                this.user.firstname = value
                this.$v.user.firstname.$touch()
            },
            setEmail(value) {
                this.user.email = value
                this.$v.user.email.$touch()
            },
            setAddress(value) {
                this.user.address = value
                this.$v.user.address.$touch()
            },
            setZipcode(value) {
                this.user.zipcode = value
                this.$v.user.zipcode.$touch()
            },
            setCity(value) {
                this.user.city = value
                this.$v.user.city.$touch()
            },
            formatDate(value) {
                if (value.length === 2) {
                    this.user.cardDate += '/'
                }
            },
            sendForm() {
                this.$v.user.$touch()
                if (this.$v.$invalid) {
                    this.$store.dispatch("notifications/AddNotification", {notification: "Veuillez remplir les champs en rouge", type: 0})
                } else {
                    this.user.products = this.basket
                    this.$store.dispatch("loader/OpenLoader", true)
                    axios.post('/api/checkout', this.user).then(res => {
                        if (res.data) {
                            this.$v.$reset()
                            this.$store.dispatch("loader/OpenLoader", false)
                            this.$router.replace({name: 'recap', params: {products: this.user.products, total: this.basketTotalPrice}})
                            this.$store.dispatch('basket/ClearBasket')
                        }
                    })
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

    input:focus, #name:focus {
        transition: all .2s ease;
        border: 1px solid #591df1!important;
    }

    label {
        font-size: 13.333px;
    }

    .containerCheckout {
        max-width: 1000px;
        margin: auto;

        .field {
            position: relative;
            width: 100%;
            margin: 20px 0;
        }

        .field:first-child {
            margin-top: 0!important;
        }

        .containerForm {
            max-width: 70%;
            width: 100%;
            height: fit-content;

            & > section {
                width: 50%;
            }
        }

        .containerProducts {
            max-width: 30%;
            width: 100%;

            ::-webkit-scrollbar {
                width: 2px!important;
                left: 2px;
                height: 2px!important;
                border-radius: 10px;
            }

            ::-webkit-scrollbar-button {
                display: none;
            }

            ::-webkit-scrollbar-thumb {
                mso-background: white;
                background: white!important;
                width: 2px!important;
                height: 2px!important;
                border-radius: 10px;
            }

            .quantity {
                height: 30px;
                width: 30px;
                border-radius: 5px;
                color: white;
            }
        }

        .containerCardType {
            justify-content: space-between;
            max-height: 500px;
            transition: all .2s ease;

            & > p {
                display: flex;
                padding: 20px;
                border: 1px solid #f0f3ff;
                background: #f0f3ff;
                color: #93a2dd;
                border-radius: 10px;
                width: 140px;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                transition: all .2s ease;
            }

            & > p:hover {
                border-color: #591df1;
                color: #591df1;
            }

            .selected {
                background: #591df1!important;
                border-color: #591df1!important;
                color: white!important;
                font-family: NormsBold, Norms, Arial, sans-serif!important;
            }
        }

        .payButton {
            padding: 10px 15px;
        }

        .input {
            box-sizing: border-box;
            margin-top: 3px;
            padding: 15px;
            font-size: 16px;
            width: 100%;
            border-radius: 3px;
            border: 1px solid #dcdcdc;
        }
    }
</style>
