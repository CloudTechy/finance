<template>
    <div>
        <div class="row page-title m-3 p-2">
            <div class="col-12 col-lg-8 container">
                <h1>Support Center</h1>
                <p>A comprehensive FAQ answers most of the common queries. Nevertheless, if you still have any questions or doubts remaining , you may contact us anytime. We will get back to you in the shortest possible time.</p>
            </div>
        </div>
        <!--start main container-->
        <section class="main-container">
            <div class="main">
                <div class="container">
                    <div class="wrapper" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
                        <div class="row  support-wrapper clearfix">
                            <div class="clear:both"></div>
                            <ul class="col-lg-4 col-12  support-contacts">
                                <li style="padding-left:0;">
                                    <h2 class="get-in">Get In Touch</h2>
                                </li>
                                <li>
                                    <img :src="$root.basepath + '/img/support-marker.png'"><address>440 S. LASALLE ST., STE. 900,<br>CHICAGO,<br> IL 60605 USA</address>
                                </li>
                                <li><img style=" margin-top:5px;" :src="$root.basepath + '/img/support-mail.png'"><a href="mailto:support@Bfin%20Financial%20Services">info@bfinetworkshares.com</a><br><a href="mailto:info@Bfin%20Financial%20Services"></a>
                                </li>
                            </ul>
                            <form class="support-form col-12 col-lg-7 m-1 text-center" method="post" name="mainform" @submit.prevent="submitForm">
                                <div class="success-msg P-3 m-3" v-if="success && !has_error">
                                    <p v-if="response != undefined">{{response}}</p>
                                </div>
                                <ul class="form-list">
                                    <li class="row clearfix">
                                        <div class="col-12 p-1 col-md-6 input-box">
                                            <label>Username</label>
                                            <input type="text" v-model="form.username" disabled="" placeholder="Username or Full Name" value="" class="form-control">
                                        </div>
                                        <div class="col-12 p-1 col-md-6 input-box">
                                            <label>Email Address</label>
                                            <input type="text" v-model="form.email" disabled="" placeholder="Email Address" value="" class="form-control">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-box">
                                            <label>Your Message</label>
                                            <textarea required="" minlength="12" name="message" class="form-control" placeholder="Write your message here"> </textarea>
                                        </div>
                                    </li>
                                </ul>
                                <div class="buttons-set text-center">
                                    <button class="btn btn-default">Submit</button>
                                </div>
                            </form>
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
                username: this.$auth.user().username,
                email: this.$auth.user().email
            }),
            success: false,
            has_error: false,
            error: '',
            response: ''
        }
    },
    mounted() {
        //
    },
    methods: {
        submitForm() {
            this.has_error = false;
            this.success = true;
            this.response = "Your message was delivered, you will be contacted as soon as possible."
        }
    }
}

</script>
