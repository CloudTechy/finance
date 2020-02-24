<template>
    <div>
        <div class="row page-title m-3 p-2">
            <div class="col-12 col-lg-8 container">
                <h1>Email confirmation link sent</h1>
            </div>
        </div>
        <!--start main container-->
        <section class="main-container"  :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
            <div class="main">
                <div class="container">
                    <div class="wrapper">
                        <div class="text-center">
                            <div class="success-group">
                                <h4 class="p-2 m-2">Verify your Email</h4>
                                <p class="w-note m-2 p-3">Thank you for your interest in joining our program, you are now close to becoming an official member of  Biofeed Investment Network Shares</p>
                                <span class="p-2">Please login into your email account to finish up your registration</span>
                            </div>
                            <div class="text-center">
                                <router-link to="/login" class="btn btn-default">Login</router-link>
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
           
        }
    },
    mounted() {
        if (this.$auth.check()) {
            this.$auth.logout()
        }
    },
}

</script>
