<template>
    <div class="app" :class="mode ? 'dark' : ''">
        <Notification/>
        <Loader/>
        <Nav :lastname="lastname" :is_admin="is_admin" :isLoggedIn="isLoggedIn"/>
        <main>
            <router-view @logout="logout" @loggedIn="change"></router-view>
        </main>
        <Footer/>
    </div>
</template>
<script>
    import Notification from "../components/Notification"
    import Nav from '../components/Nav'
    import Search from '../components/Search'
    import Footer from '../components/Footer'
    import {bus} from '../app'
    import Loader from '../components/Loader'

    export default {
        data() {
            return {
                chrono: null,
                duree: 500,
                mode: false,
                search: '',
                lastname: null,
                is_admin: false,
                isLoggedIn: localStorage.getItem('jwt') != null
            }
        },
        created() {
            bus.$on('search', result => {
                this.$store.dispatch('products/getSearchProducts', result)
            })
        },
        components: {
            Nav,
            Search,
            Footer,
            Loader,
            Notification,
        },
        beforeMount() {
            window.addEventListener("DOMContentLoaded", () => {
                bus.$emit('loading', true)
            });
        },
        mounted() {
            this.setDefaults()
        },
        methods: {
            setDefaults() {
                if (this.isLoggedIn) {
                    let user = JSON.parse(localStorage.getItem('user'))
                    this.lastname = user.lastname
                    this.is_admin = user.is_admin
                }
            },
            change() {
                this.isLoggedIn = localStorage.getItem('jwt') != null
                this.setDefaults()

            },
            logout() {
                localStorage.removeItem('jwt')
                localStorage.removeItem('user')
                this.change()
                this.$router.push('/')
            }
        }
    }
</script>
<style lang="scss">
    .dark {
        background: radial-gradient(circle at top right, #252525, #2E2E2E, black);
        animation: opacity .2s;

        nav {
            background: transparent;

            ul .basketIcon > a svg {
                color: white;
            }

            .head > a > p {
                color: white !important;
            }

            ul, li, a {
                color: white;
            }
        }
    }


    //  Fonts
    @font-face {
        font-family: Norms;
        src: url("/fonts/TTNorms-Regular.otf");
    }

    @font-face {
        font-family: NormsLight;
        src: url("/fonts/TTNorms-Light.otf");
    }

    @font-face {
        font-family: NormsBold;
        src: url("/fonts/TTNorms-Bold.otf");
    }

    @font-face {
        font-family: NormsBlack;
        src: url("/fonts/TTNorms-Black.otf");
    }


    //  Default
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        text-decoration: none;
        list-style: none;
        outline: none !important;
        font-family: Norms, Poppins, Arial, sans-serif;
    }

    html, body {
        background-color: #F9F9FC;
        color: black;
        font-weight: 200;
        scrollbar-base-color: #591df1;
        scroll-behavior: smooth;
    }

    *::-webkit-scrollbar {
        width: 5px !important;
        height: 5px!important;
        border-radius: 10px;
    }

    *::-webkit-scrollbar-thumb {
        mso-background: #591df1;
        background: #591df1!important;
        width: 5px !important;
        height: 5px!important;
        border-radius: 10px;
    }

    ::selection {
        color: white;
        background: #591df1;
    }

    button {
        background: #591df1;
        font-family: Norms, Poppins, Arial, sans-serif;
        user-select: none;
    }

    main {
        padding: 120px 0 0 0;
        width: 100%;
        max-width: 100vw;
    }

    img {
        image-rendering: -webkit-optimize-contrast!important;
    }

    .app {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    nav {
        a {
            color: #2c3e50;
            background: white;
            border-radius: 10px;
            font-size: 14px;
            font-family: Poppins, Norms, Arial, sans-serif;
            padding: 10px;
            transition: all .2s ease;

            &.router-link-exact-active {
                background: #f0f3ff;
                color: #591df1!important;
            }
        }
    }

    .fade-enter-active, .fade-leave-to {
        transition: opacity 500ms;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    footer {
        background: #591df1;
        color: #f5f4fa;
    }


    //  Utilities
    .dGrid {
        display: grid;
    }

    .dInlineGrid {
        display: inline-grid;
    }

    .dFlex {
        display: flex;
    }

    .justifyCenter {
        justify-content: center;
    }

    .justifyStart {
        justify-content: start;
    }

    .justifyEnd {
        justify-content: flex-end;
    }

    .justifySpaceA {
        justify-content: space-around;
    }

    .justifySpaceB {
        justify-content: space-between;
    }

    .justifySpaceE {
        justify-content: space-evenly;
    }

    .alignCenter {
        align-items: center;
    }

    .alignStart {
        align-items: flex-start;
    }

    .alignEnd {
        align-items: flex-end;
    }

    .flexRow {
        flex-direction: row;
    }

    .flexColumn {
        flex-direction: column;
    }

    .flexWrap {
        flex-wrap: wrap;
    }

    .bRadius {
        border-radius: 10px;
    }

    .bRadiusFive {
        border-radius: 5px;
    }

    .bgWhite {
        background: white;
    }

    .alignItemsCenter {
        align-items: center;
    }

    //  Margin
    .mrAuto {
        margin: auto;
    }

    .mrTop0 {
        margin-top: 0;
    }

    .mrBottom0 {
        margin-bottom: 0;
    }

    .mrLeft0 {
        margin-left: 0!important;
    }

    .mrRight0 {
        margin-right: 0;
    }

    .mrTop0 {
        margin-top: 0;
    }

    .mr0 {
        margin: 0;
    }

    .mrTop5 {
        margin-top: 5px;
    }

    .mrBottom5 {
        margin-bottom: 5px;
    }

    .mrLeft5 {
        margin-left: 5px;
    }

    .mrRight5 {
        margin-right: 5px;
    }

    .margin5 {
        margin: 5px;
    }

    .mrTop10 {
        margin-top: 10px;
    }

    .mrBottom10 {
        margin-bottom: 10px;
    }

    .mrLeft10 {
        margin-left: 10px;
    }

    .mrRight10 {
        margin-right: 10px;
    }

    .margin10 {
        margin: 10px;
    }

    .mrTop20 {
        margin-top: 20px;
    }

    .mrBottom20 {
        margin-bottom: 20px;
    }

    .mrLeft20 {
        margin-left: 20px;
    }

    .mrRight20 {
        margin-right: 20px;
    }

    .margin20 {
        margin: 20px;
    }

    .mrTop30 {
        margin-top: 30px;
    }

    .mrBottom30 {
        margin-bottom: 30px;
    }

    .mrLeft30 {
        margin-left: 30px;
    }

    .mrRight30 {
        margin-right: 30px;
    }

    .margin30 {
        margin: 30px;
    }


    //  Padding
    .paddingTop5 {
        padding-top: 5px;
    }

    .paddingBottom5 {
        padding-bottom: 5px;
    }

    .paddingLeft5 {
        padding-Left: 5px;
    }

    .paddingRight5 {
        padding-right: 5px;
    }

    .padding5 {
        padding: 5px;
    }

    .paddingTop10 {
        padding-top: 10px;
    }

    .paddingBottom10 {
        padding-bottom: 10px;
    }

    .paddingLeft10 {
        padding-Left: 10px;
    }

    .paddingRight10 {
        padding-right: 10px;
    }

    .padding10 {
        padding: 10px;
    }

    .paddingTop20 {
        padding-top: 20px;
    }

    .paddingBottom20 {
        padding-bottom: 20px;
    }

    .paddingLeft20 {
        padding-Left: 20px;
    }

    .paddingRight20 {
        padding-right: 20px;
    }

    .padding20 {
        padding: 20px;
    }

    .paddingTop30 {
        padding-top: 30px;
    }

    .paddingBottom30 {
        padding-bottom: 30px;
    }

    .paddingLeft30 {
        padding-Left: 30px;
    }

    .paddingRight30 {
        padding-right: 30px;
    }

    .padding10 {
        padding: 10px;
    }

    .padding15 {
        padding: 15px;
    }

    .padding20 {
        padding: 20px;
    }

    .padding30 {
        padding: 30px;
    }


    //  Carousel CSS
    .carouselCssH {
        overflow-x: auto;
        overflow-y: hidden;
        overscroll-behavior-x: contain;
        scroll-snap-type: x mandatory;
    }

    .childCarouselStart {
        scroll-snap-align: start;
    }

    .childCarouselCenter {
        scroll-snap-align: center;
    }

    .colorWhite {
        color: white;
    }

    .colorBlack {
        color: black;
    }

    .colorGrey {
        color: grey;
    }

    .borderUmbrella {
        border: 2px solid #591df1!important;
    }


    .borderWhite {
        border: 2px solid white!important;
    }

    .colorUmbrella {
        color: #591df1!important;
    }

    .labelColor {
        color: #707070;
    }

    .bgUmbrella {
        background: #591df1;
    }

    .bgWhite {
        background: white!important;
    }

    .fontRegular {
        font-family: Norms, Arial, sans-serif!important;
    }

    .fontBold {
        font-family: NormsBold, Norms, Arial, sans-serif!important;
    }

    .fontLight {
        font-family: NormsLight, Norms, Arial, sans-serif!important;
    }

    .fontS12 {
        font-size: 12px;
    }

    .fontItalic {
        font-style: italic;
    }

    .textCenter {
        text-align: center;
    }

    .textStart {
        text-align: start;
    }

    .boxShadow {
        box-shadow: 0 0 13px 0 rgba(82,63,105,.05);
    }

    .animation {
        display: none;
        opacity: 0;
        transition: opacity 500s;
    }

    .button {
        color: white;
        font-family: Norms;
        border: 1px solid #591df1;
        background-color: #591df1;
    }

    .button:active {
        transition: all 0.2s ease;
        transform: scale(0.96);
    }

    .paddingButton {
        padding: 10px 15px;
    }

    .imgFullCover {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cPointer {
        cursor: pointer;
    }


    //  Position
    .pRelative {
        position: relative;
    }
    .pAbsolute {
        position: absolute;
    }

    .absoluteCenter {
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .top0 {
        top: 0;
    }

    .left0 {
        left: 0;
    }

    .right0 {
        right: 0;
    }

    .bottom0 {
        bottom: 0;
    }

    .top15 {
        top: 15px;
    }

    .left15 {
        left: 15px;
    }

    .right15 {
        right: 15px;
    }

    .bottom15 {
        bottom: 15px;
    }


    //  Width and Height
    .fullWidth {
        width: 100%;
    }

    .widthContent {
        width: fit-content;
    }

    .fullHeight {
        height: 100%;
    }

    //  Z-index
    .zIndex50 {
        z-index: 50;
    }

    .zIndex100 {
        z-index: 100;
    }

    .zIndex150 {
        z-index: 150;
    }

    .zIndex200 {
        z-index: 200;
    }

    //  Responsive
    @media all and (max-width: 837px) {
        main {
            padding: 110px 0 0 0;
        }
    }

    @media all and (max-width: 749px) {
        body::-webkit-scrollbar {
            display: none;
        }
    }
</style>
