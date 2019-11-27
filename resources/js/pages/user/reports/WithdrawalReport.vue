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
                                <div class="acc-block">
                                    <div class="acc-heading clearfix">
                                        <h2>Withdrawal History</h2>
                                        <ul class="breadcrumbs">
                                            <li>Main</li>
                                            <li><img :src="$root.basepath + '/img/right-b.png'"></li>
                                            <li class="active">Withdrawal History</li>
                                        </ul>
                                    </div>
                                    <div class="acc-body transactions">
                                        <form @submit.prevent="getWithdrawals" class="date-from" method="post" name="opts">
                                            <ul class="form-list">
                                                <li class="row clearfix text-center">
                                                    <div class="input-box col-12 m-2">
                                                        <label>From</label>
                                                        <div class="iconed">
                                                            <span class="icon"><i class="fas fa-calendar" aria-hidden="true"></i></span>
                                                            <input type="date" placeholder="select from date" v-model="from" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="input-box col-12 m-2">
                                                        <label>To</label>
                                                        <div class="iconed">
                                                            <span class="icon"><i class="fas fa-calendar" aria-hidden="true"></i></span>
                                                            <input type="date" placeholder="select to date" v-model="to" required class="form-control">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </form>
                                        <div class="stat-table p-0 m-0 table-responsive">
                                            <h4 class="text-center">List of your Withdrawal</h4>
                                                <p class="small p-2">Maximum of 20 entries</p>
                                                <p class="small p-2">Total of {{myFilter(user.withdrawals,from,to).slice(0,20).length
                                                }} entries</p>
                                                <table class="stat">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Reference</th>
                                                            <th class="text-center">Amount</th>
                                                            <th class="text-center">Date</th>
                                                            <th class="text-center">POP</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody >
                                                        <tr v-if="user" v-for="withdraw in myFilter(user.withdrawals,from,to).slice(0,20)">
                                                            <td class="text-center">{{withdraw.reference}}</td>
                                                            <td class="text-center">${{$root.normalNumeral(withdraw.amount)}}</td>
                                                            <td class="text-center">{{createDate(withdraw.created_at)}}</td>
                                                            <td class="text-center">
                                                                <span class="text-success" v-if = "withdraw.pop">  
                                                                    <button style="text-decoration: none"  @click = "loadViewPOP(withdraw)" title="view pop"  class="text-center btn btn-link  m-1"  type="button"  data-toggle="modal" data-target="#viewPopModal" >
                                                                        <i class="text-success fas fa-eye"></i> 
                                                                    </button> 
                                                                </span>
                                                                <span class="text-danger" v-else>
                                                                      <i class=" fas fa-window-close"></i>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                          <tr v-if = "myFilter(user.withdrawals,from,to).slice(0,20).length == 0">
                                                            <th colspan="3" class="p-4" align="center" style="text-align: center;">No withdrawals found.</th>
                                                        </tr>
                                                        <tr class="mt-4 p-2 m-2">
                                                            <td class="font-weight-bold">Total:</td>
                                                            <td class="font-weight-bold text-success" colspan="3" align="right"><b>{{$root.numeral(myFilter(user.withdrawals,from,to).sum('amount'))}}</b></td>
                                                        </tr> 
                                                    </tbody>
                                                </table>
                                           
                                        </div>
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
            from:'',
            to: '',
        }
    },
    mounted() {

    },
    computed: {
        user() {
            return this.$auth.user()
        },
    },
    methods: {
        getWithdrawals() {

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
                        var fromDate = this.from != '' ? new moment(this.from.toString()) : new moment().subtract(1,'d')
                        var toDate = this.to != '' ? new moment(this.to.toString()).add(1,'d') : new moment().add(1,'d')
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
        loadViewPOP(item){
            this.$root.viewItem = {title : `Viewing $${item.amount}  POP for ${this.createDate(item.created_at) }`,  imgUrl : item.pop}
        },
        resetViewModal(){
            this.$root.viewItem = null
        }
    }
}

</script>
