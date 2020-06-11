<template>
	<div class="homeAdmin">
        <section class="containerMain bgWhite boxShadow">
            <div class="headNewUsers">
                <h3>Nouveaux utilisateurs</h3>
                <div>
                    <p :class="{isActive: isActive === 'today'}" @click="today">Today</p>
                    <p :class="{isActive: isActive === 'month'}" @click="month">Month</p>
                </div>
            </div>
            <table class="fullWidth">
                <tr v-for="user in users" :key="user.id" class="dFlex justifySpaceB alignCenter padding15">
                    <td>
                        <p>{{user.lastname}} {{user.firstname}}</p>
                        <p>{{user.email}}</p>
                    </td>
                    <td class="signingDate bRadius5 boxShadow">{{moment(user.created_at).format('YYYY-MM-DD')}}</td>
                </tr>
                <tr class="dFlex justifySpaceB alignCenter padding15" v-if="users.length === 0">
                    <td>
                        <p>{{isEmpty}}</p>
                    </td>
                </tr>
            </table>
        </section>
        <p class="button boxShadow logout mrTop10 textCenter" @click="logout">Logout</p>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'
    import moment from 'moment'

	export default {
        name: 'mainAdmin',
        data() {
            return {
                isEmpty: 'Aucune nouvelle inscription',
                isActive: 'today',
                moment: moment
            }
        },
        computed: {
            ...mapGetters({
                users: 'users/usersWithDate'
            })
        },
        beforeMount() {
            this.$store.dispatch('users/getUsersWithDate', {today: moment().format('YYYY-MM-DD')})
        },
        methods: {
            logout() {
                this.$emit('logout')
            },
            today() {
                this.isActive = 'today'
                this.$store.dispatch('users/getUsersWithDate', {today: moment().format('YYYY-MM-DD')})
            },
            month() {
                this.isActive = 'month'
                this.$store.dispatch('users/getUsersWithDate', {start: moment().startOf('month').format('YYYY-MM-DD'), end: moment().endOf('month').format('YYYY-MM-DD')})
            }
        }
    }
</script>
<style lang="scss" scoped>
    .logout {
        color: white;
        cursor: pointer;
        width: fit-content;
        border: 1px solid #DC3445;
        background: #DC3445;
        border-radius: 10px;
        font-size: 14px;
        font-family: Poppins, Norms, Arial, sans-serif;
        padding: 10px;
    }
    .isActive {
        color: #591df1;
        border-bottom: 1px solid #591df1!important;
    }
    .homeAdmin {
        max-width: 1050px;
        width: 100%;
        margin: 0 auto;

        .containerMain {
            max-width: 400px;
            width: 100%;

            .headNewUsers {
                width: 100%;
                display: flex;
                justify-content: space-between;
                color: #48465b;
                border-bottom: 1px solid #ebedf2;

                div {
                    display: flex;
                    padding: 15px 15px 0 0;
                    font-size: 13px;

                    p {
                        transition: all .2s ease;
                        border-bottom: 1px solid transparent;
                        padding-bottom: 15px;
                        cursor: pointer;
                    }

                    p:first-child {
                        margin-right: 10px;
                    }

                    p:hover {
                        color: #591df1;
                        border-bottom: 1px solid #591df1;
                    }
                }

                h3 {
                    font-size: 15.21px;
                    padding: 15px;
                }
            }

            table > tr {
                border-bottom: 1px solid #ebedf2;

                & > td {
                    color: #591df1;
                    font-size: 13px;
                    font-family: NormsBold, Norms, Arial, sans-serif;

                    p:last-child {
                        color: #74788d;
                    }
                }

                & > .signingDate {
                    font-size: 11.37px;
                    background: #f0f3ff;
                    padding: 10px 15px;
                    color: #93a2dd;
                    font-family: NormsBold, Norms, Arial, sans-serif;
                }
            }
        }
    }
</style>
