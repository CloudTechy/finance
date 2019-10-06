<template>
    <div style="width: inherit;">
        <div class="page-title row page-title m-3 p-0 with-btn">
            <div class=" col-12 col-lg-8  container">
                <h1>account Registration</h1>
                <p>Already have an account? Click here to login</p>
                <router-link class="btn btn-default" to="/login">Sign In</router-link>
            </div>
        </div>
        <section class="main-container">
            <div class="main">
                <div class="container">
                    <div class="wrapper" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
                        <div class="register-wrapper">
                            <div v-if="!success" class="register-form p-0 m-0">
                                <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                                    <div class="login-heading">
                                        <h2>Account Information</h2>
                                    </div>
                                    <div class="error-msg  m-3" v-if="has_error && !success">
                                        <p class="p-2 m-3" v-if="error == 'registration_validation_error'">Validation Errors.</p>
                                        <p class="p-2 m-3"  v-else>Error, can not register at the moment. If the problem persists, please contact an administrator.</p>
                                    </div>
                                    <ul class="form-list p-1">
                                        <li class="row clearfix">
                                            <div class="col-12 p-2  col-md-6">
                                                <label>First Name</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-user" aria-hidden="true"></i></span>
                                                    <input type="text" required v-model="first_name" placeholder="Your first name" :class="{'form-control' : true, 'error-input': errors.first_name != undefined}">
                                                    <p v-if="errors.first_name" v-for="error in errors.first_name" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2  col-md-6">
                                                <label>Last Name</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-user" aria-hidden="true"></i></span>
                                                    <input type="text" required placeholder="Your last name" v-model="last_name" :class="{'form-control' : true, 'error-input': errors.last_name != undefined}">
                                                    <p v-if="errors.last_name" v-for="error in errors.last_name" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="row clearfix">
                                            <div class="col-12 p-2  col-md-6">
                                                <label>Username</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-user" aria-hidden="true"></i></span>
                                                    <input type="text" required v-model="username" placeholder="Username" :class="{'form-control' : true, 'error-input': errors.username != undefined}">
                                                    <p v-if="errors.username" v-for="error in errors.username" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2  col-md-6">
                                                <label>Phone Number</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-user" aria-hidden="true"></i></span>
                                                    <input type="text" v-model="number" placeholder="Your phone number" :class="{'form-control' : true, 'error-input': errors.number != undefined}">
                                                    <p v-if="errors.number" v-for="error in errors.number" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="row clearfix">
                                            <div class="col-12 p-2  col-md-6">
                                                <label>Email Address</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                                                    <input type="email" required="" v-model="email" placeholder="Email address" :class="{'form-control' : true, 'error-input': errors.email != undefined}">
                                                    <p v-if="errors.email" v-for="error in errors.email" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2  col-md-6">
                                                <label>Re-type Email Address</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                                                    <input type="email" required v-model="email_confirmation" placeholder="Re-type Email address" :class="{'form-control' : true, 'error-input': errors.email_confirmation != undefined}">
                                                    <p v-if="errors.email_confirmation" v-for="error in errors.email_confirmation" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="row clearfix">
                                            <div class="col-12 p-2  col-md-6">
                                                <label>Password</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-lock" aria-hidden="true"></i></span>
                                                    <input type="password" min="4" required placeholder="Password" v-model="password" :class="{'form-control' : true, 'error-input': errors.password != undefined}">
                                                    <p v-if="errors.password" v-for="error in errors.password" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2  col-md-6">
                                                <label>Re-type Password</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-lock" aria-hidden="true"></i></span>
                                                    <input type="password" required v-model="password_confirmation" placeholder="Re-type Password" :class="{'form-control' : true, 'error-input': errors.password_confirmation != undefined}">
                                                    <p v-if="errors.password_confirmation" v-for="error in errors.password_confirmation" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="login-heading">
                                        <h2>Payment Address</h2>
                                        <p>Enter your Payment wallet address in below field, make sure you enter the correct Payment address where you will received the payments.</p>
                                    </div>
                                    <ul class="form-list p-1">
                                        <li>
                                            <div class="col-12 p-2 ">
                                                <label>Your Bitcoin wallet address</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                                                    <input type="text" placeholder="Your Bitcoin wallet address" v-model="wallet" :class="{'form-control' : true, 'error-input': errors.wallet != undefined}">
                                                    <p v-if="errors.wallet" v-for="error in errors.wallet" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="form-list p-1">
                                        <li>
                                            <div class="col-12 p-2">
                                                <label>Your Perfectmoney USD ACCOUNT NUMBER</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                                                    <input type="text" placeholder="Your Perfectmoney USD ACCOUNT NUMBER" v-model="pm" :class="{'form-control' : true, 'error-input': errors.pm != undefined}">
                                                    <p v-if="errors.pm" v-for="error in errors.pm" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="form-list p-1">
                                        <li>
                                            <div class="col-12 p-2">
                                                <label>Refferer</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-user"></i></span>
                                                    <input type="text" required="" placeholder="Enter referral username" v-model="referral" :class="{'form-control' : true, 'error-input': errors.referral != undefined}">
                                                    <p v-if="errors.referral" v-for="error in errors.referral" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="form-list p-1">
                                        <li class="row clearfix">
                                            <div class="col-12 p-2  col-md-6">
                                                <label>Secret question</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-question" aria-hidden="true"></i></span>
                                                    <input type="text" required="" v-model="secret_question" placeholder="Secret question" :class="{'form-control' : true, 'error-input': errors.secret_question != undefined}">
                                                    <p v-if="errors.secret_question" v-for="error in errors.secret_question" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2  col-md-6">
                                                <label>Secret answer</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-reply" aria-hidden="true"></i></span>
                                                    <input type="text" required="" v-model="secret_answer" placeholder="Secret answer" :class="{'form-control' : true, 'error-input': errors.secret_answer != undefined}">
                                                    <p v-if="errors.secret_answer" v-for="error in errors.secret_answer" class="text-danger m-0 p-2">{{error}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="accept-terms text-center">
                                        <label class="small">Completing your registration you agree with Terms of Bfin Financial Services Limited</label>
                                    </div>
                                    <div class="buttons-set text-center">
                                        <button ref="signup" type="submit" class="btn btn-default">Sign Up</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
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
            first_name: '',
            last_name: '',
            number: '',
            email: '',
            username: '',
            email_confirmation: '',
            password: '',
            password_confirmation: '',
            secret_answer: '',
            secret_question: '',
            pm: '',
            referral: this.$route.query.ref ? this.$route.query.ref : null,
            wallet: '',
            has_error: false,
            error: '',
            errors: {},
            success: false
        }
    },
    mounted() {},
    methods: {
        register() {
            this.processing(true)
            var app = this
            this.$auth.register({
                data: {
                    first_name: app.first_name,
                    email: app.email,
                    email_confirmation: app.email_confirmation,
                    last_name: app.last_name,
                    number: app.number,
                    secret_answer: app.secret_answer,
                    secret_question: app.secret_question,
                    username: app.username,
                    pm: app.pm,
                    wallet: app.wallet,
                    user_level_id: 2,
                    referral: app.referral,
                    ip: this.$root.ip,
                    password: app.password,
                    password_confirmation: app.password_confirmation
                },
                success: function() {
                    this.$root.alert('success', '', 'Registration Successful!!! Redirecting...')
                    this.processing(false)
                    app.success = true
                 // this.$router.push({ name: 'login', params: { successRegistrationRedirect: true } })
                },
                error: function(res) {
                    window.scrollTo(0, 300)
                    app.has_error = true
                    app.error = res.response.data.message
                    app.errors = res.response.data.error || {}
                    this.processing(false)
                }
            })
        },
        processing(status) {
            if (status) {
                this.$refs.signup.innerText = "processing..."
                this.$refs.signup.disabled = true
            } else {
                this.$refs.signup.innerText = "Sign Up"
                this.$refs.signup.disabled = false
            }
        },
        resendEmail() {
            this.form.post("/email/resend/")
                .then(response => {
                    this.$root.alert('success', ' ', 'Email has been sent')
                })
                .catch(error => {
                    this.$root.alert('error', ' ', 'Email was not sent, try again')
                    console.log(error.response)
                })
        }
    }
}

</script>
