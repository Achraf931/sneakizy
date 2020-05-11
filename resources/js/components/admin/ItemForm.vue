<template>
    <UserInputs @sendEvent="sendForm" v-if="routeName === 'admin/users'" :oneItem="oneItem"/>
    <ProductInputs @sendEvent="sendForm" v-else-if="routeName === 'admin/products'" :oneItem="oneItem"/>
</template>
<script>
    import UserInputs from "./inputs/UserInputs"
    import ProductInputs from "./inputs/ProductInputs";

    export default {
        props: ['itemForEdit', 'oneItem'],
        components: {
            UserInputs,
            ProductInputs
        },
        data() {
            return {
                routeName: this.$route.name
            }
        },
        methods: {
            sendForm(item) {
                this.$emit('send', item)
            }
        }
    }
</script>
<style lang="scss">
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
            font-family: Norms, Arial, sans-serif;
            margin-top: 15px;
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
