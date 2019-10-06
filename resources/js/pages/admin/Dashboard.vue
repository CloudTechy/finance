<template>
    <div class="m-0 p-0">
        <AdminDashboardHeader></AdminDashboardHeader>
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
                            <AdminDashboardSidebar></AdminDashboardSidebar>
                            <div class="columns col-xl-9 p-0 pl-lg-2 col-lg-9 col-12 main-acc">
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
                                                <h4>Account Income</h4>
                                                <span>{{$root.numeral(users.sum('balance'))}}</span>
                                            </div>
                                            <div class="s-box col-sm-4 col-12 p-2">
                                                <img :src="$root.basepath + '/img/box-2.png'">
                                                <h4>Active Trading</h4>
                                                <span>{{$root.numeral(users.sum('totalActiveTransaction'))}}</span>
                                            </div>
                                            <div class="s-box col-sm-4 col-12 p-2">
                                                <img :src="$root.basepath + '/img/box-3.png'">
                                                <h4>Total Giveaway</h4>
                                                <span>{{$root.numeral(users.sum('totalEarned'))}}</span>
                                            </div>
                                        </div>
                                        <h3 class="acc-sub-heading'">Account Statistics</h3>
                                        <div class="simple-stats">
                                            <ul class="clearfix">
                                                <li>
                                                    <img :src="$root.basepath + '/img/stat-deposit.png'">
                                                    <p>Total Deposits: <span>{{$root.numeral(users.sum('totalDeposit'))}}</span></p>
                                                </li>
                                                <li>
                                                    <img :src="$root.basepath + '/img/stat-withdraw.png'">
                                                    <p>Total Withdrawals: <span>{{$root.numeral(users.sum('totalWithdraw'))}}</span></p>
                                                </li>
                                                <li>
                                                    <img :src="$root.basepath + '/img/stat-last-deposit.png'">
                                                    <p>Last Deposit: <span>{{$root.numeral(users.sum('lastDeposit'))}}</span></p>
                                                </li>
                                                <li>
                                                    <img :src="$root.basepath + '/img/stat-last-withdrawal.png'">
                                                    <p>Last Withdrawal: <span>{{$root.numeral(users.sum('lastWithdraw'))}}</span></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                 <div class="acc-block affiliate-link">
                                    <div class="acc-heading clearfix">
                                        <h2>Admin Affiliate Link</h2>
                                    </div>
                                    <div class="acc-body p-0 clearfix">
                                        <div class="aff-link-1 clearfix">
                                            <a class="aff-link p-0" id="foo" :href="Referral_link">{{Referral_link}}</a>
                                            <button v-clipboard="Referral_link" class="btn btn-default small" style="float:right;" data-clipboard-target="#foo">Copy</button>
                                        </div>
                                    </div>
                                </div>
                                <!--  content ends here -->
                            </div>
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
        return {
            error: null,
            message: null,
            users: []
        }
    },
    mounted() {

    },
    computed: {
        user() {
            return this.$auth.user()
        },
        Referral_link() {
            return this.$root.basepath + '/register?ref=' + this.user.username
        }
    },
    beforeCreate: function () {
    if (this.$auth.user().isAdmin == false) {this.$auth.logout()}
    },
    created() {
        if (localStorage.users) {
            this.users = JSON.parse(localStorage.users)
        }
        this.getUsers()

    },
    methods: {
        getUsers() {
            var form = new Form
            form.get("/auth/users")
                .then(response => {
                    this.users = response.data.data.item
                    localStorage.users = JSON.stringify(this.users)
                })
                .catch(error => {
                    console.log(error)
                })
        },

    }
}

</script>
