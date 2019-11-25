<template>
    <div style="width: inherit;">
        <div class="page-title row page-title m-3 p-2 with-btn">
            <div class=" col-12 col-lg-8  container">
                <h1>Forgot Password</h1>
                <p>Don't have an account? Click the button signup below for account registration.</p>
                <router-link class="btn btn-default" to="/register">Sign Up</router-link>
            </div>
        </div>
        <section class="main-container" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
            <div class="main">
                <div class="container">
                    <div class="wrapper">
                        <div class="login-wrapper">
                            <div class="login-heading mb-0 text-center">
                                <h2>Enter Email address to reset your password</h2>
                                <p>Then submit your email address, if your account is found in our system you will receive confirmation link sent to your email address. click on the link to reset your password successfully.</p>
                            </div>
                            <div class="card-body">
                                <div class="error-msg P-3 m-3" v-if="has_error && !success">
                                    <p v-if="errors.error.email" v-for="error in errors.error.email">{{error}}</p>
                                    <p v-else>Error, unable to process with these credentials.</p>
                                </div>
                                <div class="success-msg P-3 m-3" v-if="success && !has_error">
                                    <p v-if="response != undefined">{{response.message}}</p>
                                </div>
                                <form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
                                    <ul class="form-list">
                                        <li class="row clearfix text-center">
                                            <div class="input-box col-12">
                                                <label>Email</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                                                    <input type="email" required v-model="email" placeholder="Email address" value="" class="form-control" size="30">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="buttons-set text-center">
                                        <button ref="process" type="submit" class="btn btn-default">Send Password Reset Link</button>
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
            email: null,
            has_error: false,
            response: '',
            success: false,
            errors: ''
        }
    },
    methods: {
        requestResetPassword() {
            this.processing(true)
            this.$http.post("/auth/reset-password", { email: this.email }).then(result => {
                this.processing(false)
                this.response = result.data
                this.success = true
                this.has_error = false
                // console.log(result.data)
            }, error => {
                this.processing(false)
                this.has_error = true
                this.success = false
                // console.error(error.response)
                this.errors = error.response.data
            });
        },
        processing(status) {
            if (status) {
                this.$refs.process.innerText = "processing..."
                this.$refs.process.disabled = true
            } else {
                this.$refs.process.innerText = "Send Password Reset Link"
                this.$refs.process.disabled = false
            }
        }
    }
}

</script>
