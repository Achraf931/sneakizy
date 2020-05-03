<template>
    <div class="adminItems boxShadow bRadius bgWhite fullWidth">
        <header class="mrBottom10">
            <h3>Liste des {{title}}</h3>
            <transition name="=fade">
                <font-awesome-icon v-if="itemsChecked.length > 0" @click="deleteProduct" class="icon removeButton" icon="trash-alt"/>
            </transition>
            <font-awesome-icon @click="actionForm = 'create', addingItem = true" class="icon" icon="plus"/>
        </header>
        <table>
            <thead>
            <tr class="item">
                <td class="textStart"><input ref="checkAll" @change="toggleCheckAll" type="checkbox" class="boxShadow"></td>
                <td @click="orderBy('DESC')">#</td>
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
                </template>

                <template v-if="routeName === 'admin/brands'">
                    <td>Titre</td>
                    <td>Logo</td>
                    <td>Date de création</td>
                </template>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <tr class="item" v-for="item in items" :key="item.id">
                <td><input :checked="itemsChecked.indexOf(item.id) !== -1" @change="checked(item.id)" type="checkbox" class="boxShadow"></td>
                <td style="width: 44px; text-align: start;" class="textCenter">{{item.id}}</td>

                <template v-if="routeName === 'admin/news'">
                    <td class="textCenter">{{item.title}}</td>
                    <td class="textCenter">{{item.content.slice(0, 40)}}</td>
                    <td class="textCenter">{{item.is_published === 1 ? 'Oui' : 'Non'}}</td>
                </template>

                <template v-else-if="routeName === 'admin/products'">
                    <td class="textCenter">{{item.name}}</td>
                    <td class="textCenter">{{item.color}}</td>
                    <td class="textCenter">{{item.price}}</td>
                    <td class="textCenter">{{item.description.slice(0, 50)}}...</td>
                </template>

                <template v-if="routeName === 'admin/brands'">
                    <td class="textCenter">{{item.name}}</td>
                    <td class="textCenter"><img style="width: 30px;" :src="item.image" :alt="item.name"></td>
                    <td class="textCenter">{{item.created_at}}</td>
                </template>

                <td class="textCenter">
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
                <div :class="{isActive: infos.current_page === page}" class="buttonPage" v-for="page in infos.last_page" @click="getItems(page, nbPerPage)">{{page}}</div>
                <button :class="{disabled: infos.current_page === infos.last_page || infos.current_page === infos.last_page}" class="arrowPagination boxShadow" :disabled="infos.current_page === infos.last_page || infos.current_page === infos.last_page" @click="getItems(infos.current_page+1, nbPerPage)"><font-awesome-icon icon="angle-right"/></button>
                <button :class="{disabled: infos.current_page === infos.last_page || infos.current_page === infos.last_page}" class="arrowPagination boxShadow" :disabled="infos.current_page === infos.last_page || infos.current_page === infos.last_page" @click="getItems(infos.last_page, nbPerPage)"><font-awesome-icon icon="angle-double-right"/></button>
            </div>
            <div class="containerNbPerPage mrTop10">
                <CustomSelect @nbPerPage="changeNbPerPage" :options="[5, 10, 20, 30, 50, 75, 100]"/>
            </div>
        </div>
        <Modal @close="addSneaker" :action="actionForm" v-show="addingItem != null"/>
    </div>
</template>
<script>
    import Modal from './Modal'
    import CustomSelect from '../CustomSelect'
    import ActionsMenu from './ActionsMenu'
    import {mapGetters} from "vuex"

    export default {
        props: ['infos', 'items', 'storeActionGetItems', 'title'],
        data(){
            return {
                routeName: this.$route.name,
                nbPerPage: 10,
                addingItem: null,
                actionForm: null,
                orderItems: 'DESC'
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
            }
        },
        computed: {
            ...mapGetters({
                checkAll: 'admin/checkedAll',
                itemsChecked: 'admin/itemsChecked'
            })
        },
        methods : {
            addSneaker(product) {
                this.addingItem = null
                this.$store.dispatch('products/addProduct', product).catch(err => {
                    console.log(err)
                })
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
            deleteProduct() {
                this.$store.dispatch('admin/deleteItem')
            },
            changeNbPerPage(nb) {
                this.nbPerPage = nb
                this.getItems(1, nb)
            },
            actionItem(action) {
                if (action.action === 'edit') {
                    this.actionForm = action.action
                    this.addingItem = true
                }
            },
            orderBy(order) {
                if (order === this.orderItems) {
                    this.orderItems = 'ASC'
                }
                else {
                    this.orderItems = 'DESC'
                }
                this.$store.dispatch(this.storeActionGetItems, {page: this.infos.current_page, nb: this.nbPerPage, orderBy: this.orderItems})
            }
        }
    }
</script>
<style lang="scss" scoped>
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

            thead {
                text-align: center;
            }

            .item, thead {
                width: 100%;
                padding: 0 15px;
                border-bottom: 1px solid #f0f3ff;
                transition: background .3s ease;

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
