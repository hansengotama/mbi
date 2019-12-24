import Vue from 'vue'
import Vuex from 'vuex'
import router from './router'
import store from './store'
import App from './../views/App'
import filters from './../filters/index.js'

Vue.use(Vuex);

new Vue({
    router,
    store,
    filters,
    components: {App}
}).$mount('#app');
