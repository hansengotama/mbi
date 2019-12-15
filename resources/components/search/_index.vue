<template>
    <div class="filter-container">
        <input type="text" class="filter-search" placeholder="Cari..." v-model="text" @keyup.enter="search()">
        <div class="search-icon" @click="search()">
            <i class="fa fa-search"></i>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                text: ""
            }
        },
        methods: {
            search() {
                this.$emit('search', this.text)
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../stylus/app.styl"

    .filter-container
        display flex
        align-items center

    .filter-container > .filter-search
        width 260px
        padding 6px 15px
        border 2px solid #eaeaea
        border-right none
        border-bottom-left-radius 8px
        border-top-left-radius 8px

    .filter-container > .search-icon
        border 2px solid #eaeaea
        border-left none
        padding 6px 10px
        border-bottom-right-radius 8px
        border-top-right-radius 8px
        cursor pointer

    .filter-container > .search-icon > i
        color #eaeaea
</style>
