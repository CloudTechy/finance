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
                                        <h2>Settings</h2>
                                        <ul class="breadcrumbs">
                                            <li>Main</li>
                                            <li><img :src="$root.basepath + '/img/right-b.png'"></li>
                                            <li class="active">Settings</li>
                                        </ul>
                                    </div>
                                    <div class="success-msg m-2" v-if="message">
                                        <p>{{message}}</p>
                                    </div>
                                    <form autocomplete="off" @submit.prevent="editProfile" method="post">
                                        <div class="acc-body m-0 p-0 settings">
                                            <div class="setting-bar clearfix">
                                                <p>Username : <span>{{user.username}}</span></p>
                                                <p>Registration Date : <span>{{reg_date}}</span></p>
                                            </div>
                                            <ul class="form-list">
                                                <li class="one-half clearfix">
                                                    <div class="input-box">
                                                        <label>First Name</label>
                                                        <input type="text" v-model="form.first_name" class="form-control">
                                                        <p v-if="errors.first_name" v-for = "error in errors.first_name" class="text-danger m-0 p-2">{{error}}</p>
                                                    </div>
                                                    <div class="input-box">
                                                        <label>Last Name</label>
                                                        <input type="text" v-model="form.last_name" class="form-control">
                                                        <p v-if="errors.last_name" v-for = "error in errors.last_name" class="text-danger m-0 p-2">{{error}}</p>
                                                    </div>
                                                </li>
                                                <li class="one-half clearfix">
                                                    <div class="input-box">
                                                        <label>Phone Number</label>
                                                        <input type="number" v-model="form.number" class="form-control">
                                                        <p v-if="errors.number" v-for = "error in errors.number" class="text-danger m-0 p-2">{{error}}</p>
                                                    </div>
                                                    <div class="input-box">
                                                        <label>Email Address</label>
                                                        <input type="email" v-model="form.email" class="form-control">
                                                        <p v-if="errors.email" v-for = "error in errors.email" class="text-danger m-0 p-2">{{error}}</p>
                                                    </div>
                                                </li>
                                                <li class="one-half clearfix">
                                                    <div class="input-box">
                                                        <label>New Password</label>
                                                        <input type="password" required="" v-model="form.password" class="form-control">
                                                        <p v-if="errors.password" v-for = "error in errors.password" class="text-danger m-0 p-2">{{error}}</p>
                                                    </div>
                                                    <div class="input-box">
                                                        <label>Re-type Password</label>
                                                        <input type="password" required="" v-model="form.password_confirmation" class="form-control">
                                                        <p v-if="errors.password_confirmation" v-for = "error in errors.password_confirmation" class="text-danger m-0 p-2">{{error}}</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="input-box">
                                                        <label>Your Bitcoin wallet address</label>
                                                        <input type="text" class="form-control" size="30" v-model="form.wallet"></div>
                                                        <p v-if="errors.wallet" v-for = "error in errors.wallet" class="text-danger m-0 p-2">{{error}}</p>
                                                </li>
                                                <li>
                                                    <div class="input-box">
                                                        <label>Your Perfectmoney USD ACCOUNT NUMBER</label>
                                                        <input type="text" class="form-control" size="30" v-model="form.pm"></div>
                                                        <p v-if="errors.pm" v-for = "error in errors.pm" class="text-danger m-0 p-2">{{error}}</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text-center p-2">
                                            <button type="submit" class="btn btn-default">Save Data</button>
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
import moment from 'moment'
export default {
    data() {
        return {
            form: new Form({
                first_name: '',
                last_name : '',
                number : '',
                password : '',
                password_confirmation : '',
                wallet : '',
                pm : '',
                email : ''
            }),
            message: '',
            error: '',
            errors: {}
        }
    },
     watch: {
        message() {
            setTimeout(() => { this.message = '' }, 3000);
        },
    },
    mounted() {
        this.form.fill(this.user)
    },
    computed: {
        user() {
            return this.$auth.user()
        },
        reg_date() {
            return moment().format("MMM Do YYYY h:mm:ss a")
        }
    },
    methods: {
        editProfile() {
            this.form.patch("/auth/users/" + this.user.id)
                .then(response => {
                    window.scrollTo(0, 250);
                    this.message = "Your profile has beeen updated"
                })
                .catch(error => {
                    this.errors = error.response.data.error || {}
                    this.$root.alert('error', ' ', 'Update was not successful, try again...')
                    
                })

        }
    }
}

</script>
