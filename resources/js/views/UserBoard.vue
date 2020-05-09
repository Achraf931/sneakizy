<template>
    <div class="userBoard">
        <section class="boxShadow containerProfil mrRight20 bRadius bgWhite">
            <h3 class="mrBottom10">{{user.lastname}} {{user.firstname}}</h3>
            <p class="mrBottom10"><span>E-mail</span> {{user.email}}</p>
            <p class="mrBottom10"><span>Numéro</span> {{user.phone !== null ? user.phone : 'Non renseigné'}}</p>
            <p class="mrBottom10"><span>Adresse</span> {{user.address !== null ? user.address : 'Non renseigné'}}</p>
            <p class="mrBottom10"><span>Infos</span> {{user.additional_info !== null ? user.additional_info : 'Non renseigné'}}</p>
            <p class="mrBottom10"><span>Ville</span> {{user.city !== null ? user.city : 'Non renseigné'}}</p>
            <p class="mrBottom10"><span>Code postal</span> {{user.zipcode !== null ? user.zipcode : 'Non renseigné'}}</p>
        </section>
        <section class="boxShadow containerRight mrRight20 bRadius bgWhite">

        </section>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'
    export default {
        name: 'userboard',
        computed: {
            ...mapGetters({
                user: 'users/user'
            })
        },
        beforeMount() {
            let user = JSON.parse(localStorage.getItem('user'))
            this.$store.dispatch('users/getUser', user.id)
        }
    }
</script>
<style lang="scss" scoped>
    .userBoard {
        max-width: 1050px;
        margin: auto;
        display: flex;
        justify-content: space-between;
        padding: 0 15px 40px 15px;

        .containerProfil {
            width: fit-content;
            padding: 15px;

            h3 {
                font-size: 15.21px;
                font-family: NormsBold, Norms, Arial, sans-serif;
                color: #591df1;
            }

            p {
                font-size: 13px;

                span {
                    font-family: NormsBold, Norms, Arial, sans-serif;
                    margin-right: 10px;
                }
            }
        }

        .containerRight {
            max-width: 770px;
            width: 100%;
        }
    }
</style>
