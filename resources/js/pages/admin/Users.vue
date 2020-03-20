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
                                            <li class="active">Users</li>
                                        </ul>
                                    </div>
                                    <div class="acc-body">
                                        <div class="stat-box row ">
                                            <div class="s-box col-sm-4 col-12 p-2">
                                                <img :src="$root.basepath + '/img/box-1.png'">
                                                <h4>Total Users</h4>
                                                <span>{{users.length}}</span>
                                            </div>
                                            <div class="s-box col-sm-4 col-12 p-2">
                                                <img :src="$root.basepath + '/img/box-3.png'">
                                                <h4>Administrators</h4>
                                                <span>{{admins}}</span>
                                            </div>
                                            <div class="s-box col-sm-4 col-12 p-2">
                                                <img :src="$root.basepath + '/img/box-2.png'">
                                                <h4>Active Users</h4>
                                                <span>{{activeUsers}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="acc-body ">
                                        <div class="stat-box row ">
                                            <div class="s-box  col-12 p-2">
                                                <img :src="$root.basepath + '/img/box-4.png'">
                                                <h4>Search User</h4>
                                                <div class="input-group input-group-sm p-1">
                                                    <input v-model="search" list="users" type="text" class="p-lg-3 p-sm-2 p-3 form-control" placeholder="Search user by username here...">
                                                </div>
                                                <datalist id="users">
                                                    <option class="p-2" v-for="user in users" :value="user.username"></option>
                                                </datalist>
                                            </div>
                                            <div v-if = "search && selectedUser"  v-for="user in selectedUser" class="s-box  col-12 p-2">
                                                <table>
                                                    <tr>
                                                        <td>Withdrawal Status </td>
                                                        <td> <span :class="{badge:true, 'badge-danger' :  !user.CanWithdraw, 'badge-success' : user.CanWithdraw, ' ml-3' : true, 'p-2':true, 'font-weight-bold' : true}"> {{ user.CanWithdraw ? 'Active' : 'On-Hold'}}</span></td>
                                                    </tr>
                                                </table>
                                            </div>

                                        </div>
                                        <div v-if="search && selectedUser" v-for="user in selectedUser" class="stat-box row">
                                            <div class="s-box col-12 p-2">
                                                <h3 class="text-capitalize card-title">{{user.username + " Account Details"}}</h3>
                                            </div>
                                            <div class="s-box col-sm-4 col-12 p-2">
                                                <img :src="$root.basepath + '/img/box-1.png'">
                                                <h4>Account Balance</h4>
                                                <span>{{$root.numeral(user.balance)}}</span>
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
                                            <div class="stat-box row mt-2">
                                                <div class="s-box col-12 p-2">
                                                    <h3 class="acc-sub-heading'">Account Statistics</h3>
                                                </div>
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
                                                        <li>
                                                            <img :src="$root.basepath + '/img/stat-last-withdrawal.png'">
                                                            <p>Sent Withdrawals: <span>{{$root.numeral(user.totalPendingWithdrawal)}}</span></p>
                                                        </li>
                                                        <li>
                                                            <img :src="$root.basepath + '/img/key-2.png'">
                                                            <p>Ref Users: <span>{{user.referrals}}</span></p>
                                                        </li>
                                                        <li>
                                                            <img :src="$root.basepath + '/img/key-2.png'">
                                                            <p> Active Ref: <span>{{user.activeReferrals}}</span></p>
                                                        </li>
                                                        <li>
                                                            <img :src="$root.basepath + '/img/box-6.png'">
                                                            <p>Ref paid: <span>{{$root.numeral(user.totalCommission)}}</span></p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="stat-box row mt-2 mb-0">
                                                <div class="s-box col-12 p-2">
                                                    <h3 class="acc-sub-heading'">Personal Details</h3>
                                                </div>
                                                <div class="simple-stats p-0 m-auto">
                                                    <ul class="clearfix">
                                                        <li class="m-0 p-2">
                                                            <p>First Name: <span>{{user.first_name}}</span></p>
                                                        </li>
                                                        <li class="m-0 p-2">
                                                            <p>Last Name: <span>{{user.last_name}}</span></p>
                                                        </li>
                                                        <li class="m-0 p-2">
                                                            <p>Joined: <span>{{user.date}}</span></p>
                                                        </li>
                                                        <li v-if="user.number" class="m-0 p-2">
                                                            <p>Phone: <span><input type="text" readonly="" class="form-control" :value="user.number"></span></p>
                                                        </li>
                                                        <li v-if="user.email" class="m-0 p-2">
                                                            <p>Email <span><input type="text" readonly="" class="form-control" :value="user.email"></span></p>
                                                        </li>
                                                        <li v-if="user.user_level" class="m-0 p-2">
                                                            <p>User Level: <span><input type="text" readonly="" class="form-control" :value="user.user_level"></span></p>
                                                        </li>
                                                        <li v-if="user.wallet" class="m-0 p-2">
                                                            <p>Wallet: <span><input type="text" readonly="" class="form-control" :value="user.wallet"></span></p>
                                                        </li>
                                                        <li v-if="user.pm" class="m-0 p-2">
                                                            <p>PM: <span><input type="text" class="form-control" :value="user.pm"></span></p>
                                                        </li>
                                                        <li v-if="user.admin_wallet" class="m-0 p-2">
                                                            <p>Admin Wallet: <span><input type="text" readonly="" class="form-control" :value="user.admin_wallet"></span></p>
                                                        </li>
                                                        <li v-if="user.admin_pm" class="m-0 p-2">
                                                            <p>Admin PM: <span><input type="text" class="form-control" :value="user.admin_pm"></span></p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class=" s-box col-12 p-2">
                                                <div class="row">
                                                    <div class="s-box col p-2">
                                                        <ul class="clearfix">
                                                            <li>
                                                                <p>Admin Wallet: <span> <input @change="updateData" v-model="form.admin_wallet" type="text" class=" form-control" placeholder="Enter wallet address for this user"></span></p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="s-box col p-2">
                                                        <ul class="clearfix">
                                                            <li>
                                                                <p>Admin PM: <span> <input @change="updateData" v-model="form.admin_pm" type="text" class=" form-control" placeholder="Enter pm account for this user"></span></p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-box mt-3 s-box col-12 p-2">
                                                <div class="row mt-3">
                                                    <div class="text-center col-12 justify-content-center mb-3 mb-l-0">
                                                        <button ref="process" @click.prevent="userLevel(user)" class="btn btn-default">{{userLevelTitle}}</button>
                                                        <button @click.prevent="sendEmail(user)" class="btn btn-default" data-toggle="modal" data-target="#sendEmailModal">{{'Send Email'}}</button>
                                                        <button ref = 'pause' @click.prevent="pause(user)" class="btn btn-default">{{'Toggle Pause Withdrawal'}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  content ends here -->
                            </div>
                        </div>
                        <div v-if="$root.mailUser" class="modal fade" id="sendEmailModal">
                            <email-component @emailModalClosed="resetEmailModal"></email-component>
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
                admin_wallet: null,
                admin_pm: null,
                id: null,
                user_level_id: null
            }),
            error: null,
            message: null,
            users: [],
            activeUsers: 0,
            admins: 0,
            selectedUser: [],
            search: '',
            userLevelTitle: this.selectedUser && this.selectedUser.isAdmin == true ? 'Make User' : 'Make Admin'
        }
    },
    mounted() {

    },
    watch: {
        users() {
            this.users.forEach((user, index) => {
                if (user.totalActiveTransaction > 0) {
                    this.activeUsers++
                }
            });
            this.admins = []
            this.users.forEach((user, index) => {
                if (user.isAdmin == true) {
                    this.admins++
                }
            });
        },
        selectedUser() {
            if (this.selectedUser.isAdmin == true) {
                this.userLevelTitle = 'Make User'
            } else {
                this.userLevelTitle = 'Make Admin'
            }
        },
        search() {
            this.getSelectedUser()
        },
    },

    computed: {
        user() {
            return this.$auth.user()
        }
    },

    beforeCreate: function() {
        if (this.$auth.user().isAdmin == false) { this.$auth.logout() }
    },
    created() {
        if (localStorage.users) {
            this.users = JSON.parse(localStorage.users)
        }
        // if (this.$auth.user().isAdmin == false) {this.$auth.logout()}
       setInterval(this.getUsers, 20000) 
    },
    methods: {
        getUsers() {
            this.form.get("/auth/users")
                .then(response => {
                    this.users = response.data.data.item
                    localStorage.users = JSON.stringify(this.users)
                    this.getSelectedUser()
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getSelectedUser() {
            if (this.search && this.users) {
                this.selectedUser = this.users.filter((item) => {
                    if (item.username.toLowerCase() == this.search.toLowerCase()) {
                        this.form.fill(item)
                        return true
                    }
                })
            }
        },
        updateData() {
            this.form.put("/auth/users/" + this.form.id)
                .then(response => {
                    this.$root.alert('success', ' ', 'update successful')
                    this.getUsers()
                })
                .catch(error => {
                    this.$root.alert('error', ' ', 'update not successful')
                    console.log(error.response)
                })
        },
        userLevel(user) {
            // / var form = new Form({ user_level_id: '' })
            if (user.isAdmin) {
                this.form.user_level_id = 2
                this.form.put("/auth/users/" + this.form.id)
                    .then(response => {
                        this.$root.alert('success', ' ', 'update user-level to user successful')
                        this.userLevelTitle = "Make Admin"
                        this.getUsers()
                    })
                    .catch(error => {
                        this.$root.alert('error', ' ', 'update user-level to user not successful')
                        console.log(error.response)
                    })
            } else {
                this.form.user_level_id = 1
                this.form.put("/auth/users/" + this.form.id)
                    .then(response => {
                        this.$root.alert('success', ' ', 'update user-level to admin successful')
                        this.userLevelTitle = "Make User"
                        this.getUsers()
                    })
                    .catch(error => {
                        this.$root.alert('error', ' ', 'update user-level to admin not successful')
                        console.log(error.response)
                    })
            }
        },
        sendEmail($user) {
            this.$root.mailUser = $user;
        },
        resetEmailModal() {
            this.$root.mailUser = null
        },
        pause(user){
            var user =  this.selectedUser[0]
                this.$swal({
                    title:  `Do you want to ${ user.withdraw_request ? 'stop the pausing withdrawal process' : 'start the pausing withdrawal process'  } for  ${user.username}?`,
                    text: "You can revert this changes in future",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#38c172',
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Yes,  ${ user.withdraw_request ?  'stop'  : 'start'} pausing withdrawal Process`
                })
                .then((result) => {
                    if(result.value == true){
                        this.processing(true)
                        if(user.withdraw_request){
                            this.form.get("/auth/cancelWithdrawalRequest/" + user.id)
                            .then(response => {
                                this.getUsers()
                                this.$root.alert('success', ' ', response.data.message)
                                this.processing(false)
                            })
                            .catch(error => {
                                this.$root.alert('error', ' ', 'pausing withdrawal process failed ' + error.response.data.message != undefined ? error.response.data.message : ' ')
                                this.processing(false)
                                console.log(error.response)
                            })
                        }
                        else {
                           this.form.get("/auth/confirmWithdrawalRequest/" + user.id)
                            .then(response => {
                                this.getUsers()
                                this.$root.alert('success', ' ', response.data.message)
                                this.processing(false)
                            })
                            .catch(error => {
                                this.$root.alert('error', ' ', 'pausing withdrawal process failed ' + error.response.data.message != undefined ? error.response.data.message : ' ')
                                this.processing(false)
                                console.log(error.response)
                            }) 
                        }
                        
                    }
                    else {
                        
                        this.$root.alert('info', ' ', `Pausing withdrawal Process  ${ user.withdraw_request ? ' started' : ' cancelled' } `)   
                    }
                    this.getUsers()
                    
                })
        },
         processing(status) {
            if (status) {
                this.$refs.pause[0].innerText = "Processing..."
                this.$refs.pause[0].disabled = true
            } else {
                this.$refs.pause[0].innerText = "Toggle Pause Withdrawal"
                this.$refs.pause[0].disabled = false
            }
        },
    },


}

</script>
