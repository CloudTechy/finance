<template>
    <div>
        <div class="row page-title m-3 p-2">
            <div class="col-12 col-lg-8 container">
                <h1>Investment Solutions</h1>
                <p>Bfin Financial Services Limited offers two attractive and profitable investment plans for our valuable investors. Our dedicated team has put in a lot of time &amp; effort to present the best possible investment plans for you.</p>
            </div>
        </div>
        <!--start main container-->
        <section class="main-container" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
            <div class="main">
                <div class="container">
                    <div class="wrapper">
                        <div class="page-heading text-center">
                            <h2>Our Investment Plans</h2>
                        </div>
                        <p class="col mb-2 inv-intro text-center">Bfin Financial Services offers daily, weekly and monthly varieties of profit plans for our valuable investors. The investment plans have been prepared with great care and structured into amazing portfolios. </p><br>
                        <div class="row p-2">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <p class="inv-intro text-left  col">
                                    <span class="font-weight-bold">Bronze account features:</span><br>
                                    Deposit: $20 - $150
                                    Up to 5% R.O.I in 72 Hours minimum
                                    Eligibility: A New User Can Only Use This Plan Twice
                                    No Referral Commission
                                    <br><br>
                                </p>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <p class="inv-intro text-left  col">
                                    <span class="font-weight-bold">Silver account features:</span><br>
                                    Deposit: $200 - $2,000
                                    Up to 20%
                                    30 Days minimum turnover
                                    5% One time Referral Commission
                                    <br><br>
                                </p>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <p class="inv-intro text-left  col">
                                    <span class="font-weight-bold">Gold account features:</span><br>
                                    Deposit: $5,000 - $30,000
                                    Up to 40%
                                    30 Days turnover
                                    10% Referral Commission to the 5th chain
                                    <br><br>
                                </p>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <p class="inv-intro text-left  col">
                                    <span class="font-weight-bold">Platinum account features:</span><br>
                                    Deposit: $60,000 - $200,000
                                    Upto 60%
                                    14 days turnover
                                    10% Referral Commission to the 10th chain.
                                </p>
                            </div>
                        </div>
                        <div class="row inv-plans">
                            <div class=" col alpha omega">
                                <div class="col plan-wrap first">
                                    <div class="plan-sticker">
                                        <div class="plan-inner">
                                            <div class="plan-in">
                                                <h3>5%</h3>
                                                <p>72<span> hours turnover</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="plan-det">
                                        <li><i aria-hidden="true" class="fa fa-check"></i> 5% 72 hours turnover</li>
                                        <li><i aria-hidden="true" class="fa fa-check"></i> Min: 20 USD - Max: 150 USD</li>
                                        <li><i aria-hidden="true" class="fa fa-check"></i> instant withdraw</li>
                                    </ul>
                                    <div class="inv-button">
                                        <router-link to="/user/dashboard/deposit" class="btn btn-inverse">Make Investment</router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="col alpha omega">
                                <div class="col plan-wrap first">
                                    <div class="plan-sticker">
                                        <div class="plan-inner">
                                            <div class="plan-in">
                                                <h3>60%</h3>
                                                <p>30<span> days turnover</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="plan-det">
                                        <li><i aria-hidden="true" class="fa fa-check"></i> 60% 14 days turnover</li>
                                        <li><i aria-hidden="true" class="fa fa-check"></i> Min: 60,000 USD - Max: 200,000</li>
                                        <li><i aria-hidden="true" class="fa fa-check"></i> instant withdraw</li>
                                    </ul>
                                    <div class="inv-button mt-5 p-0 pt-5">
                                        <router-link to="/user/dashboard/deposit" class="btn btn-inverse">Make Investment</router-link>
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
