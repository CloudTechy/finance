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



// Set Vue globally
window.Vue = Vue
window.basepath = window.location.origin

// Set Vue router
Vue.router = router
Vue.use(VueRouter)


// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `./api/v1`

Vue.use(VueAuth, auth)
window.numeral = require('numeral')
import VueSweetalert2 from 'vue-sweetalert2';

const sweetOptions = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674'
}

Vue.use(VueSweetalert2, sweetOptions)

import VueCookies from 'vue-cookies'
Vue.use(VueCookies)
VueCookies.config('7d')

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
        rate:''
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
         if(localStorage.rate){
                this.rate = JSON.parse(localStorage.rate) 
            }
        this.btcRate()
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
        timer(){
            this.time = moment().format("h:mm:ss a")
        },
        btcRate(){
            var form = new Form
            form.get("https://api.coindesk.com/v1/bpi/currentprice.json")
            .then(response => {
                console.log(response.data.bpi.USD.rate)
                    localStorage.rate = JSON.stringify(response.data.bpi.USD.rate)
                    //https://api.blockcypher.com/v1/btc/main/addrs/1DEP8i3QJCsomS4BSMY2RpU1upv62aGvhD/balance
                })
                .catch( error => {
                    // var error = error.response
                    console.log(error)
                })
        }
    },
    beforeDestroy() {
        clearInterval(this.timer)
    }
});
