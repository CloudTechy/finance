<template>
    <section class="account-header mb-2 p-0 mt-3">
        <div class="container">
            <div class="row">
                <div class="column col-xl-7 p-0 p-lg-1 col-lg-6 col-12 alpha">
                    <h3 class="user-hello text-left pl-3 p-md-0" style="color: #fff;">Hello, <span>{{$auth.user().username}}</span>  </h3> 
                     <!-- <div v-if = "!this.$auth.user().canWithdraw"  class=" d-inline-block col-5 p-2">
                                                <table>
                                                    <tr>
                                                        <td>Withdrawal Status </td>
                                                        <td> <span :class="{badge:true, 'badge-danger' :  !this.$auth.user().CanWithdraw, 'badge-success' : this.$auth.user().CanWithdraw, ' ml-3' : true, 'p-2':true, 'font-weight-bold' : true}"> {{ this.$auth.user().CanWithdraw ? 'Active' : 'On-Hold'}}</span></td>
                                                    </tr>
                                                </table>
                                            </div> -->
                    <div style="padding-left: 30px;" class="header-box user  row">
                       
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <td  class="p-2" style="color: #fff;">Registration Date :</td>
                                </div>
                                <div class="col justify-content-end">
                                    <td class="p-1"  style="color: #fff;">Your IP Address :</td>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                   <td class="p-2" style="text-align: right;color: #f8b882;">{{time}}</td>
                                </div>
                                <div class="col">
                                      <td class="p-1" style="text-align: right;color: #f8b882;">{{getIp}}</td>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column col-xl-5 col-lg-6 col-sm-9 col-12 omega">
                    <h3 class="user-hello" style="visibility:hidden;">Affiliate Link</h3>
                    <div class="top-buttons clearfix">
                    	<router-link class="m-xl-1 mr-lg-0 m-1 mr-0 btn btn-default" to="/user/dashboard/deposit">Make Deposit</router-link>
                    	<router-link  class="m-xl-1 m-1 btn btn-default" to="/user/dashboard/withdraw">Withdrawal</router-link>
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
            return moment(this.$auth.user().created_at).format("MMM Do YYYY")
        }
    },
    mounted() {},
    methods: {}
}

</script>
