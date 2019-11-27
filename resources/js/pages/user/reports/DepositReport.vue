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
                                <div class="acc-body p-0 deposit-history ">
                                    <div v-if="portfolios" v-for="portfolio in portfolios" class="m-0 p-0 mb-3">
                                        <div v-if = "portfolio.name == 'bronze'" class="plan-wrap m-0 mb-2 clearfix">
                                            <div class="plan-inner">
                                                <div class="plan-in">
                                                    <h3>Bronze</h3>
                                                    <p>5% R.O.I</p>
                                                </div>
                                            </div>
                                            <div class="plan-ad-text">$20.00 - $150.00</div>
                                        </div>
                                        <div v-if = "portfolio.name == 'silver'" class="plan-wrap m-0 mb-2 clearfix">
                                            <div class="plan-inner">
                                                <div class="plan-in">
                                                    <h3>Silver</h3>
                                                    <p>15% R.O.I</p>
                                                </div>
                                            </div>
                                            <div class="plan-ad-text">$200.00 - $2,000.00</div>
                                        </div>
                                        <div v-if = "portfolio.name == 'gold'" class="plan-wrap m-0 mb-2 clearfix">
                                            <div class="plan-inner">
                                                <div class="plan-in">
                                                    <h3>Gold</h3>
                                                    <p>40% R.O.I</p>
                                                </div>
                                            </div>
                                            <div class="plan-ad-text">$5,000.00 - $30,000.00</div>
                                        </div>
                                        <div v-if = "portfolio.name == 'platinum'" class="plan-wrap m-0 mb-2 clearfix">
                                            <div class="plan-inner">
                                                <div class="plan-in">
                                                    <h3>Platinum</h3>
                                                    <p>50% R.O.I</p>
                                                </div>
                                            </div>
                                            <div class="plan-ad-text">$60,000.00 - $200,000.00</div>
                                        </div>
                                        <table class="stat mb-2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Deposit</th>
                                                    <th class="text-center">Interest</th>
                                                    <th class="text-center">Active</th>
                                                    <th class="text-center">Timeout</th>
                                                </tr>
                                            </thead>
                                            <tbody id="body">
                                                <tr v-if="userPackages && packag.portfolio == portfolio.name" v-for="packag in userPackages">
                                                    <td class="text-center">${{$root.numeral(packag.account)}}</td>
                                                    <td class="text-center">${{$root.normalNumeral(packag.interest)}}</td>
                                                    <td class="text-center">{{packag.date}}</td>
                                                    <td class="text-success text-center">{{getDate(packag.expiration)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                    <div class="bal mt-2">
                                        <span>Total:</span> {{$root.numeral(user.totalActiveTransaction)}}
                                    </div>
                                </div>
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
    import moment from 'moment'
export default {
    data() {
        return {
            portfolios: '',
            userPackages: '',
            form: new Form({}),
            select: '',
            error: '',

        }
    },
    mounted() {
        
        if (localStorage.portfolioss) {
            this.portfolios = JSON.parse(localStorage.portfolioss)
        }
        if (localStorage.userPackages) {
            this.userPackages = JSON.parse(localStorage.userPackages)
        }
        setInterval(this.getPackages, 61000)
        this.getPortfolios()
        this.getPackages()
    },
    computed: {
        user() {
            return this.$auth.user()
        },
    },
    methods: {
        getPortfolios() {
            window.scrollTo(0, 250);
            this.form.get("/auth/portfolios")
                .then(response => {
                    this.portfolios = response.data.data.item
                    localStorage.portfolioss = JSON.stringify(response.data.data.item)
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        getPackages() {
            this.form.get("auth/packageusers?active=1&user_id=" + this.user.id)
                .then(response => {
                    this.userPackages = response.data.data.item
                    localStorage.userPackages = JSON.stringify(response.data.data.item)
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        getDate(to) {
            return moment().to(moment(to))
        }
    }
}

</script>
