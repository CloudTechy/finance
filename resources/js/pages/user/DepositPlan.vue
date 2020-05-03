<template>
    <div class="acc-block">
        <div class="acc-heading clearfix">
            <h2>Deposit</h2>
            <ul class="breadcrumbs">
                <li>Main</li>
                <li><img :src="$root.basepath + '/img/right-b.png'"></li>
                <li class="active">Deposit</li>
            </ul>:
        </div>
        <div class="success-msg text-capitalize  m-3" v-if="msg">
            <p  class="p-2 m-2">{{msg}} </p>
        </div>
        <div class="error-msg  m-3" v-if="error">
            <p  class="p-2 m-2">{{error}}</p>
        </div>
        <form method="post" name="spendform">
            <input type="hidden" name="a" value="deposit">
            <div class="acc-body p-0 deposit">
                <div class="bal p-0 text-center">
                    <span>Account Balance:</span> {{$root.numeral(user.balance)}}
                </div>
                <div class="acc-inv-plans text-center">
                    <h2>Our Investment Portfolios</h2>
                    <p>Select the plan that best suites you to continue</p>
                    <div class="accordion mb-4" id="accordionExample">
                        <div @click="selectPortfolio(portfolio.name)" v-if="portfolios" v-for="portfolio in portfolios" class="m-1">
                            <div :class="{'card-header' : true,silver : true, 'mb-3' : true, gold : selectedPortfolio == portfolio.name}" :id="'h-'+portfolio.name">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-capitalize font-weight-bold" type="button" data-toggle="collapse" :data-target="'#' + portfolio.name" aria-expanded="true" :aria-controls="portfolio.name">
                                        {{portfolio.name + ' Portfolio'}}
                                    </button>
                                </h2>
                            </div>
                            <div class="m-0 p-0 row collapse" :id="portfolio.name" :aria-labelledby="'h-'+portfolio.name" data-parent="#accordionExample">
                                <div class="col-sm-6 col-12" v-for="packag in packages" v-if="packag.portfolio == portfolio.name">
                                    <div class="plan-wrap">
                                        <div :class="{'plan-inner' : true, 'plan-selection' : true, selected : select == packag.name}">
                                            <input type="radio" @click="updateSelection(packag)" v-model="form.amount" :value="packag.deposit">
                                            <span :class="{selection : select == packag.name}"></span>
                                            <div class="plan-in">
                                                <h3>${{$root.normalNumeral(packag.deposit)}}</h3>
                                                <p class="font-weight-bold">Deposit Plan</p>
                                                <span class="range font-weight-bold">{{packag.duration + ' days duration'}}</span>
                                                <p class="font-weight-bold">${{$root.normalNumeral(packag.interest_rate)}} R.O.I</p>
                                                <span class="range  text-capitalize">{{packag.portfolio + ' Plan'}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="form-list text-left deposit-form-wrapper">
                        <li class="clearfix floated">
                            <div class="input-box m-1">
                                <label>Deposit Amount</label>
                                <div class="iconed">
                                    <span class="icon"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
                                    <input type="number" placeholder="Choose your plan" disabled v-model="form.amount" value="" class="form-control">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div v-if="selectedPackage" class="text-center  mb-3 mb-l-0">
                <button ref = "deposit" v-if="user.balance < selectedPackage.deposit" @click.prevent="processDeposit" class="btn btn-default">Make a Deposit</button>
                <button ref="process" v-if="user.balance > selectedPackage.deposit" @click.prevent="subscribe" class="btn btn-default">Subscribe</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            portfolios: '',
            packages: '',
            form: new Form({
                amount: '',
                user_id: this.user.id,
                package_id: '',
                reference: 'SELF',
            }),
            selectedPackage: '',
            select: '',
            selectedPortfolio: '',
            error: '',
            msg: this.success,

        }
    },
    watch: {
        msg() {
            setTimeout(() => { this.msg = '' }, 10000);
        },
        error() {
            setTimeout(() => { this.error = '' }, 10000);
        },
    },
    props: ['user', 'success'],
    mounted() {
        if (localStorage.portfolioss) {
            this.portfolios = JSON.parse(localStorage.portfolioss)
        }
        if (localStorage.packages) {
            this.packages = JSON.parse(localStorage.packages)
        }
        this.getPortfolios()
        this.getPackages()
        this.$root.getIp()
    },
    methods: {
        getPortfolios() {

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
            this.form.get("/auth/packages")
                .then(response => {
                    this.packages = response.data.data.item
                    localStorage.packages = JSON.stringify(response.data.data.item)
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        updateSelection(pack) {
            this.selectedPackage = pack
            this.select = pack.name
        },
        selectPortfolio(portfollio) {
            this.selectedPortfolio = portfollio
        },
        numeral(value) {
            return numeral(value).format('0,0')
        },
        processDeposit() {
            this.processDepo(true)
            var form = new Form({amount: this.selectedPackage.deposit, id : this.user.id, ip : this.$root.ip})
            var wlt = this.user.admin_wallet
            // console.log(wlt)
            form.post("/auth/showWlt")
                .then(response => {
                    wlt = response.data.data.wallet
                    this.selectedPackage.wallet = wlt
                    this.$emit('changeComponent', 'ConfirmDeposit', this.selectedPackage)  
                    this.processDepo(false)
                })
                .catch(error => {
                    this.selectedPackage.wallet = wlt
                    this.$emit('changeComponent', 'ConfirmDeposit', this.selectedPackage)  
                    this.processDepo(false)
                })
            // if(this.user.packages.length > 0){
            //     this.$emit('changeComponent', 'ConfirmDeposit', this.selectedPackage)  
            //     // this.error = 'Oops!!! There is an active subscription on this account'
            //     // window.scrollTo(0, 200)
            // }
            // else{
            //   this.$emit('changeComponent', 'ConfirmDeposit', this.selectedPackage)  
            // }
            
        },
        subscribe() {
            this.processing(true)
            this.form.package_id = this.selectedPackage.id
            this.form.post("/auth/packageusers")
                .then(response => {
                    window.scrollTo(0, 200)
                    this.processing(false)
                    this.error = ''
                    this.msg = response.data.message
                })
                .catch(error => {
                    window.scrollTo(0, 200)
                    this.success = ''
                    this.error = error.response.data ? error.response.data.message : 'Subscription was not successful'
                    this.processing(false)
                })
        },
        processing(status) {
            if (status) {
                this.$refs.process.innerText = "Processing..."
                this.$refs.process.disabled = true
            } else {
                this.$refs.process.innerText = "Subscribe"
                this.$refs.process.disabled = false
            }
        },
        processDepo(status) {
            if (status) {
                this.$refs.deposit.innerText = "processing..."
                this.$refs.deposit.disabled = true
            } else {
                this.$refs.deposit.innerText = "Make a Deposit"
                this.$refs.deposit.disabled = false
            }
        }
    }
}

</script>
<style scoped="">
.btn:focus {
    box-shadow: none !important;
}

.silver {
    background: linear-gradient(to right, #a7a7a7 0%, #eaeaea 100%);
}

.gold {
    background: linear-gradient(to right, #e25e5a 0%, #e25e5a 0%, #f8b982 100%, #f8b982 100%, #f8b982 100%);
}

</style>
