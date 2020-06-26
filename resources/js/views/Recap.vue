<template>
    <div class="animation recap mrAuto bRadius bgWhite padding20">
        <div class="dFlex justifySpaceB">
            <h3>Votre commande</h3>
            <p>Total: <span CLASS="fontBold colorUmbrella">{{this.$route.params.total}}€</span></p>
        </div>

        <p class="mrTop20">L'équipe de Sneakizy vous remercie pour votre commande et vous souhaite de bonne vacances d'été !</p>

        <div class="product mrTop20" v-for="product in this.$route.params.products">
            <img class="bRadius" :src="product.product.image" :alt="product.product.name">
            <div class="paddingLeft20 dFlex flexColumn justifySpaceB">
                <p class="fontBold colorUmbrella">{{product.product.name.slice(0, 12)}}</p>
                <p class="colorBlack" v-if="product.product.color != ''">{{product.product.color.slice(0, 12)}}</p>
                <p class="colorBlack">Taille: {{product.size}}</p>
                <p class="colorBlack">{{product.quantity}}</p>
                <p class="colorUmbrella fontItalic fontBold">{{Math.round(product.product.price * product.quantity)}}€</p>
            </div>
        </div>

        <p class="fontBold mrTop20">Bénéficier de 15% de réduction lors de votre prochaine commande: <span class="colorUmbrella fontItalic fontBold">IZY15</span></p>
    </div>
</template>
<script>
    export default {
        name: 'recap',
        beforeMount() {
            if (!this.$route.params.products) {
                this.$router.replace({name: 'home'})
            }

            setTimeout(() => {
                let elem = document.querySelector('.animation')
                elem.style.display = 'block'
                elem.style.opacity = '1'
            }, 50)
        }
    }
</script>
<style lang="scss" scoped>
    .recap {
        max-width: 900px;

        .product {
            display: flex;

            img {
                width: 100px;
                height: 100px;
                object-fit: cover;
            }
        }
    }
</style>
