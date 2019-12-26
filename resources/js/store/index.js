import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const state = {
    userLogin: {},
    accessToken: null,
    region: [],
    selectedRegion: {
        id: null,
        name: null
    }
}

const getters = {
    getUserLogin (state) {
        return state.userLogin
    },
    getAccessToken (state) {
        return state.accessToken
    },
    getRegion(state) {
        return state.region
    },
    getSelectedRegion(state) {
        return state.selectedRegion
    }
}

const mutations = {
    setUserLogin(state, data) {
        state.userLogin = data
    },
    setAccessToken(state, data) {
        state.accessToken = data
    },
    setRegion(state, data) {
        state.region = data
    },
    setSelectedRegion(state, data) {
        state.selectedRegion = data
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
