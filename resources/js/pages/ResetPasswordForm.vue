<template>
    <div style="width: inherit;">
        <div class="page-title row page-title m-3 p-2 with-btn">
            <div class=" col-12 col-lg-8  container">
                <h1>Reset Password</h1>
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
                                <h2>Enter details to reset your password</h2>
                            </div>
                            <div class="card-body">
                                <ul class="error-msg P-3 m-3" v-if="errors.error">
                                    <li v-if = "errors.error.token" v-for="error in errors.error.token" >{{ error }}</li>
                                    <li v-if = "errors.error.password" v-for="error in errors.error.password" >{{ error }}</li>
                                    <li v-if = "errors.error.email" v-for="error in errors.error.email" >{{ error }}</li>
                                </ul>
                                <form autocomplete="off" @submit.prevent="resetPassword" method="post">
                                    <ul class="form-list m-2">
                                        <li class="row clearfix text-center">
                                            <div class="input-box col-12 ">
                                                <label>Email</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                                                    <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="form-list m-2">
                                        <li class="row clearfix text-center">
                                            <div class="input-box col-12 col-md-6">
                                                <label for="email">Password</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-lock" aria-hidden="true"></i></span>
                                                    <input type="password" id="password" class="form-control" placeholder="" v-model="password" required>
                                                </div>
                                            </div>
                                            <div class="input-box col-12 col-md-6">
                                                <label for="email">Confirm Password</label>
                                                <div class="iconed">
                                                    <span class="icon"><i class="fas fa-lock" aria-hidden="true"></i></span>
                                                    <input type="password" id="password_confirmation" class="form-control" placeholder="" v-model="password_confirmation" required>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="buttons-set text-center">
                                        <button ref="process" type="submit" class="btn btn-default">Update</button>
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
            token: null,
            email: null,
            password: null,
            password_confirmation: null,
            has_error: false,
            errors: [],
        }
    },
    methods: {
        resetPassword() {
            this.processing(true)
            this.$http.post("/auth/reset/password/", {
                    token: this.$route.query.token,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                .then(result => {
                    // console.log(result.data);
                    this.processing(false)
                    this.has_error = false
                    this.$root.alert('success','','Password Reset Successful!!! Redirecting...')
                    this.$router.push({ name: 'login' })
                }, error => {
                    this.has_error = true
                    this.processing(false)
                    this.errors = error.response.data != undefined ? error.response.data : this.errors.push('Password reset not successful, check that your email is valid')
                    console.error(error.response)
                });
        },
        processing(status) {
            if (status) {
                this.$refs.process.innerText = "processing..."
                this.$refs.process.disabled = true
            } else {
                this.$refs.process.innerText = "Update"
                this.$refs.process.disabled = false
            }
        }
    }
}

</script>
