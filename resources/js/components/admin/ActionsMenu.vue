<template>
    <div class="customSelect" :tabindex="tabindex" @blur="open = false">
        <div class="selected" :class="{open: open}" @click="open = !open"><font-awesome-icon class="icon" icon="ellipsis-h"/></div>
        <div class="items boxShadow" :class="{selectHide: !open}">
            <div class="item" @click="emitActions('edit'), open = false">
                <font-awesome-icon icon="ellipsis-h"/>
                <p>Edit</p>
            </div>

            <div class="item" @click="emitActions('delete'), open = false">
                <font-awesome-icon class="removeButton" icon="trash-alt"/>
                <p>Delete</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            id: {
                type: Number,
                required: true
            },
            tabindex: {
                type: Number,
                required: false,
                default: 0
            }
        },
        data() {
            return {
                open: false
            }
        },
        methods: {
            emitActions(action) {
                this.$emit('action', {action: action, id: this.id})
            }
        }
    }
</script>

<style lang="scss" scoped>
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

    .selected.open .icon{
        background: #591df1;
        color: white;
    }

    .items {
        font-size: 13px;
        color: #595d6e;
        border-radius: 6px 6px 0 0;
        overflow: hidden;
        position: absolute;
        background-color: white;
        right: 0;
        bottom: -70px;
        box-shadow: 0 0 25px 0 rgba(82, 63, 105, 0.1);
        z-index: 10;
    }

    .item {
        display: flex;
        color: #595d6e;
        padding: 10px 15px;
        cursor: pointer;
        user-select: none;

        p {
            margin-left: 10px;
        }
    }

    .item:hover {
        color: #591df1!important;
        background-color: #f7f8fa;
    }

    .selectHide {
        display: none;
    }
</style>
