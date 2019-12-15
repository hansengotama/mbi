import axios from "axios"
import router from "../js/router"
import VueCookie from 'vue-cookie'

export default {
    getBaseUrl() {
        return this.url = window.location.origin
    },

    get(url, access_token) {
        return new Promise((resolve) => {
            axios.get(this.getBaseUrl() + url, {
                headers: {
                    'Content-Type': 'application/json',
                    Authorization: 'Bearer ' + access_token
                }
            })
            .then((response) => {
                resolve(response)
            })
            .catch((error) => {
                resolve(error)
            })
        })
    },

    post(url, data, access_token) {
        return new Promise((resolve) => {
            let headers = {}

            if(access_token != null) {
                headers = {
                    headers: {
                        'Content-Type': 'application/json',
                        Authorization: 'Bearer ' + access_token
                    }
                }
            }else {
                headers = {
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }
            }

            axios.post(this.getBaseUrl() + url, data, headers)
            .then((response) => {
                resolve(response)
            })
            .catch((error) => {
                resolve(error)
            })
        })
    },
}



