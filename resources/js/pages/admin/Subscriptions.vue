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
                                <div class="acc-body m-0 p-0 deposit-history ">
                                    <div class="acc-heading clearfix">
                                        <h2>Subscriptions Overview</h2>
                                        <ul class="breadcrumbs">
                                            <li>Main</li>
                                            <li><img :src="$root.basepath + '/img/right-b.png'"></li>
                                            <li class="active">Subscriptions</li>
                                        </ul>
                                    </div>
                                    <div class="p-2 text-center m-2">
                                        <div id="example1_filter" class="dataTables_filter">
                                            <label>Search:<input v-model="search" type="search" class="form-control form-control-lg" placeholder="search">
                                            </label>
                                        </div>
                                    </div>
                                    <div v-if="portfolios" v-for="portfolio in portfolios" class="m-2 mb-3">
                                        <div v-if="portfolio.name == 'bronze'" class="plan-wrap m-0 mb-2 clearfix">
                                            <div class="plan-inner">
                                                <div class="plan-in">
                                                    <h3>Bronze</h3>
                                                    <p>5% R.O.I</p>
                                                </div>
                                            </div>
                                            <div class="plan-ad-text">$20.00 - $150.00</div>
                                        </div>
                                        <div v-if="portfolio.name == 'silver'" class="plan-wrap m-0 mb-2 clearfix">
                                            <div class="plan-inner">
                                                <div class="plan-in">
                                                    <h3>Silver</h3>
                                                    <p>15% R.O.I</p>
                                                </div>
                                            </div>
                                            <div class="plan-ad-text">$200.00 - $2,000.00</div>
                                        </div>
                                        <div v-if="portfolio.name == 'gold'" class="plan-wrap m-0 mb-2 clearfix">
                                            <div class="plan-inner">
                                                <div class="plan-in">
                                                    <h3>Gold</h3>
                                                    <p>40% R.O.I</p>
                                                </div>
                                            </div>
                                            <div class="plan-ad-text">$5,000.00 - $30,000.00</div>
                                        </div>
                                        <div v-if="portfolio.name == 'platinum'" class="plan-wrap m-0 mb-2 clearfix">
                                            <div class="plan-inner">
                                                <div class="plan-in">
                                                    <h3>Platinum</h3>
                                                    <p>50% R.O.I</p>
                                                </div>
                                            </div>
                                            <div class="plan-ad-text">$60,000.00 - $200,000.00</div>
                                        </div>
                                        <div class="m-0 p-0  table-responsive" style="max-height: 370px; overflow: auto;">
                                            <table class="stat mb-2">
                                                <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Package</th>
                                                        <th>Status</th>
                                                        <th>Interest</th>
                                                        <th>Due date</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="body">
                                                    <tr v-if="usersPackages && packag.portfolio == portfolio.name && !packag.expired" v-for="packag,index in $root.myFilter(usersPackagesx, search)">
                                                        <td>
                                                            <p>
                                                                <button style="text-decoration: none"  @click = "loadViewPOP(packag)" title="view pop" class="text-center btn btn-link  m-1"  type="button"  data-toggle="modal" data-target="#viewPopModal" >
                                                                        <span class="text-light">{{packag.username}}</span>
                                                                    </button>
                                                            </p>
                                                            <div v-if="packag.transaction.pop" style="position: absolute; left: 0" class="collapse mt-2" :id="'s' + packag.id">
                                                                <div style="width: 55%; " class="mt-2 text-success p-2 card card-body">
                                                                    <img class="card-img" :src="$root.basepath + '/img/uploads/'+packag.transaction.pop">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{packag.package}}</td>
                                                        <td>
                                                            <button :ref = "packag.id" @click.prevent="subscribe(packag,packag.id)" type="button" :class="{btn:true, 'btn-sm':true, 'btn-toggle' : true, active: !packag.unsubscribed}" data-toggle="button" :aria-pressed="!packag.unsubscribed" autocomplete="off">
                                                                <div class="handle"></div>
                                                            </button>
                                                        </td>
                                                        <td>${{$root.normalNumeral(packag.interest)}}</td>
                                                        <td class="text-success">{{getDate(packag.expiration)}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </div>
                                    <div v-if="usersPackages" class="bal mt-2">
                                        <span>Total:</span> {{$root.numeral(usersPackages.sum('account'))}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if = "$root.viewItem" class="modal fade" id="viewPopModal">
                            <view-component  @viewModalClosed = "resetViewModal"></view-component>
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
            usersPackages: '',
            form: new Form({}),
            select: '',
            error: '',
            search: '',

        }
    },
    mounted() {

        if (localStorage.portfolioss) {
            this.portfolios = JSON.parse(localStorage.portfolioss)
        }
        if (localStorage.usersPackages) {
            this.usersPackages = JSON.parse(localStorage.usersPackages)
        }
        if (this.$route.query.username) {
            this.search = this.$route.query.username
        }
        setInterval(this.getPackages, 61000)
        this.getPortfolios()
        this.getPackages()
    },
    computed: {
        user() {
            return this.$auth.user()
        },
        usersPackagesx(){
            return this.usersPackages
        }
    },
    beforeCreate: function() {
        if (this.$auth.user().isAdmin == false) { this.$auth.logout() }
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
            this.form.get("auth/packageusers")
                .then(response => {
                    this.usersPackages = response.data.data.item
                    localStorage.usersPackages = JSON.stringify(response.data.data.item)
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        getDate(to) {
            
            return moment().to(moment(to))
        },
        subscribe(packag,index) {
            this.$swal({
                    title:  `Do you want to ${ packag.unsubscribed ? 'activate' : 'deactivate' } ${packag.username}'s ${packag.package} subscription?`,
                    text: "You can revert this changes in future",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#38c172',
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Yes,  ${ packag.unsubscribed ? 'activate' : 'deactivate' } subscription`
                })
                .then((result) => {
                    if(result.value == true){
                        this.form.get("/auth/subscribe/" + packag.transaction.id)
                            .then(response => {
                                this.$root.alert('success', ' ', response.data.message)
                                this.getPackages()
                                var status = packag.unsubscribed ?this.$refs[index][0].classList.remove('active') : this.$refs[index][0].classList.add('active')
                            })
                            .catch(error => {
                                var status = packag.unsubscribed ?this.$refs[index][0].classList.remove('active') : this.$refs[index][0].classList.add('active')
                                this.$root.alert('error', ' ', 'Subscription failed to activate ' + error.response.data.message != undefined ? error.response.data.message : ' ')
                                this.getPackages()
                                console.log(error.response)
                            })
                    }
                    else {
                        var status = packag.unsubscribed ?this.$refs[index][0].classList.remove('active') : this.$refs[index][0].classList.add('active')
                        
                        this.$root.alert('info', ' ', `Subscription  ${ packag.unsubscribed ? ' activation' : ' deactivation' } cancelled`)   
                    }
                    
                })
        },
        loadViewPOP(item){
            this.$root.viewItem = {title : `Viewing ${item.package}  POP for ${item.username }`,  imgUrl : item.transaction.pop}
        },
        resetViewModal(){
            this.$root.viewItem = null
        }
    }
}

</script>
<style>
.example .btn-toggle {
    top: 50%;
    transform: translateY(-50%);
}

.btn-toggle {
    margin: 0 4rem;
    padding: 0;
    position: relative;
    border: none;
    height: 1.5rem;
    width: 3rem;
    border-radius: 1.5rem;
    color: #6b7381;
    background: #bdc1c8;
}

.btn-toggle:focus,
.btn-toggle.focus,
.btn-toggle:focus.active,
.btn-toggle.focus.active {
    outline: none;
}

.btn-toggle:before,
.btn-toggle:after {
    line-height: 1.5rem;
    width: 4rem;
    text-align: center;
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: absolute;
    bottom: 0;
    transition: opacity 0.25s;
}

.btn-toggle:before {
    content: 'Off';
    left: -4rem;
}

.btn-toggle:after {
    content: 'On';
    right: -4rem;
    opacity: 0.5;
}

.btn-toggle>.handle {
    position: absolute;
    top: 0.1875rem;
    left: 0.1875rem;
    width: 1.125rem;
    height: 1.125rem;
    border-radius: 1.125rem;
    background: #fff;
    transition: left 0.25s;
}

.btn-toggle.active {
    transition: background-color 0.25s;
}

.btn-toggle.active>.handle {
    left: 1.6875rem;
    transition: left 0.25s;
}

.btn-toggle.active:before {
    opacity: 0.5;
}

.btn-toggle.active:after {
    opacity: 1;
}

.btn-toggle.btn-sm:before,
.btn-toggle.btn-sm:after {
    line-height: -0.5rem;
    color: #fff;
    letter-spacing: 0.75px;
    left: 0.4125rem;
    width: 2.325rem;
}

.btn-toggle.btn-sm:before {
    text-align: right;
}

.btn-toggle.btn-sm:after {
    text-align: left;
    opacity: 0;
}

.btn-toggle.btn-sm.active:before {
    opacity: 0;
}

.btn-toggle.btn-sm.active:after {
    opacity: 1;
}

.btn-toggle.btn-xs:before,
.btn-toggle.btn-xs:after {
    display: none;
}

.btn-toggle:before,
.btn-toggle:after {
    color: #6b7381;
}

.btn-toggle.active {
    background-color: #29b5a8;
}

.btn-toggle.btn-lg {
    margin: 0 5rem;
    padding: 0;
    position: relative;
    border: none;
    height: 2.5rem;
    width: 5rem;
    border-radius: 2.5rem;
}

.btn-toggle.btn-lg:focus,
.btn-toggle.btn-lg.focus,
.btn-toggle.btn-lg:focus.active,
.btn-toggle.btn-lg.focus.active {
    outline: none;
}

.btn-toggle.btn-lg:before,
.btn-toggle.btn-lg:after {
    line-height: 2.5rem;
    width: 5rem;
    text-align: center;
    font-weight: 600;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: absolute;
    bottom: 0;
    transition: opacity 0.25s;
}

.btn-toggle.btn-lg:before {
    content: 'Off';
    left: -5rem;
}

.btn-toggle.btn-lg:after {
    content: 'On';
    right: -5rem;
    opacity: 0.5;
}

.btn-toggle.btn-lg>.handle {
    position: absolute;
    top: 0.3125rem;
    left: 0.3125rem;
    width: 1.875rem;
    height: 1.875rem;
    border-radius: 1.875rem;
    background: #fff;
    transition: left 0.25s;
}

.btn-toggle.btn-lg.active {
    transition: background-color 0.25s;
}

.btn-toggle.btn-lg.active>.handle {
    left: 2.8125rem;
    transition: left 0.25s;
}

.btn-toggle.btn-lg.active:before {
    opacity: 0.5;
}

.btn-toggle.btn-lg.active:after {
    opacity: 1;
}

.btn-toggle.btn-lg.btn-sm:before,
.btn-toggle.btn-lg.btn-sm:after {
    line-height: 0.5rem;
    color: #fff;
    letter-spacing: 0.75px;
    left: 0.6875rem;
    width: 3.875rem;
}

.btn-toggle.btn-lg.btn-sm:before {
    text-align: right;
}

.btn-toggle.btn-lg.btn-sm:after {
    text-align: left;
    opacity: 0;
}

.btn-toggle.btn-lg.btn-sm.active:before {
    opacity: 0;
}

.btn-toggle.btn-lg.btn-sm.active:after {
    opacity: 1;
}

.btn-toggle.btn-lg.btn-xs:before,
.btn-toggle.btn-lg.btn-xs:after {
    display: none;
}

.btn-toggle.btn-sm {
    margin: 0 0.5rem;
    padding: 0;
    position: relative;
    border: none;
    height: 1.5rem;
    width: 3rem;
    border-radius: 1.5rem;
}

.btn-toggle.btn-sm:focus,
.btn-toggle.btn-sm.focus,
.btn-toggle.btn-sm:focus.active,
.btn-toggle.btn-sm.focus.active {
    outline: none;
}

.btn-toggle.btn-sm:before,
.btn-toggle.btn-sm:after {
    line-height: 1.5rem;
    width: 0.5rem;
    text-align: center;
    font-weight: 600;
    font-size: 0.55rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: absolute;
    bottom: 0;
    transition: opacity 0.25s;
}

.btn-toggle.btn-sm:before {
    content: 'Off';
    left: -0.5rem;
}

.btn-toggle.btn-sm:after {
    content: 'On';
    right: -0.5rem;
    opacity: 0.5;
}

.btn-toggle.btn-sm>.handle {
    position: absolute;
    top: 0.1875rem;
    left: 0.1875rem;
    width: 1.125rem;
    height: 1.125rem;
    border-radius: 1.125rem;
    background: #fff;
    transition: left 0.25s;
}

.btn-toggle.btn-sm.active {
    transition: background-color 0.25s;
}

.btn-toggle.btn-sm.active>.handle {
    left: 1.6875rem;
    transition: left 0.25s;
}

.btn-toggle.btn-sm.active:before {
    opacity: 0.5;
}

.btn-toggle.btn-sm.active:after {
    opacity: 1;
}

.btn-toggle.btn-sm.btn-sm:before,
.btn-toggle.btn-sm.btn-sm:after {
    line-height: -0.5rem;
    color: #fff;
    letter-spacing: 0.75px;
    left: 0.4125rem;
    width: 2.325rem;
}

.btn-toggle.btn-sm.btn-sm:before {
    text-align: right;
}

.btn-toggle.btn-sm.btn-sm:after {
    text-align: left;
    opacity: 0;
}

.btn-toggle.btn-sm.btn-sm.active:before {
    opacity: 0;
}

.btn-toggle.btn-sm.btn-sm.active:after {
    opacity: 1;
}

.btn-toggle.btn-sm.btn-xs:before,
.btn-toggle.btn-sm.btn-xs:after {
    display: none;
}

.btn-toggle.btn-xs {
    margin: 0 0;
    padding: 0;
    position: relative;
    border: none;
    height: 1rem;
    width: 2rem;
    border-radius: 1rem;
}

.btn-toggle.btn-xs:focus,
.btn-toggle.btn-xs.focus,
.btn-toggle.btn-xs:focus.active,
.btn-toggle.btn-xs.focus.active {
    outline: none;
}

.btn-toggle.btn-xs:before,
.btn-toggle.btn-xs:after {
    line-height: 1rem;
    width: 0;
    text-align: center;
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: absolute;
    bottom: 0;
    transition: opacity 0.25s;
}

.btn-toggle.btn-xs:before {
    content: 'Off';
    left: 0;
}

.btn-toggle.btn-xs:after {
    content: 'On';
    right: 0;
    opacity: 0.5;
}

.btn-toggle.btn-xs>.handle {
    position: absolute;
    top: 0.125rem;
    left: 0.125rem;
    width: 0.75rem;
    height: 0.75rem;
    border-radius: 0.75rem;
    background: #fff;
    transition: left 0.25s;
}

.btn-toggle.btn-xs.active {
    transition: background-color 0.25s;
}

.btn-toggle.btn-xs.active>.handle {
    left: 1.125rem;
    transition: left 0.25s;
}

.btn-toggle.btn-xs.active:before {
    opacity: 0.5;
}

.btn-toggle.btn-xs.active:after {
    opacity: 1;
}

.btn-toggle.btn-xs.btn-sm:before,
.btn-toggle.btn-xs.btn-sm:after {
    line-height: -1rem;
    color: #fff;
    letter-spacing: 0.75px;
    left: 0.275rem;
    width: 1.55rem;
}

.btn-toggle.btn-xs.btn-sm:before {
    text-align: right;
}

.btn-toggle.btn-xs.btn-sm:after {
    text-align: left;
    opacity: 0;
}

.btn-toggle.btn-xs.btn-sm.active:before {
    opacity: 0;
}

.btn-toggle.btn-xs.btn-sm.active:after {
    opacity: 1;
}

.btn-toggle.btn-xs.btn-xs:before,
.btn-toggle.btn-xs.btn-xs:after {
    display: none;
}

.btn-toggle.btn-secondary {
    color: #6b7381;
    background: #bdc1c8;
}

.btn-toggle.btn-secondary:before,
.btn-toggle.btn-secondary:after {
    color: #6b7381;
}

.btn-toggle.btn-secondary.active {
    background-color: #ff8300;
}

</style>
