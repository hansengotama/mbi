import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const state = {
    userLogin: {},
    region: {}
}

const getters = {
    getUserLogin (state) {
        return state.userLogin
    },
    getRegion (state) {
        return state.region
    }
}

const mutations = {
    setUserLogin(state, data) {
        state.userLogin = data
    },
    setRegion(state, data) {
        state.region = data
    }
}

const actions = {

}

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions
})
