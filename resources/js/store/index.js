import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const state = {
    userLogin: {},
    accessToken: null
}

const getters = {
    getUserLogin (state) {
        return state.userLogin
    },
    getAccessToken (state) {
        return state.accessToken
    }
}

const mutations = {
    setUserLogin(state, data) {
        state.userLogin = data
    },
    setAccessToken(state, data) {
        state.accessToken = data
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
