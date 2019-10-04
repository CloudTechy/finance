<template>
    <div>
        <div class="row page-title m-3 p-2">
            <div class="col-12 col-lg-8 container">
                <h1>Registration Confirmation</h1>
            </div>
        </div>
        <!--start main container-->
        <section class="main-container">
            <div class="main">
                <div class="container">
                    <div class="wrapper" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
                        <div v-if="success" class="text-center">
                            <div class="success-group">
                                <h4  class="p-2 m-2">Registration Completed</h4>
                                <p class="w-note p-2 m-2">Thank you for joining our program, you are now official member of Bfin Network Shares</p>
                                <span class="p-2">Please login into your account to continue and keep safe your login credentials!</span>
                            </div>
                            <div class="text-center">
                                <router-link :to="$auth.user().isAdmin ? '/admin/dashboard' : '/user/dashboard/'" class="btn btn-default">Go to Dashboard</router-link>
                            </div>
                        </div>
                        <div v-if="!success && !has_error && !message">
                            <div class="m-2 alert alert-warning p-3" role="alert">
                                <p  class="p-2 m-2"> Make sure you are partially logged in to confirm your email. </p>
                                <p  class="p-2 m-2">Email verification is taking place...</p>
                            </div>
                        </div>
                        <div class="error-msg  m-3 p-4" v-if="has_error">
                            <p class="p-lg-3 p-md-3 p-2 m-2">Your email could not be verified at this moment. Please Try again later</p>
                        </div>
                         <div class="success-msg  m-3 p-4" v-if="message">
                            <p class="p-lg-3 p-md-3 p-2 m-2">{{message}}</p>
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
            form: new Form({
                username: '',
                email: ''
            }),
            success: false,
            has_error: false,
            error: '',
            message: ''
        }
    },
    mounted() {
        const queryURL = this.$route.query.queryURL;
        
         if (this.$auth.user().isEmailVerified) {
            this.message = "This email has already been verified"
        }
        else {
            this.confirmEmail()
        }
    },
    methods: {
        confirmEmail() {
            //this.processing(true)
            this.form.post(this.$route.query.queryURL)
                .then(response => {
                    window.scrollTo(0, 200)
                    //this.processing(false)
                    this.error = ''
                    this.success = true
                    this.message = response.data.message
                    console.log(response)
                })
                .catch(error => {
                    this.message = ''
                    this.has_error = true
                    this.error = error.response.data.message
                    //this.processing(false)
                    console.log(error.response)
                })
        }
    },
    beforeDestroy() {
        if (!this.$auth.user().isEmailVerified) {
            this.$auth.logout()
        }
    }
}

</script>
