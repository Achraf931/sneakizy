<template>
    <div class="customSelect" :tabindex="tabindex" @blur="open = false">
        <div class="selected" :class="{open: open}" @click="open = !open">{{ selected }}</div>
        <div class="items boxShadow" :class="{selectHide: !open}">
            <div :class="{sameSelected: open && selected === option}" class="item" v-for="(option, i) of options" :key="i" @click="sendEmit(option)">
                {{ option }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            options: {
                type: Array,
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
                selected: this.options.length > 0 ? this.options[1] : null,
                open: false
            }
        },
        methods: {
            sendEmit(option) {
                this.selected = option
                this.$emit('nbPerPage', option)
                this.open = false
            }
        }
    }
</script>

<style lang="scss" scoped>
    .customSelect {
        position: relative;
        width: 60px;
        height: 35px;
        text-align: left;
        outline: none;
    }

    .selected {
        background-color: #f0f3ff;
        border-radius: 5px;
        color: #93a2dd;
        height: 30px;
        padding: 10px 15px;
        cursor: pointer;
        user-select: none;
        transition: all .2s ease;
    }
    .selected:hover {
        background: #591df1!important;
        color: white!important;
    }

    .selected:hover .selected:after {
        border-color: transparent transparent white!important;
    }

    .selected.open {
        background: #591df1;
        color: white;
    }

    .selected:after {
        position: absolute;
        content: "";
        top: 11px;
        right: 10px;
        width: 0;
        height: 0;
        border: 4px solid transparent;
        border-color: transparent transparent #93a2dd;
    }

    .items {
        z-index: 80;
        font-size: 13px;
        color: #595d6e;
        border-radius: 6px 6px 0 0;
        overflow: hidden;
        position: absolute;
        background-color: white;
        left: 0;
        right: 0;
        bottom: 35px;
        box-shadow: 0 0 25px 0 rgba(82, 63, 105, 0.10);
    }

    .item {
        color: #595d6e;
        padding: 10px 15px;
        cursor: pointer;
        user-select: none;
    }

    .item:hover {
        background-color: #f7f8fa;
    }

    .selectHide {
        display: none;
    }

    .sameSelected {
        background-color: #f7f8fa;
    }
</style>
