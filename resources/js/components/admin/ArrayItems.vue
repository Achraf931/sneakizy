<template>
    <div class="adminItems boxShadow bRadius bgWhite fullWidth">
        <header class="mrBottom10">
            <h3>Liste des {{title}}</h3>
            <transition name="=fade">
                <font-awesome-icon v-if="itemsChecked.length > 0" @click="deleteItems" class="icon removeButton" icon="trash-alt"/>
            </transition>
            <font-awesome-icon @click="actionForm = 'create', openModalItem = true" class="icon" icon="plus"/>
        </header>
        <table>
            <thead>
            <tr class="item">
                <td class="textStart"><input ref="checkAll" @change="toggleCheckAll" type="checkbox" class="boxShadow"></td>
                <td class="cPointer pRelative idTd dFlex alignCenter" @click="orderItems = !orderItems, orderBy(orderItems, 1)">#</td>
                <template v-if="routeName === 'admin/news'">
                    <td>Titre</td>
                    <td>Contenu</td>
                    <td>Publié</td>
                </template>

                <template v-if="routeName === 'admin/products'">
                    <td>Produit</td>
                    <td>Couleur</td>
                    <td>Prix</td>
                    <td>Description</td>
                    <td>Publié</td>
                </template>

                <template v-if="routeName === 'admin/brands'">
                    <td>Titre</td>
                    <td>Logo</td>
                    <td>Bannière</td>
                    <td>Date de création</td>
                </template>

                <template v-if="routeName === 'admin/users'">
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>E-mail</td>
                    <td>Date d'inscription</td>
                    <td>Admin</td>
                </template>
                <td class="textCenter">Actions</td>
            </tr>
            </thead>
            <tbody>
            <tr class="item" v-for="item in items" :key="item.id">
                <td><input :checked="itemsChecked.indexOf(item.id) !== -1" @change="checked(item.id)" type="checkbox" class="boxShadow"></td>
                <td>{{item.id}}</td>

                <template v-if="routeName === 'admin/news'">
                    <td>{{item.title}}</td>
                    <td>{{item.content.slice(0, 40)}}...</td>
                    <CustomSelect :id="item.id" @option="changeIsPublished" :current="item.is_published === 1 ? 'Oui' : 'Non'" :options="['Oui', 'Non']"/>
                </template>

                <template v-else-if="routeName === 'admin/products'">
                    <td>{{item.name}}</td>
                    <td>{{item.color}}</td>
                    <td>{{item.price}}</td>
                    <td>{{item.description.slice(0, 10).replace(/(<([^>]+)>)/ig, '')}}...</td>
                    <CustomSelect :id="item.id" @option="changeIsPublished" :current="item.is_published === 1 ? 'Oui' : 'Non'" :options="['Oui', 'Non']"/>
                </template>

                <template v-if="routeName === 'admin/brands'">
                    <td>{{item.name}}</td>
                    <td><img style="width: 30px;" :src="item.image" :alt="item.name"></td>
                    <td><img style="width: 80px;" :src="item.banner" :alt="item.banner"></td>
                    <td>{{moment(item.created_at).format('YYYY-MM-DD')}}</td>
                </template>

                <template v-if="routeName === 'admin/users'">
                    <td>{{item.lastname}}</td>
                    <td>{{item.firstname}}</td>
                    <td>{{item.email}}</td>
                    <td>{{moment(item.created_at).format('YYYY-MM-DD')}}</td>
                    <CustomSelect :id="item.id" @option="changeIsAdmin" :current="item.is_admin === 1 ? 'Oui' : 'Non'" :options="['Oui', 'Non']"/>
                </template>

                <td>
                    <div class="widthContent mrAuto pRelative">
                        <ActionsMenu :id="item.id" @action="actionItem"/>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="bottom">
            <div class="containerButtonsPage mrTop10">
                <button :class="{disabled: infos.current_page === 1 || infos.last_page === 1}" class="arrowPagination boxShadow mrLeft0" :disabled="infos.current_page === 1 || infos.last_page === 1" @click="getItems(1, nbPerPage)"><font-awesome-icon icon="angle-double-left"/></button>
                <button :class="{disabled: infos.current_page === 1 || infos.last_page === 1}" class="arrowPagination boxShadow" :disabled="infos.current_page === 1 || infos.last_page === 1" @click="getItems(infos.current_page-1, nbPerPage)"><font-awesome-icon icon="angle-left"/></button>
                <div :class="{isActive: infos.current_page === page}" class="buttonPage" v-if="infos.last_page > 1" v-for="page in infos.last_page" @click="getItems(page, nbPerPage)">{{page}}</div>
                <button :class="{disabled: infos.current_page === infos.last_page || infos.current_page === infos.last_page}" class="arrowPagination boxShadow" :disabled="infos.current_page === infos.last_page || infos.current_page === infos.last_page" @click="getItems(infos.current_page+1, nbPerPage)"><font-awesome-icon icon="angle-right"/></button>
                <button :class="{disabled: infos.current_page === infos.last_page || infos.current_page === infos.last_page}" class="arrowPagination boxShadow" :disabled="infos.current_page === infos.last_page || infos.current_page === infos.last_page" @click="getItems(infos.last_page, nbPerPage)"><font-awesome-icon icon="angle-double-right"/></button>
            </div>
            <div class="containerNbPerPage mrTop10">
                <CustomSelect @option="changeNbPerPage" :current="items.length" :options="[5, 10, 20, 30, 50, 75, 100]"/>
            </div>
        </div>
        <transition name="fade">
            <Modal @closeModal="openModalItem = null" @close="sendForm" :oneItem="actionForm === 'edit' ? oneItemForEditing : null" :itemForEdit="editingItem" :action="actionForm" v-show="openModalItem != null"/>
        </transition>
        <transition name="fade">
            <div id="bg" v-show="openModalItem != null" @click="openModalItem = null"></div>
        </transition>
    </div>
</template>
<script>
    import {bus} from "../../app"
    import Modal from './Modal'
    import CustomSelect from '../CustomSelect'
    import ActionsMenu from './ActionsMenu'
    import {mapGetters, mapState} from "vuex"
    import moment from 'moment'

    export default {
        props: ['infos', 'items', 'storeActionGetItems', 'actionDeleteItem', 'actionEditItem', 'actionCreateItem', 'title', 'getterItem', 'oneItem'],
        data(){
            return {
                loading: false,
                routeName: this.$route.name,
                nbPerPage: 10,
                openModalItem: null,
                actionForm: null,
                editingItem: null,
                orderItems: false,
                moment: moment
            }
        },
        components : {
            Modal,
            CustomSelect,
            ActionsMenu
        },
        watch: {
            checkAll() {
                this.$refs.checkAll.checked = this.checkAll
            },
            loading() {
                bus.$on('loading', res => {
                    this.loading = res
                })
            }
        },
        computed: {
            ...mapGetters({
                checkAll: 'admin/checkedAll',
                itemsChecked: 'admin/itemsChecked'
            }),
            ...mapState({
                oneItemForEditing (state, getters) {
                    return getters[`${this.getterItem}`]
                }
            })
        },
        methods : {
            sendForm(res) {
                this.openModalItem = null
                if (res.action === 'create') {
                    this.$store.dispatch('loader/OpenLoader', true)
                    this.$store.dispatch(this.actionCreateItem, res.item)
                }
                else if (res.action === 'edit') {
                    this.$store.dispatch(this.actionEditItem, {id: res.id, form: res.item})
                }
            },
            getItems(page, nb = this.nbPerPage) {
                this.$store.dispatch(this.storeActionGetItems, {page, nb})
            },
            toggleCheckAll() {
                this.$store.dispatch('admin/toggleCheckAll', {items: this.items, event: event.target.checked})
            },
            verifyCheckPageChange() {
                this.$store.dispatch('admin/verifyCheckPageChange', this.items)
            },
            checked(id) {
                this.$store.dispatch('admin/checked', id)
            },
            deleteItems() {
                this.itemsChecked.forEach(item => {
                    this.$store.dispatch(this.actionDeleteItem, item);
                })
            },
            changeNbPerPage(nb) {
                this.nbPerPage = nb
                this.getItems(1, nb)
            },
            changeIsAdmin(option) {
                let form = {
                    form: {
                        is_admin: option.option
                     }
                }
                this.$store.dispatch('users/editUser', {id: option.id, form: form})
            },
            changeIsPublished(option) {
                this.$store.dispatch(this.actionEditItem, {id: option.id, form: {is_published: option.option}})
            },
            actionItem(action) {
                if (action.action === 'edit') {
                    this.actionForm = action.action
                    this.$store.dispatch(this.oneItem, action.id)
                    this.openModalItem = true
                }
                if (action.action === 'delete') {
                    this.$store.dispatch('loader/OpenLoader', true)
                    this.$store.dispatch(this.actionDeleteItem, action.id);
                }
            },
            orderBy(order, page) {
                this.$store.dispatch(this.storeActionGetItems, {page: page != '' ? page : this.infos.current_page, nb: this.nbPerPage, orderBy: this.orderItems ? 'DESC' : 'ASC'})
            }
        }
    }
</script>
<style lang="scss" scoped>
    #bg {
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.4);
        position: fixed;
        left: 0;
        top: 0;
        z-index: 150;
    }

    .fade-enter-active, .fade-leave-to {
        transition: opacity 500ms;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
    .checked {
        background: #f7f8fa;
    }
    .disabled {
        background-color: #F9F9FC!important;

        svg {
            color: #E1E4F5!important;
        }
    }
    .isActive {
        background: #591df1!important;
        color: white!important;
    }

    input[type=checkbox] {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
    }

    input[type=checkbox] {
        border: none;
        cursor: pointer;
        border-radius: 5px;
        height: 18px;
        width: 18px;
        background: #f0f3ff;
        transition: all .3s ease;
    }

    input[type="checkbox"]:checked {
        position: relative;
        &:after {
            content: '';
            border: solid #99a6bf;
            position: absolute;
            display: block;
            top: 50%;
            left: 50%;
            margin-left: -3px;
            margin-top: -7px;
            width: 5px;
            height: 10px;
            border-width: 0 2px 2px 0!important;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    }

    .adminItems {
        max-width: 1050px;
        padding: 15px 0;
        margin: auto;
        font-size: 13px;

        & > header {
            display: flex;
            justify-content: space-between;
            padding: 0 15px;

            h3 {
                color: #48465b;
            }
        }

        .icon {
            width: 1.5rem;
            height: 1.5rem;
            padding: 5px;
            border-radius: 5px;
            color: #93A2DD;
            cursor: pointer;
            transition: background .2s ease;
        }
        .icon:hover {
            color: #591df1;
            background: #f0f3ff;
        }
        .removeButton {
            color: white!important;
            background: red!important;
        }

        table {
            width: 100%;

            .item, thead {
                width: 100%;
                padding: 0 15px;
                border-bottom: 1px solid #f0f3ff;
                transition: background .3s ease;

                .idTd:after {
                    content: "";
                    width: 0;
                    height: 0;
                    margin-left: 5px;
                    border: 4px solid transparent;
                    border-color: #595d6e transparent transparent transparent;
                }
                td {
                    color: #595d6e;
                    padding: 10px;
                }

                td:first-child {
                    padding-left: 15px;
                }
            }

            .actionsMenu {
                opacity: 0;
                display: none;
                width: 40px;
                height: 40px;
            }
        }

        .bottom {
            padding: 0 15px;
            display: flex;
            justify-content: space-between;

            .containerButtonsPage {
                width: fit-content;
                display: flex;

                & * {
                    font-size: 13px;
                }

                .buttonPage, .arrowPagination {
                    cursor: pointer;
                    color: #93a2dd;
                    width: 20px;
                    border: none;
                    height: 30px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    border-radius: 5px;
                    margin: 0 2px;
                    padding: 10px 15px;
                    transition: all .3s ease;
                }

                .buttonPage:hover, .arrowPagination:hover {
                    background-color: #591df1;
                    color: white;
                }

                .arrowPagination {
                    background-color: #f0f3ff;
                }
            }

            .containerNbPerPage {
                display: flex;
                flex-direction: row;
            }
        }
    }
</style>
