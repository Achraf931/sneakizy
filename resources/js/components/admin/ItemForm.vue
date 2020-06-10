<template>
    <UserInputs @sendEvent="sendForm" v-if="routeName === 'admin/users'" :oneItem="oneItem"/>
    <ProductInputs @sendEvent="sendForm" v-else-if="routeName === 'admin/products'" :oneItem="oneItem"/>
    <ArticleInputs @sendEvent="sendForm" v-else-if="routeName === 'admin/news'" :oneItem="oneItem"/>
    <BrandInputs @sendEvent="sendForm" v-else-if="routeName === 'admin/brands'" :oneItem="oneItem"/>
</template>
<script>
    import UserInputs from "./inputs/UserInputs"
    import ProductInputs from "./inputs/ProductInputs"
    import ArticleInputs from "./inputs/ArticleInputs"
    import BrandInputs from "./inputs/BrandInputs"

    export default {
        props: ['itemForEdit', 'oneItem'],
        components: {
            ArticleInputs,
            UserInputs,
            ProductInputs,
            BrandInputs
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

        h3:first-child {
            margin-top: 0;
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

    .disabled {
        transition: background .2s ease;
        background-color: transparent!important;
        color: transparent!important;
    }
    .input-file {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .file-return {
        margin: 0;
    }
    .file-return:not(:empty) {
        margin: 1em 0;
    }
    .file-return {
        font-style: italic;
        font-size: .9em;
        font-weight: bold;
    }
    .file-return:not(:empty):before {
        content: "Selected file: ";
        font-style: normal;
        font-weight: normal;
    }


    .lds-ellipsis {
        display: inline-block;
        position: absolute;
        width: 126px;
        height: 126px;
        background: white;
        border-radius: 5px;
    }
    .lds-ellipsis div {
        position: absolute;
        top: 50%;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #591df1;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }
    .lds-ellipsis div:nth-child(1) {
        left: 35px;
        animation: lds-ellipsis1 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(2) {
        left: 35px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(3) {
        left: 59px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(4) {
        left: 81px;
        animation: lds-ellipsis3 0.6s infinite;
    }
    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
    }
    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(24px, 0);
        }
    }
</style>
