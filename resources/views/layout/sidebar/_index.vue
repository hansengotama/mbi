<template>
        <div class="sidebar">
            <div class="search-container" v-show="user.role != 'super_admin'">
                <select name="" id="">
                    <option value="Riau Tengah">Riau Tengah</option>
                </select>
            </div>

            <div v-for="(data, index) in menu" v-if="data.title && !data.children" class="menu-container">
                <div class="menu" @click="goToSubmenu('Home', 'Home')" :class="(selectedMenuTitle == data.title) ? 'active' : ''">
                    <div class="left">
                        <div class="icon">
                            <i :class="data.icon"></i>
                        </div>
                        <div class="text">{{ data.title }}</div>
                    </div>
                </div>
            </div>
            <div v-for="(data, index) in menu" v-if="data.title && data.children && data.show" class="menu-container">
                <div class="menu" @click="selectMenu(index)" :class="(selectedMenuTitle == data.title) ? 'active' : ''">
                    <div class="left">
                        <div class="icon">
                            <i :class="data.icon"></i>
                        </div>
                        <div class="text">{{ data.title }}</div>
                    </div>
                    <div class="right">
                        <i :class="'fas fa-angle-down '+data.active"></i>
                    </div>
                </div>
                <transition-group name="fade" tag="div">
                    <div v-show="data.active"
                         v-for="(submenu, indexSubmenu) in data.children"
                         :key="index + indexSubmenu"
                         class="submenu"
                         @click="goToSubmenu(submenu.name, data.title)"
                         v-if="submenu.title"
                    >
                        <router-link :to="{ name: submenu.name }"
                                     v-text="submenu.title"
                        ></router-link>
                    </div>
                </transition-group>
            </div>
        </div>
</template>

<script>
    import menu from '../../../js/router/menu.js'

    export default {
        props: ['regionId', 'listRegion', 'user'],
        data() {
            return {
                menu: [],
                selectedMenuTitle: ""
            }
        },
        methods: {
            selectMenu(index) {
                this.menu[index].active = !this.menu[index].active
            },
            goToSubmenu(name, title) {
                this.selectedMenuTitle = title
                if(this.$router.history.current.name != name) this.$router.push({ name: name })
            }
        },
        created() {
            for(let i = 0; i < menu.data.length; i++) {
                if(menu.data[i].roles.includes(this.user.role))
                    menu.data[i].show = true
            }

            this.menu = menu.data

            if(this.$router.app._route.matched.length == 0 || (this.$router.app._route.matched[0] && this.$router.app._route.matched[0].name == 'Home'))
                this.selectedMenuTitle = "Home"
            else {
                this.selectedMenuTitle = this.$router.app._route.matched[1].meta.parentTitle

                this.menu.forEach((data) => {
                    if(data.title == this.selectedMenuTitle)
                        data.active = true
                    else
                        data.active = false

                    return true
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "../../../stylus/app.styl"

    .sidebar
        width 18em
        border-right 1px solid #eaeaea
        height 100vh
        position fixed
        background white
        z-index 10
        padding-top 0.8em
        overflow-y auto
        padding-bottom 5em

    .sidebar > .search-container
        margin-left 10px
        width 90%
        margin-bottom 1em

    .sidebar > .search-container > select
        width 100%
        background white
        padding 8px 4px
        border-radius 5px

    .sidebar > .menu-container > .menu
        display flex
        margin-right 10px
        padding 12px 10px
        border-top-right-radius 30px
        border-bottom-right-radius 30px
        justify-content space-between
        cursor pointer
        border-left 5px solid white
        transition(500ms all linear)

    .sidebar > .menu-container > .menu > .left
        display flex

    .sidebar > .menu-container > .menu > .left > .icon
        margin-right 8px

    .sidebar > .menu-container > .menu > .left > .text,
    .sidebar > .menu-container > .menu > .left > .icon,
    .sidebar > .menu-container > .menu > .right > i
        color #A4AABA

    .sidebar > .menu-container > .menu > .right > i
        transition(transform 500ms linear)

    .sidebar > .menu-container > .menu > .right > i.true
        transform(rotate(180deg))
        transition(transform 500ms linear)

    .sidebar > .menu-container > .menu.active,
    .sidebar > .menu-container > .menu:hover
        background rgba(237, 77, 83, .06) !important
        border-left 5px solid $orange !important

    .sidebar > .menu-container > .menu + div > .submenu > .router-link-active
        color $orange

    .sidebar > .menu-container > .menu:hover > .left > .icon,
    .sidebar > .menu-container > .menu:hover > .left > .text,
    .sidebar > .menu-container > .menu:hover > .right > i
        color $orange

    .sidebar > .menu-container > .menu:hover > .left > .text
        font-weight 700

    .sidebar > .menu-container > div > .submenu
        padding 10px 10px 10px 40px
        transition(500ms all ease-in-out)
        cursor pointer

    .sidebar > .menu-container > div > .submenu > a
        text-decoration none
        color #A4AABA

    .sidebar > .menu-container > div > .submenu > a:hover
        color $orange

    .fade-enter-active, .fade-leave-active
        transition(opacity .5s)

    .fade-enter, .fade-leave-to
        opacity 0

    ::-webkit-scrollbar
        width 10px

    ::-webkit-scrollbar-track
        background #f1f1f1

    ::-webkit-scrollbar-thumb
        background $orange
</style>
