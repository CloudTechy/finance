<template>
    <section class="account-header mb-2 p-0 mt-3">
        <div class="container">
            <div class="row">
                <div class="column col-xl-6 p-0 p-lg-1 p-2 col-lg-6 col-12 alpha">
                    <h3 class="user-hello text-left pl-3 p-md-0" style="color: #fff;">Hello, <span>{{$auth.user().username}}</span></h3>
                    <div class="header-box user ml-1 ml-sm-3 ml-md-0 ">
                        <table>
                            <tbody>
                                <tr>
                                    <td style="color: #fff;">Registration Date :</td>
                                    <td>{{time}}</td>
                                </tr>
                                <tr>
                                    <td style="color: #fff;">Your IP Address :</td>
                                    <td>{{getIp}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="column col-xl-6 col-lg-12 col-md-12 col-12 omega">
                    <h3 class="user-hello" style="visibility:hidden;">Affiliate Link</h3>
                    <div class="top-buttons clearfix">
                    	<router-link class="m-xl-1 mr-lg-0 m-1 mr-0 btn btn-default" to="/admin/dashboard/subscriptions">Subscribe</router-link>
                    	<router-link  class="m-xl-1 m-1 btn btn-default" to="/admin/dashboard/withdrawals">Confirm Withdrawal</router-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import moment from 'moment'
export default {
    data() {
        return {

        }
    },
    computed: {
        getIp() {
            return this.$auth.user().ip != undefined ? this.$auth.user().ip : this.$root.ip
        },
        time() {
            return moment().format("MMM Do YYYY")
        }
    },
    mounted() {},
    methods: {}
}

</script>
