<template>
	<div class="adminProducts boxShadow bRadius bgWhite fullWidth">
        <header class="mrBottom10">
            <h3>Liste des produits</h3>
            <p @click="deleteProduct">delete</p>
            <font-awesome-icon @click="addingProduct = true" class="icon" icon="plus"/>
        </header>
        <table>
            <thead>
                <tr class="product">
                    <td class="textStart"><input ref="checkAll" @change="toggleCheckAll" type="checkbox" class="boxShadow"></td>
                    <td>#</td>
                    <td>Produit</td>
                    <td>Couleur</td>
                    <td>Prix</td>
                    <td>Description</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <tr class="product" v-for="product in products" :key="product.id" @dblclick="editingItem = product">
                    <td><input :checked="itemsChecked.indexOf(product.id) !== -1" @change="checked(product.id)" type="checkbox" class="boxShadow"></td>
                    <td class="textCenter">{{product.id}}</td>
                    <td class="textCenter">{{product.name}}</td>
                    <td class="textCenter">{{product.color}}</td>
                    <td class="textCenter">{{product.price}}</td>
                    <td class="textCenter">{{product.description.slice(0, 50)}}...</td>
                    <td class="textCenter"><font-awesome-icon class="icon" icon="ellipsis-h"/></td>
                </tr>
            </tbody>
        </table>
        <div class="bottom">
            <div class="containerButtonsPage mrTop10">
                <button :class="{disabled: infos.current_page === 1}" class="arrowPagination boxShadow mrLeft0" :disabled="infos.current_page === 1" @click="getProducts(1, nbPerPage)"><font-awesome-icon icon="angle-double-left"/></button>
                <button :class="{disabled: infos.current_page === 1}" class="arrowPagination boxShadow" :disabled="infos.current_page === 1" @click="getProducts(infos.current_page-1, nbPerPage)"><font-awesome-icon icon="angle-left"/></button>
                <div :class="{isActive: infos.current_page === page}" class="buttonPage" v-for="page in infos.last_page" @click="getProducts(page, nbPerPage)">{{page}}</div>
                <button :class="{disabled: infos.current_page === infos.last_page}" class="arrowPagination boxShadow" :disabled="infos.current_page === infos.last_page" @click="getProducts(infos.current_page+1, nbPerPage)"><font-awesome-icon icon="angle-right"/></button>
                <button :class="{disabled: infos.current_page === infos.last_page}" class="arrowPagination boxShadow" :disabled="infos.current_page === infos.last_page" @click="getProducts(infos.last_page, nbPerPage)"><font-awesome-icon icon="angle-double-right"/></button>
            </div>
            <div>
                <CustomSelect @nbPerPage="changeNbPerPage" :options="[5, 10, 20, 30, 50, 75, 100]"/>
            </div>
        </div>
        <modal @close="addSneaker" v-show="addingProduct != null"></modal>
    </div>
</template>
<script>
    import Modal from './Modal'
    import CustomSelect from '../CustomSelect'
    import {mapGetters} from "vuex"
    import {bus} from '../../app'

	export default {
	    name: 'products',
        data(){
            return {
                nbPerPage: 8,
                editingItem: null,
                addingProduct: null
            }
        },
        components : {
            Modal,
            CustomSelect
        },
        watch: {
	        checkAll() {
                this.$refs.checkAll.checked = this.checkAll
            }
        },
        computed: {
            ...mapGetters({
                checkAll: 'admin/checkedAll',
                itemsChecked: 'admin/itemsChecked',
                products: 'products/products',
                infos: 'products/infos'
            })
        },
        beforeMount(){
            this.$store.dispatch('products/getProducts', {page: 1, nb: this.nbPerPage})
        },
        mounted() {
            Echo.channel('products')
                .listen('ProductAdded', (e) => {
                    this.products.push(e.product)
                })
        },
        methods : {
            addSneaker(product) {
                this.addingProduct = null
                this.$store.dispatch('products/addProduct', product).catch(err => {
                    console.log(err)
                })
            },
            getProducts(page, nb = 8) {
                this.$store.dispatch('products/getProducts', {page, nb})
            },
            toggleCheckAll() {
                this.$store.dispatch('admin/toggleCheckAll', {items: this.products, event: event.target.checked})
            },
            verifyCheckPageChange() {
                this.$store.dispatch('admin/verifyCheckPageChange', this.products)
            },
            checked(id) {
                this.$store.dispatch('admin/checked', id)
            },
            deleteProduct() {
                this.itemsChecked.forEach(item => {
                    this.$store.dispatch('deleteItem', item.id)
                    this.itemsChecked.splice(this.itemsChecked.indexOf(item.id), 1)
                })
            },
            changeNbPerPage(nb) {
                this.nbPerPage = nb
                this.getProducts(1, nb)
            }
        }
    }
</script>
<style lang="scss" scoped>
    .checked {
        background: #f7f8fa;
    }
    .disabled {
        background-color: #F9F9FC!important;

        svg {
            color: #E1E4F5;
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

    .adminProducts {
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

        table {
            width: 100%;

            thead {
                text-align: center;
            }

            .product, thead {
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
        }
    }
</style>
