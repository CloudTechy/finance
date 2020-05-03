import 'es6-promise/auto'
import axios from 'axios'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import auth from './auth'
import router from './router'
import jQuery from 'jquery'
import bootstrap from 'bootstrap'
import popper from 'popper.js'
import moment from 'moment'
import fontawesome from '@fortawesome/fontawesome-free'
import Clipboard from 'v-clipboard'

Vue.use(Clipboard)
Vue.use(fontawesome)



// Set Vue globally
window.Vue = Vue
window.basepath = window.location.origin

// Set Vue router
Vue.router = router
Vue.use(VueRouter)





// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = basepath + '/api/v1'

Vue.use(VueAuth, auth)
window.numeral = require('numeral')
import VueSweetalert2 from 'vue-sweetalert2';

const sweetOptions = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674'
}

Vue.use(VueSweetalert2, sweetOptions)

import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Array.prototype.sum = function(prop) {
    var total = 0
    for (var i = 0, _len = this.length; i < _len; i++) {
        total = total + parseInt(this[i][prop])
    }
    return total
}

// Load Index
Vue.component('index', Index)

const app = new Vue({
    data: {
        time: '',
        rate: '',
        user: '',
        ip: '',
        uploadItem: null,
        viewItem: null,
        mailUser : null,
    },
    el: '#app',
    router,
    computed: {
        basepath() {
            return basepath
        },
    },
    created() {
        setInterval(this.timer, 1000)
        setInterval(this.refreshUser, 30000)
        if (localStorage.rate) {
            this.rate = JSON.parse(localStorage.rate)
        }
        if (localStorage.ip) {
            this.ip = JSON.parse(localStorage.ip)
        }
        this.btcRate()
        this.getIp()

    },
    methods: {
        alert(type, title, message) {
            this.$swal({
                toast: true,
                position: 'top-end',
                type,
                title,
                text: message,
                showConfirmButton: false,
                timer: 1500
            })
        },
        numeral(value) {
            if (typeof value == 'string') {
                return value
            }
            return '$' + numeral(value).format('0,0.00')
        },
        normalNumeral(value) {
            return numeral(value).format('0,0.00')
        },
        myFilter(list, search) {
            var data = [];
            if (search) {
                data = list.filter((item) => {
                    var keys = Object.values(item)
                    var boolean = false
                    if (item == undefined) {
                        return false
                    }
                    var bool = keys.forEach((key) => {
                        if (key != null && key.toString().toLowerCase().includes(search.toLowerCase())) {
                            boolean = true
                        }
                    })
                    return boolean
                })
            } else {
                data = list;
            }
            return data;
        },
        filter(list, search) {
            var data = [];
            if (search) {
                data = list.filter((item) => {
                    return item.username.toLowerCase().includes(search.toLowerCase());
                })
            } else {
                data = [];
            }
            return data;
        },
        scrollToTop(x = 0, y = 300) {
            window.scrollTo(x, y);
        },
        timer() {
            this.time = moment().format("h:mm:ss a")
        },
        btcRate() {
            this.$http.get("https://api.coindesk.com/v1/bpi/currentprice.json")
                .then(response => {
                     this.rate = response.data.bpi.USD.rate
                    localStorage.rate = JSON.stringify(response.data.bpi.USD.rate)
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        getIp() {
            var form = new Form()
            form.get("https://api.ipify.org?format=json")
                .then(response => {
                    this.ip = response.data.ip
                    localStorage.ip = JSON.stringify(response.data.ip)
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        refreshUser() {
            this.$auth.fetch({
                params: {},
                success: (response) => { this.user = this.$auth.user() },
                error: (error) => {console.log(error.response.data)},
            })
        },
    },
    beforeDestroy() {
        clearInterval(this.timer)
    },

});
