import Vue from 'vue'
import moment from 'moment'

Vue.filter('dateFormat', (value, format) => {
    return moment(value).format(format)
})

Vue.filter('numberFormat',(value) => {
    value = (value/1).toFixed(0).replace('.', ',')
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
})
