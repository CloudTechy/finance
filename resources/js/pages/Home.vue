<template>
    <div>
        <!-- <div class="row page-title m-3 p-2">
            <div class="col-12 col-lg-8 container">
                <h1></h1>
                <p>Bfin Financial Services assures you of making the maximum profit. Our company is a big supporter of digital currency and has invested in mining &amp; trading of the most popular cryptocurrency by volume- Bitcoins.</p>
            </div>
        </div> -->
        <section class="main-container" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'"
>
            <div class="main">
                <div class="container">
                    <div class="wrapper" >
                        <div class="row company">
                            <div class=" col p-3 partners-container">
                                <h2 class="company-title">Our Company</h2>
                                <p class="m-0">Bfin Financial Services assures you of making the maximum profit. Our company is a big investor in real estate, oil and gas, gold mining, automobiles and a big supporter of digital currency and has invested in mining &amp; trading of the most popular cryptocurrency by volume - Bitcoins.</p> <br><br>
                                <p class="m-0">BFIN Financial Services started in 2005 as a Financial Advisory Firm and recently in 2017 delved fully into automobiles, real estate, oil and gas, gold and Automated Trading.<br><br> We started creating our own trading strategies, accumulating and interpreting the knowledge gained during the period of analysis, perfecting and adjusting them to the current market trends. Over the past few years, we have been making huge financial gains in so many arears. For Bitcoin mining, the Bfin Financial Services team began construction and organization of mining farms with latest technology computers which enabled mining at great speeds. <br><br>The main objective of our offering is attracting and expanding investments for our company, continuation of Bitcoin mining, gold mining and refining, oil and gas exploration, automobiles along with profitable trading and sharing the returns with our investors.<router-link to="/about" class="btn btn-link" style="display: inline; line-height: 20px; font-size: 13px; color: rgb(183, 183, 183); font-family: Montserrat; text-transform: uppercase;">Read More</router-link>
                                </p>
                                <div class="services mt-3">
                                    <ul class="row">
                                        <li class="col text-center">
                                            <div class="inner-s"><img :src="$root.basepath + '/img/key-1.png'" class="centered-img">
                                                <h4>High growth &amp; substantial returns</h4>
                                                <p>Bfin Financial Services Limited is guided by an excellent team to ensure lofty yields &amp; steady profits in the long run.</p>
                                            </div>
                                        </li>
                                        <li class="col text-center">
                                            <div class="inner-s"><img :src="$root.basepath + '/img/key-2.png'" class="centered-img">
                                                <h4>Outstanding 14% affiliate commission</h4>
                                                <p>Earn splendid five level affiliate commission by referring others. Make us popular &amp; we will make you rich!</p>
                                            </div>
                                        </li>
                                        <li class="col text-center">
                                            <div class="inner-s"><img :src="$root.basepath + '/img/key-4.png'" class="centered-img">
                                                <h4>Registered Company</h4>
                                                <p>Bfin Financial Services is fully registered in United States.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class=" m-0 p-0 mt-4 pt-4  partners-container">
                                    <h2 class="company-title">Our Investment Plans</h2>
                                    <p class="col p-0 mb-4 inv-intro text-center">Bfin Financial Services offers daily, weekly and monthly varieties of profit plans for our valuable investors. The investment plans have been prepared with great care and structured into amazing portfolios. </p><br>
                                    <div class="row p-2">
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <p class="inv-intro p-0  mb-3 text-left  col">
                                                <span class="font-weight-bold">Bronze account features:</span><br>
                                                Deposit: $20 - $150.
                                                Up to 5% R.O.I in 72 Hours minimum.
                                                Eligibility: A New User Can Only Use This Plan Twice.
                                                No Referral Commission.
                                                <div class="mb-5 text-center">
                                                    <router-link  style="width: 100%" to="/user/dashboard/deposit" class="btn btn-inverse">Make Investment</router-link>
                                                </div>
                                            </p>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <p class=" inv-intro p-0 mb-3 text-left  col">
                                                <span class="font-weight-bold">Silver account features:</span><br>
                                                Deposit: $200 - $2,000.
                                                Up to 20% R.O.I.
                                                30 Days minimum turnover.
                                                Eligibility: Open.
                                                5% One time Referral Commission.
                                               <div class="mb-5 text-center">
                                                    <router-link  style="width: 100%" to="/user/dashboard/deposit" class="btn btn-inverse">Make Investment</router-link>
                                                </div>
                                            </p>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <p class=" inv-intro p-0 mb-3 text-left  col">
                                                <span class="font-weight-bold">Gold account features:</span><br>
                                                Deposit: $5,000 - $30,000.
                                                Up to 40% R.O.I.
                                                30 Days turnover.
                                                Eligibility: Open.
                                                10% Referral Commission to the 5th chain.
                                               <div class="mb-5 text-center">
                                                    <router-link  style="width: 100%" to="/user/dashboard/deposit" class="btn btn-inverse">Make Investment</router-link>
                                                </div>
                                            </p>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <p class=" inv-intro p-0 mb-3 text-left  col">
                                                <span class="font-weight-bold">Platinum account features:</span><br>
                                                Deposit: $60,000 - $200,000.
                                                Upto 60%.
                                                14 days turnover.
                                                Eligibility: Open.
                                                10% Referral Commission to the 10th chain.
                                                <div class="mb-5 text-center">
                                                    <router-link  style="width: 100%" to="/user/dashboard/deposit" class="btn btn-inverse">Make Investment</router-link>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="ml-0 m-0 p-0 mt-5 pt-5 get-started">
                                    <h1 class="company-title">How To Get Started</h1>
                                    <p class="col p-0 mb-4 inv-intro text-center">To start your investment journey in Bfin Financial Services Limited you need to follow few simple steps. Starting from account registration to profit withdrawal, every step is comprehensible in our user friendly investment portal. </p><br>
                                    <ul>
                                        <li>
                                            <h3><span>Step 1: </span>Account Registration</h3>
                                            <p>Start by filling in required fields of the application form on the<router-link to="/register" class="btn btn-link" style="display: inline; color: rgb(183, 183, 183); font-family: Montserrat; ">Register</router-link> page. Submit your registration. After that you will be able to log into your account and make your first investment.</p>
                                        </li>
                                        <li>
                                            <h3><span>Step 2: </span>Creating Deposit</h3>
                                            <p>In order to make a deposit you need to use Bitcoin, the most popular digital currency. You can use bitcoin to make a deposit from any of your bitcoin wallet. After logging in to your account in Bfin Financial Services Limited just click on ‘Make a deposit‘ link. </p>
                                        </li>
                                        <li>
                                            <h3><span>Step 3: </span>Wait for the deposit transfer</h3>
                                            <p>Normally Bitcoin deposit is active after 3 confirmations. 3 confirmations from the Bitcoin network take approximately 30 minutes - 1 hour or maybe it can long which depends on bitcoin network. Once the Bitcoin deposit is confirmed it will show in your active deposit according to your subscription plan.<router-link to="/getstarted" class="btn btn-link" style="display: inline; line-height: 20px; font-size: 13px; color: rgb(183, 183, 183); font-family: Montserrat; text-transform: uppercase;">Read More</router-link>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="m-1 mt-4 pt-5 m-0 p-0 partners-container">
                                    <h1 class="company-title">Our Affiliate Program</h1>
                                    <p>If you want passive earning of substantial sums refer quickly to all about Bfin Financial Services Limited &amp; gain extraordinary 14% five level affiliate program. This multi-tier affiliate program will ensure multiple sources of income for you.<router-link to="/partners" class="btn btn-link" style="display: inline; line-height: 20px; font-size: 13px; color: rgb(183, 183, 183); font-family: Montserrat; text-transform: uppercase;">Read More</router-link>
                                    </p>
                                    <h5 class="slogan text-center">Enjoy exceptional upto 14% five levels deep affiliate system structure in Bfin Financial Services Limited.</h5>
                                    <div class="partners-img clearfix"><img :src="$root.basepath + '/img/percentages.png'"> <img :src="$root.basepath + '/img/partners.png'"></div>
                                </div>
                                <div class="page-heading m-0 p-0 mt-4 pt-4  partners-container ">
                                    <h2 class="company-title">Our Data Center Locations</h2>
                                    <p class="col p-0 mb-4 inv-intro text-center">Our powerful datacenters are the backbone of our profitable mining system of Bitcoins. Our business typically relies heavily upon these data centers, making it a focal point and critical asset for everyday mining operations.</p><br>
                                </div>
                                <div class="data-map"><img :src="$root.basepath + '/img/map.png'" class="img-responsive">
                                    <div class="info one" style="top: 50px; left: 400px;"><span class="map-marker"></span>
                                        <div class="center-detail">
                                            <h5 class="city">Amsterdam</h5>
                                            <div class="rates"></div>
                                        </div>
                                    </div>
                                    <div class="info one" style="top: 60px; left: 357px;"><span class="map-marker"></span>
                                        <div class="center-detail">
                                            <h5 class="city">Iceland</h5>
                                            <div class="rates"></div>
                                        </div>
                                    </div>
                                    <div class="info one" style="top: 60px; left: 134px;"><span class="map-marker"></span>
                                        <div class="center-detail">
                                            <h5 class="city">Estonia</h5>
                                            <div class="rates"></div>
                                        </div>
                                    </div>
                                    <div class="info one" style="top: 210px; right: 169px;"><span class="map-marker"></span>
                                        <div class="center-detail">
                                            <h5 class="city">Singapore</h5>
                                            <div class="rates"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="data-center-services">
                                    <h2 class="text-center">Highest standards on all data center facility aspects</h2>
                                    <div class="row">
                                        <div class="column col dcs"><img :src="$root.basepath + '/img/dcs-1.png'" class="centered-img">
                                            <h4>Highly available network</h4>
                                            <p>Bfin Financial Services Limited ‘s datacenters have a high connectivity network which enables smooth hash power for efficient mining of Bitcoins. No downtime due to highly available network, supports uninterrupted mining to go on.</p>
                                        </div>
                                        <div class="column col dcs"><img :src="$root.basepath + '/img/dcs-2.png'" class="centered-img">
                                            <h4>Redundant electrical systems</h4>
                                            <p>In our datacenters redundancy or duplication of critical electrical system components increases reliability of the system, usually in the form of a backup or fail-safe, or to improve actual system performance which supports mining constancy.</p>
                                        </div>
                                        <div class="column col dcs"><img :src="$root.basepath + '/img/dcs-3.png'" class="centered-img">
                                            <h4>High-end physical security</h4>
                                            <p>We make sure the datacenters are safe with installation of surveillance cameras , biometric identification of staff &amp; use of access cards. All these are necessary to secure our datacenters from intrusions &amp; threats.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-0 m-0 p-0 mt-5 pt-5 get-started">
                                    <div class="row  support-wrapper clearfix">
                                        <div class="clear:both"></div>
                                        <ul class="col-lg-4 col-12  support-contacts">
                                            <li style="padding-left:0;">
                                                <h2 class="get-in">Get In Touch</h2>
                                            </li>
                                            <li><img style=" margin-top:5px;" :src="$root.basepath + '/img/support-mail.png'"><a href="mailto:info@bfinetworkshares.com">info@bfinetworkshares.com</a><br><a href="mailto:info@bfinetworkshares.com"></a>
                                            </li>
                                        </ul>
                                        <form class="support-form col-12 col-lg-7 m-1 text-center" method="post" name="mainform" @submit.prevent="submitForm">
                                            <div class="success-msg P-3 m-3" v-if="success && !has_error">
                                                <p v-if="response != undefined">{{response}}</p>
                                            </div>
                                            <ul class="form-list">
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
