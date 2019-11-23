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
                                <div class="acc-body p-0 deposit-confirm withdraw-confirm">
                                    <div class="bal p-0 text-center">
                                        <span>Account Balance:</span> {{$root.numeral(user.balance)}}
                                    </div>
                                    <div class="bal p-0 text-center">
                                        <span>Pending Withdrawals:</span> {{$root.numeral(user.totalPendingWithdrawal)}}</div>
                                    <div class="error-msg p-4 m-3" v-if="error">
                                        <p  class="p-2 m-2">{{error}}</p>
                                    </div>
                                    <div class="success-msg p-4 m-4" v-if="message">
                                        <p   class="p-2 m-2">{{message}}</p>
                                    </div>
                                    <form @submit.prevent="withdraw" method="post">
                                        <table class="stat">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Account</th>
                                                    <th>Available</th>
                                                    <th>Pending</th>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td> Dollar</td>
                                                    <td><b style="color:green">{{$root.numeral(user.balance)}}</b></td>
                                                    <td class="text-center"><b style="color:red">{{$root.numeral(user.totalPendingWithdrawal)}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td> Bitcoin</td>
                                                    <td><b style="color:green">{{btc(user.balance)}}</b></td>
                                                    <td class="text-center"><b style="color:red">{{btc(user.totalPendingWithdrawal)}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td> Perfectmoney</td>
                                                    <td><b style="color:green">$0.00</b></td>
                                                    <td class="text-center"><b style="color:red">$0.00</b></td>
                                                </tr>
                                            </thead>
                                        </table>
                                        <br><br>
                                        <ul class="form-list text-left deposit-form-wrapper">
                                            <li class="clearfix floated">
                                                <div class="input-box m-1">
                                                    <label>Withdraw Amount</label>
                                                    <div class="iconed">
                                                        <span class="icon"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
                                                        <input type="number" min="1" :disabled="user.balance <= 0" placeholder="Enter amount to Withdraw" v-model="amount" value="" :class="{'form-control' : true, disabled :user.balance > 0 }">
                                                            <p class="small text-white m-2">maximum amount is {{$root.numeral(user.balance)}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <h3 v-if="user.balance <= 0" class="notice-message m-2 text-center">You have no funds to withdraw.</h3>
                                        <div v-else class="text-center m-2 mb-3 p-3 mb-lg-0">
                                            <button type="submit" ref="process" class="btn btn-default">Withdraw</button>
                                        </div>
                                    </form>
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
export default {
    data() {
        return {
            form: new Form({
                reference: 'SELF',
                user_id: this.$auth.user().id
            }),
            message: '',
            error: '',
            amount: ''
        }
    },
    watch: {
        amount() {
            if (this.amount > this.user.balance) {
                this.amount = this.user.balance
            }
        },
        message() {
            setTimeout(() => { this.message = '' }, 3000);
        },
        error() {
            setTimeout(() => { this.error = '' }, 3000);
        },
    },
    mounted() {
        window.scrollTo(200, 200);
    },
    computed: {
        user() {
            return this.$auth.user()
        },
    },
    methods: {
        processing(status) {
            if (status) {
                this.$refs.process.innerText = "Processing..."
                this.$refs.process.disabled = true
            } else {
                this.$refs.process.innerText = "Withdraw"
                this.$refs.process.disabled = false
            }
        },
        withdraw() {
            this.processing(true)
            this.form.amount = this.amount
            this.form.post("/auth/withdrawals")
                .then(response => {
                    window.scrollTo(0, 200)
                    this.amount = ''
                    this.processing(false)
                    this.error = ''
                    this.message = response.data.message
                })
                .catch(error => {
                    this.message = ''
                    this.error = error.response.data.message
                    this.processing(false)
                    window.scrollTo(0, 200)
                    console.log(error.response)
                })
        },
        btc(amount) {
            if (localStorage.rate) {
                var rate = parseFloat(numeral(JSON.parse(localStorage.rate)).format('00.00'))
                var btc = amount / rate
                return btc.toFixed(8)
            } else {
                return 'N/A'
            }
        },
    }
}

</script>
