import Vue from 'vue'
import Vuex from 'vuex'
import router from './router'
import store from './store'
import App from './../views/App'
import filters from './../filters/index'


Vue.use(Vuex);

new Vue({
    el: '#app',
    router,
    store,
    filters,
    components: {
        App
    }
});
