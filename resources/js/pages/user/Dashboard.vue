<template>
    <div class="m-0 p-0">
        <DashboardHeader></DashboardHeader>
        <section class="main-container m-lg-3 m-0 acc">
            <div class="main">
                <!--start wrapper-->
                <div class="container">
                    <div class="wrapper" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;min-height:400px;'">
                        <div class="account-wrapper m-xl-2 row m-0 ">
                            <nav class="nav  navbar-dark ml-4 ml-lg-0 mb-3 mb-lg-b p-0 mt-3 navbar navbar-expand-lg ">
                                <button @click="" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar4">
                                    <span class="navbar-toggler-icon "></span>
                                </button>
                            </nav>
                            <DashboardSidebar></DashboardSidebar>
                            <div class="columns col-xl-9 p-0 pl-lg-2 col-lg-9 col-12 main-acc">
                                <div v-if = "user.withdraw_request" style="width : 98% !important" class="success-group p-2 m-2">
                                    <h4>Important Notice</h4>
                                    <p class="w-note ml-5 m-3">You have indicated interest to put your withdrawal on hold for a specific period of time. </p> <span>Please <button class="text-center btn btn-link text-light p-0 font-weight-bold font-italic  m-1" type="button" data-toggle="modal" data-target="#pausewithdrawal">click here
                                        </button> to complete this process.</span>
                                </div>
                                <!-- content goes here -->
                                <div class="acc-block overview">
                                    <div class="acc-heading clearfix">
                                        <h2>Account Overview</h2>
                                        <ul class="breadcrumbs">
                                            <li>Main</li>
                                            <li><img :src="$root.basepath + '/img/right-b.png'"></li>
                                            <li class="active">Overview</li>
                                        </ul>
                                    </div>
                                    <div class="acc-body ">
                                        <div class="stat-box row ">
                                            <div class="s-box col-sm-4 col-12 p-2">
                                                <img :src="$root.basepath + '/img/box-1.png'">
                                                <h4>Account Balance</h4>
                                                <span>{{$root.numeral(user.balance)}}</span><br>
                                                <span style="font-size: 70%" v-if = "this.$auth.user().canWithdraw == false"  :class="{badge:true, 'badge-danger' :  !this.$auth.user().CanWithdraw, small : true,'badge-success' : this.$auth.user().CanWithdraw, ' m-1' : true, 'p-1':true, }"> {{ this.$auth.user().CanWithdraw ? 'Active' : 'On-Hold'}}</span>
                                            </div>
                                            <div class="s-box col-sm-4 col-12 p-2"> 
                                                <img :src="$root.basepath + '/img/box-2.png'">
                                                <h4>Active Deposit</h4>
                                                <span>{{$root.numeral(user.totalActiveTransaction)}}</span>
                                            </div>
                                            <div class="s-box col-sm-4 col-12 p-2">
                                                <img :src="$root.basepath + '/img/box-3.png'">
                                                <h4>Total Earned</h4>
                                                <span>{{$root.numeral(user.totalEarned)}}</span>
                                            </div>
                                        </div>
                                        <h3 class="acc-sub-heading'">Account Statistics</h3>
                                        <div class="simple-stats">
                                            <ul class="clearfix">
                                                <li>
                                                    <img :src="$root.basepath + '/img/stat-deposit.png'">
                                                    <p>Total Deposits: <span>{{$root.numeral(user.totalDeposit)}}</span></p>
                                                </li>
                                                <li>
                                                    <img :src="$root.basepath + '/img/stat-withdraw.png'">
                                                    <p>Total Withdrawals: <span>{{$root.numeral(user.totalWithdraw)}}</span></p>
                                                </li>
                                                <li>
                                                    <img :src="$root.basepath + '/img/stat-last-deposit.png'">
                                                    <p>Last Deposit: <span>{{$root.numeral(user.lastDeposit)}}</span></p>
                                                </li>
                                                <li>
                                                    <img :src="$root.basepath + '/img/stat-last-withdrawal.png'">
                                                    <p>Last Withdrawal: <span>{{$root.numeral(user.lastWithdraw)}}</span></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="acc-block affiliate-link">
                                    <div class="acc-heading clearfix">
                                        <h2>Affiliate Link</h2>
                                    </div>
                                    <div class="acc-body p-0 clearfix">
                                        <div class="aff-link-1 clearfix">
                                            <a class="aff-link" id="foo" :href="Referral_link">{{Referral_link}}</a>
                                            <button v-clipboard="Referral_link" class="btn btn-default small" style="float:right;" data-clipboard-target="#foo">Copy</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="acc-inv-plans text-center">
                                    <h2>Our Investment Plans</h2>
                                    <div class="plan-wrap justify-content-center row">
                                        <div class="plan-inner col-sm-6 col-12 p-2 m-2">
                                            <div class="plan-in">
                                                <h3>5%</h3>
                                                <p>5% <span>R.O.l in 72 hours</span></p>
                                            </div>
                                        </div>
                                        <div class="plan-inner col-sm-6 col-12 p-2 m-2">
                                            <div class="plan-in">
                                                <h3>20%</h3>
                                                <p>20% <span>7 days turnover</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mb-3 mb-l-0">
                                        <router-link class="btn btn-default" to="/user/dashboard/deposit">Make Deposit</router-link>
                                    </div>
                                </div>
                                <!--  content ends here -->
                            </div>
                        </div>
                        <div v-if="user.withdraw_request" ref="pausewithdrawal" class="modal fade" id="pausewithdrawal">
                            <pause-withdrawal-component></pause-withdrawal-component>
                        </div>
                        <!--end account wrapper-->
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data() {
        return {}
    },
    mounted() {
        window.scrollTo(200, 200);
    },
    computed: {
        user() {
            return this.$auth.user()
        },
        Referral_link() {
            return this.$root.basepath + '/register?ref=' + this.user.username
        }
    },
    methods: {

    }
}

</script>
