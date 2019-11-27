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
                                <div class="acc-block">
                                    <div class="acc-heading clearfix">
                                        <h2>Withdrawals</h2>
                                        <ul class="breadcrumbs">
                                            <li>Main</li>
                                            <li><img :src="$root.basepath + '/img/right-b.png'"></li>
                                            <li class="active">Withdrawals</li>
                                        </ul>
                                    </div>
                                    <div class="acc-body m-0 p-2 Withdrawals">
                                        <form @submit.prevent="getWithdrawals" class="date-from" method="post" name="opts">
                                            <div class="row text-center justify-content-center form-list">
                                                    <div class="form-group col-6">
                                                        <label>From</label>
                                                        <div class="iconed">
                                                            <span class="icon"><i class="fas fa-calendar" aria-hidden="true"></i></span>
                                                            <input type="date" placeholder="select from date" v-model="from" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>To</label>
                                                        <div class="iconed">
                                                            <span class="icon"><i class="fas fa-calendar" aria-hidden="true"></i></span>
                                                            <input type="date" placeholder="select to date" v-model="to" required class="form-control">
                                                        </div>
                                                    </div>
                                           
                                                <div class="form-group col-12">
                                                    <div class="p-2 m-2">
                                                        <div id="example1_filter" class="dataTables_filter">
                                                            <label>Search:<input v-model="search" type="search" class="form-control form-control-lg" placeholder="search">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <h4 class="text-center">List of all Withdrawals</h4>
                                            <p class="small p-2">Total of {{myFilter($root.myFilter(withdrawals,search),from,to).length
                                                }} entries</p>
                                        <div style="max-height: 500px ; overflow: auto" class="stat-table m-0 p-0 table-responsive">
                                            
                                            <table class="stat">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Username</th>
                                                        <th class="text-center">Payment</th>
                                                        <th class="text-center">Remitted</th>
                                                        <th class="text-center">Date</th>
                                                        <th class="text-center"> POP </th>
                                                        <th class="text-center">Reference</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr  v-if="user" v-for="withdrawal,index in myFilter($root.myFilter(withdrawalsx,search),from,to)">
                                                        <td class="text-center">{{withdrawal.username}}</td>
                                                        <td class="text-center">${{$root.normalNumeral(withdrawal.amount)}}</td>
                                                        <td class="text-center">
                                                            <button ref = "withdrawal" @click.prevent="approve(withdrawal,index)" type="button" :class="{btn:true, 'btn-sm':true, 'btn-toggle' : true, active: withdrawal.approved}" data-toggle="button" :aria-pressed="withdrawal.approved" autocomplete="off">
                                                                <div class="handle"></div>
                                                            </button></td>
                                                        <td class="text-center">{{createDate(withdrawal.created_at)}}</td>
                                                        <td class="text-center">
                                                            <span class="text-success" v-if = "withdrawal.pop">
                                                                <button style="text-decoration: none"  @click = "loadViewPOP(withdrawal)" title="view pop" class="text-center btn btn-link  m-1"  type="button"  data-toggle="modal" data-target="#viewPopModal" >
                                                                    <i class="text-success fas fa-eye"></i> 
                                                                </button>
                                                                <button title="replace POP" style="text-decoration: none"  @click = "loadUploadPop(withdrawal)"  class="text-center btn btn-link m-1"  type="button"  data-toggle="modal" data-target="#uploadPopModal" >
                                                                    <i class="text-white fas fa-upload "></i> 
                                                                </button>
                                                            </span>
                                                            <span  v-else>
                                                                <button style="text-decoration: none"  @click = "loadUploadPop(withdrawal)" ref = "popModal" class="text-center btn btn-link m-1"  type="button"  data-toggle="modal" data-target="#uploadPopModal" >
                                                                     <i class=" text-danger fas fa-upload"></i>
                                                                </button>
                                                            </span>
                                                        </td>
                                                        <td class="text-center">{{withdrawal.reference}}</td>
                                                       
                                                        
                                                    </tr>
                                                    <tr v-if="myFilter($root.myFilter(withdrawalsx,search),from,to).slice(0,20).length == 0">
                                                        <th colspan="6" class="p-4" align="center" style="text-align: center;">No withdrawals found.</th>
                                                    </tr>
                                                    <tr v-if="withdrawals" class="mt-4 p-2 m-2">
                                                        <td class="font-weight-bold">Total:</td>
                                                        <td class="font-weight-bold text-success" colspan="5" align="right"><b>{{$root.numeral(myFilter($root.myFilter(withdrawals,search),from,to).sum('amount'))}}</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if = "$root.uploadItem" class="modal fade" id="uploadPopModal">
                            <pop-component @popUploaded = "refreshWithdrawal" @PopModalClosed = "refreshWithdrawal"></pop-component>
                        </div>
                        <div v-if = "$root.viewItem" class="modal fade" id="viewPopModal">
                            <view-component  @viewModalClosed = "resetViewModal"></view-component>
                        </div>
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
            from: '',
            to: '',
            search: '',
            withdrawals: '',
            form: new Form({}),
            withdrawal: null,
        }
    },
    mounted() {
        if (localStorage.withdrawals) {
            this.withdrawals = JSON.parse(localStorage.withdrawals)
        }
        if(this.$route.query.username){
            this.search = this.$route.query.username
        }
        setInterval(this.getWithdrawals, 45000)
        this.getWithdrawals()
    },
    computed: {
        user() {
            return this.$auth.user()
        },
        withdrawalsx(){
            return this.withdrawals
        }
    },
    beforeCreate: function () {
    if (this.$auth.user().isAdmin == false) {this.$auth.logout()}
    },
    methods: {
        getWithdrawals() {
            this.form.get("auth/withdrawals")
                .then(response => {
                    this.withdrawals = response.data.data.item
                    localStorage.withdrawals = JSON.stringify(response.data.data.item)
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        createDate(createDate) {
            return moment(createDate).format("MMM Do YYYY")
        },
        myFilter(list, fromDate, toDate) {
            var data = [];

            if (fromDate) {
                data = list.filter((item) => {
                    var keys = []
                    keys.push(item.created_at)
                    var boolean = false
                    if (item == undefined) {
                        return false
                    }
                    var bool = keys.forEach((item) => {
                        var created_at = new moment(item)
                        var fromDate = this.from != '' ? new moment(this.from.toString()) : new moment().subtract(1, 'd')
                        var toDate = this.to != '' ? new moment(this.to.toString()).add(1, 'd') : new moment().add(1, 'd')
                        if (created_at != null && fromDate <= created_at && toDate >= created_at) {
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
        approve(withdrawal,index) {
            if (!withdrawal.approved) {
                this.$swal({
                    title: `Do you want to approve ${withdrawal.username} request of $${withdrawal.amount}?`,
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#38c172',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve withdrawal'
                })
                .then((result) => {
                    if(result.value == true){
                        this.form.get("/auth/confirm_withdrawal/" + withdrawal.id)
                            .then(response => {
                                this.$root.alert('success', ' ', 'Withdrawal approved successfully')
                                this.getWithdrawals()
                            })
                            .catch(error => {
                                var status = withdrawal.approved ? this.$refs.withdrawal[index].classList.add('active') : this.$refs.withdrawal[index].classList.remove('active')
                                this.$root.alert('error', ' ', 'Withdrawal could not be approved, try again')
                                this.getWithdrawals()
                                console.log(error.response)
                            })
                    }
                    else {
                        var status = withdrawal.approved ? this.$refs.withdrawal[index].classList.add('active') : this.$refs.withdrawal[index].classList.remove('active')
                        // this.$refs.withdrawal[index].classList.remove('active')
                        this.$root.alert('info', ' ', 'Withdrawal dismissed successfully')   
                    }
                    
                })
            }else {
                this.$root.alert('info', ' ', 'Please note that withdrawal can only be approved')
                
            }

        },
        loadUploadPop(item) {
            this.$root.uploadItem = {title : `Upload $${item.amount}  POP for ${item.username }`, url : 'auth/pop', id : item.id}
        },
        refreshWithdrawal(){
            this.getWithdrawals()
            this.$root.uploadItem = null
        },
        loadViewPOP(item){
            this.$root.viewItem = {title : `Viewing $${item.amount}  POP for ${item.username }`,  imgUrl : item.pop}
        },
        resetViewModal(){
            this.$root.viewItem = null
        }
        
    }
}
</script>
