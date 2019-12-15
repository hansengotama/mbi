import Vue from 'vue'
import Router from 'vue-router'
import VueCookie from 'vue-cookie'
import menu from './menu'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: menu.data
})

router.beforeResolve((to, from, next) => {
    if(to != from)
        window.scrollTo(0, 0)

    if(VueCookie.get('access_token')) {
        if(to.name == "Logout") {
            VueCookie.delete('access_token')
            next("/login")
        } else if(to.name == "Login")
            next(from.path)
        else
            next()
    } else if (to.name != 'Login')
        next("/login")
    else
        next()
})

export default router
