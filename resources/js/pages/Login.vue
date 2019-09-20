<template>
    <!-- <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <div class="card card-default">
          <div class="card-header">Login</div>
          <div class="card-body">
            <div class="alert alert-danger" v-if="has_error && !success">
              <p v-if="error == 'login_error'">Validation Errors.</p>
              <p v-else>Error, unable to connect with these credentials.</p>
            </div>
            <form autocomplete="off" @submit.prevent="login" method="post">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
              </div>
              <button type="submit" class="btn btn-primary">Signin</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> -->
    <div>
        <div class="page-title">
            <div class="container">
                <h1>About Us</h1>
                <p>Bfin Financial Services assures you of making the maximum profit. Our company is a big supporter of digital currency and has invested in mining &amp; trading of the most popular cryptocurrency by volume- Bitcoins.</p>
            </div>
        </div>
        <!--start main container-->
        <section class="main-container">
            <div class="main">
                <!--start wrapper-->
                <div class="container">
                    <div class="wrapper" :style="'background:url('+ $root.basepath +'img/about-us-wrap.png) no-repeat 0 0;'">
                        <div class="row company">
                            <div class="columns ten company-profile">
                                <h2 class="company-title">Our Company</h2>
                                <p class="sub-title">Read on to know more about Bfin Financial Services Limited.</p>
                                <p>BFIN Financial Services started in 2016 as a Financial Advisory Firm and in 2017 delved into Automated Trading. We started creating our own trading strategies, accumulating and interpreting the knowledge gained during the period of analysis, perfecting and adjusting them to the current market trends. Over the past few years, we have been making huge financial gains. For Bitcoin mining, the Bfin Financial Services team began construction and organization of mining farms with latest technology computers which enabled mining at great speeds. The main objective of our offering is attracting investments for our company, continuation of Bitcoin mining along with profitable trading and sharing the returns with our investors. Experts of Bfin Financial Services Limited firmly believe in the prospects of Bitcoin, the most traded cryptocurrency by volume. We have put great efforts to provide our clients with a user-friendly profit making investment platform. Also, the developers are real technical mavericks, whose vision to create a unique investment system has become successful. Also, you can be sure of security since we ensure that no one will access your data without consent.
                                    .</p>
                                <p style="margin-bottom:0;">We are fully regulated by the Financial Industry Regulatory Authority (FINRA) and registred with the US Securities and Exchange Commision (SEC. https://brokercheck.finra.org/firm/summary/282643 </p>
                            </div>
                            <div class="columns five omega our-cerificate text-center">
                                <p></p>
                                <a href="https://bfinfinancialservices.com/?a=page&amp;id=about" class="our-certi">
                                    <!-- <img class="img-responsive" :src="$root.basepath + '/img/div_ _div class=" phenix-banner"=""> -->
                                </a>
                            </div><a href="https://bfinfinancialservices.com/?a=page&amp;id=about" class="our-certi">
                                <div class="services">
                                    <ul class="row">
                                        <li class="column one-half text-center">
                                            <div class="inner-s">
                                                <img class="centered-img" :src="$root.basepath + '/img/key-1.png'">
                                                <h4>High growth &amp; substantial returns</h4>
                                                <p>Bfin Financial Services Limited is guided by an excellent team to ensure lofty yields &amp; steady profits in the long run.</p>
                                            </div>
                                        </li>
                                        <li class="column one-half text-center">
                                            <div class="inner-s">
                                                <img class="centered-img" :src="$root.basepath + '/img/key-2.png'">
                                                <h4>Outstanding 14% affiliate commission</h4>
                                                <p>Earn splendid five level affiliate commission by referring others. Make us popular &amp; we will make you rich!</p>
                                            </div>
                                        </li>
                                        <li class="column one-half text-center">
                                            <div class="inner-s">
                                                <img class="centered-img" :src="$root.basepath + '/img/key-3.png'">
                                                <h4>Strong Anti-Ddos protection</h4>
                                                <p>Our company has robust security measures with a tough layer of defense to stop attacks of all types and sizes.</p>
                                            </div>
                                        </li>
                                        <li class="column one-half text-center">
                                            <div class="inner-s">
                                                <img class="centered-img" :src="$root.basepath + '/img/key-4.png'">
                                                <h4>Registered Company</h4>
                                                <p>Bfin Financial Services is fully registered in United States.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="big-video" style="position:relative;">
                                    <img class="img-responsive" style="width:100%;" :src="$root.basepath + '/img/screen-big.png'">
                                    <div class="video-youtube" style="top:40px; left:40px;">
                                        <iframe width="798" height="498" frameborder="0" allowfullscreen=""></iframe>
                                    </div>
                                </div>
                            </a>
                        </div><a href="https://bfinfinancialservices.com/?a=page&amp;id=about" class="our-certi">
                        </a>
                    </div><a href="https://bfinfinancialservices.com/?a=page&amp;id=about" class="our-certi">
                        <!--end wrapper-->
                    </a>
                </div><a href="https://bfinfinancialservices.com/?a=page&amp;id=about" class="our-certi">
                </a>
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
        //
    },
    methods: {
        login() {
            // get the redirect object
            var redirect = this.$auth.redirect()
            var app = this

            this.$auth.login({
                data: {
                    email: app.email,
                    password: app.password
                },
                success: function() {
                    // handle redirection
                    app.success = true
                    const redirectTo = 'dashboard'
                    this.$router.push({ name: redirectTo })
                },
                error: function() {
                    app.has_error = true
                    app.error = res.response.data.error
                },
                rememberMe: true,
                fetchUser: true
            })
        }
    }
}

</script>
