<template>
    <div>
        <div class="row page-title m-3 p-2">
            <div class="col-12 col-lg-8 container">
                <h1>Investment Solutions</h1>
                <p>Bfin Financial Services Limited offers two attractive and profitable investment plans for our valuable investors. Our dedicated team has put in a lot of time &amp; effort to present the best possible investment plans for you.</p>
            </div>
        </div>
        <!--start main container-->
        <section class="main-container">
            <div class="main">
                <div class="container">
                    <div class="wrapper" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
                        <div class="page-heading text-center">
                            <h2>Our Investment Plans</h2>
                        </div>
                        <p class="inv-intro text-left">Bfin Financial Services offers daily, weekly and monthly varieties of profit plans for our valuable investors. The investment plans have been prepared with great care and structured into amazing portfolios.<br> 
                            Bronze account features:
                            Deposit: $20 - $150
                            Up to 5% R.O.I in 72 Hours minimum
                            Eligibility: A New User Can Only Use This Plan Twice
                            No Referral Commission
                            <br> Silver account features:
                            Deposit: $200 - $2,000
                            Up to 20%
                            30 Days minimum turnover
                            5% One time Referral Commission
                            <br> Gold account features:
                            Deposit: $5,000 - $30,000
                            Up to 40%
                            30 Days turnover
                            10% Referral Commission to the 5th chain
                            <br> Platinum account features:
                            Deposit: $60,000 - $200,000
                            Upto 60%
                            14 days turnover
                            10% Referral Commission to the 10th chain.</p>
                        <!--inv plans-->
                        <div class="row inv-plans">
                            <div class="column col alpha omega">
                                <div class="plan-wrap first">
                                    <div class="plan-sticker">
                                        <div class="plan-inner">
                                            <div class="plan-in">
                                                <h3>5%</h3>
                                                <p>72<span> hours turnover</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="plan-det">
                                        <li><i class="fa fa-check" aria-hidden="true"></i> 5% 72 hours turnover</li>
                                        <li><i class="fa fa-check" aria-hidden="true"></i> Min: 20 USD - Max: 150 USD</li>
                                        <li><i class="fa fa-check" aria-hidden="true"></i> instant withdraw</li>
                                    </ul>
                                    <div class="inv-button">
                                        <router-link  class="btn btn-inverse" to="/user/dashboard/deposit">Make Investment</router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="column col alpha omega">
                                <div class="plan-wrap first">
                                    <div class="plan-sticker">
                                        <div class="plan-inner">
                                            <div class="plan-in">
                                                <h3>60%</h3>
                                                <p>30<span> days turnover</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="plan-det">
                                        <li><i class="fa fa-check" aria-hidden="true"></i> 60% 14 days turnover</li>
                                        <li><i class="fa fa-check" aria-hidden="true"></i> Min: 60,000 USD - Max: 200,000</li>
                                        <li><i class="fa fa-check" aria-hidden="true"></i> instant withdraw</li>
                                    </ul>
                                    <div class="inv-button">
                                        <router-link  class="btn btn-inverse" to="/user/dashboard/deposit">Make Investment</router-link>
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
