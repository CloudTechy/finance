<template>
    <div style="width: inherit;">
        <div class="page-title row page-title m-3 p-2 with-btn">
            <div class=" col-12 col-lg-8  container">
                <h1>Account Login</h1>
                <p>Don't have an account? Click the signup button below for account registration.</p>
                <router-link class="btn btn-default" to="/register">Sign Up</router-link>
            </div>
        </div>
        <section class="main-container">
            <div class="main">
                <div class="container">
                    <div class="wrapper" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
                        <div class="login-wrapper">
                            <div class="login-heading mb-0 text-center">
                                <h2>Enter Login Credentials</h2>
                            </div>
                            <div class="card-body">
                                <div class="error-msg p-2 m-1" v-if="has_error && !success">
                                    <p class="m-1" v-if="error == 'login_error'">Validation Errors.</p>
                                    <p class="m-1" v-else>Error, unable to connect with these credentials.</p>
                                </div>
                                <div class="error-msg p-2 m-1" v-if="success && !this.$auth.user().isEmailVerified"><div class="text-center ml-2"><div class="danger-group p-0 p-md-2  m-1"><h4>Please Verify your Email</h4> <p class="w-note m-1">Thank you for your interest in joining our program, you are now close to becoming an official member of Bfin Network Shares</p> <span>Please login into  to finish up your registration</span></div> <div class="text-center"><button class="btn btn-default">Resend Email</button></div></div></div>

                               
                                <form autocomplete="off" @submit.prevent="login" method="post">
                                    <ul class="form-list">
                                        <li class="row clearfix text-center">
                                            <div class="input-box col-12 p-2  col-md-6">
                                                <label>Username</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                                                    <input type="email" placeholder="email" v-model="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="input-box col-12 p-2  col-md-6">
                                                <label>Password</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-lock" aria-hidden="true"></i></span>
                                                    <input type="password" placeholder="Password" v-model="password" required class="form-control">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="buttons-set text-center">
                                        <button ref="signin" type="submit" class="btn btn-default">Sign In</button>
                                    </div>
                                    <p class="forgot-password">Forgot your password? <router-link to="/forgot_password">Click here to retrieve</router-link>
                                    </p>
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
            email: null,
            password: null,
            success: false,
            has_error: false,
            error: ''
        }
    },
    mounted() {
        window.addEventListener('beforeunload', () => {
            if (!this.$auth.user().isEmailVerified) {
                this.$auth.logout()
            }
        })

    },
    methods: {
        login() {
            this.processing(true)
            var redirect = this.$auth.redirect()
            var app = this
            this.$auth.login({
                data: {
                    email: app.email,
                    password: app.password
                },
                success: function(response) {
                    this.processing(false)
                    var redirectTo = 'dashboard'
                    app.success = true
                     // console.log(redirect)
                     // console.log(redirect  && !this.$auth.user().isEmailVerified)
                    if(redirect  && !this.$auth.user().isEmailVerified){
                       if(redirect.from.path == "/confirm-registration") {
                         this.$router.push(redirect.from.fullPath)
                       }
                    }
                    if (this.$auth.user().isEmailVerified) {
                        if (redirect) {
                            redirectTo = redirect.from.name
                        } else if (this.$auth.user().isAdmin) {
                            redirectTo = 'adminDashboard'
                        }
                         this.$router.push({ name: redirectTo })
                    } 
                },
                error: function(res) {
                    this.processing(false)
                    app.has_error = true
                    app.error = res.response.data.error
                    console.log(res.response)
                },
                rememberMe: true,
                fetchUser: true
            })
        },
        processing(status) {
            if (status) {
                this.$refs.signin.innerText = "Signing in..."
                this.$refs.signin.disabled = true
            } else {
                this.$refs.signin.innerText = "Sign In"
                this.$refs.signin.disabled = false
            }
        },
        resendEmail() {
            var form = new Form({ email: this.email, password: this.password })
            form.post("auth/email/resend/")
                .then(response => {
                    this.$root.alert('success', ' ', 'Email has been sent')
                })
                .catch(error => {
                    this.$root.alert('error', ' ', 'Email was not sent, try again')
                    console.log(error.response)
                })
        }
    },
    
}

</script>
