<template>
    <div>
        <div class="row page-title m-3 p-2">
            <div class="col-12 col-lg-8 container">
                <h1>Get Started</h1>
                <p>To start your investment journey in Bfin Financial Services Limited you need to follow few simple steps. Starting from account registration to profit withdrawal, every step is comprehensible in our user friendly investment portal.</p>
            </div>
        </div>
        <!--start main container-->
        <section class="main-container" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
            <div class="main">
                <div class="container">
                    <div class="wrapper" >
                        <div class="p-1 get-started">
                            <ul>
                                <li>
                                    <h3><span>Step 1: </span>Account Registration</h3>
                                    <p>Start by filling in required fields of the application form on the<router-link to="/register" class="btn btn-link" style="display: inline; color: rgb(183, 183, 183); font-family: Montserrat; ">Register</router-link>page. Submit your registration. After that you will be able to log into your account and make your first investment. </p>
                                </li>
                                <li>
                                    <h3><span>Step 2: </span>Creating Deposit</h3>
                                    <p>In order to make a deposit you need to use Bitcoin, the most popular digital currency. You can use bitcoin to make a deposit from any of your bitcoin wallet. After logging in to your account in Bfin Financial Services Limited just click on ‘Make a deposit‘ link. </p>
                                </li>
                                <li>
                                    <h3><span>Step 3: </span>Wait for the deposit transfer</h3>
                                    <p>Normally Bitcoin deposit is active after 3 confirmations. 3 confirmations from the Bitcoin network take approximately 30 minutes - 1 hour or maybe it can long which depends on bitcoin network. Once the Bitcoin deposit is confirmed it will show in your active deposit according to your subscription plan.</p>
                                </li>
                                <li>
                                    <h3><span>Step 4: </span>Follow Accruals</h3>
                                    <p>You can choose any of the 16 investment plans carefully grouped into 4 portfolios of Bfin Financial Services Limited to make your investment. The gold plan is 2% daily for life time. The platinum plan is 5% daily for life time. </p>
                                </li>
                                <li>
                                    <h3><span>Step 5: </span>Profit Withdrawal</h3>
                                    <p>All the investment plans in Bfin Financial Services Limited comes with bit by bit accruals each day your account reads. Once profit is deposited in your account wallet, you may be able to withdraw it. The minimum withdrawal amount is 1 USD. Feel free at any time to withdraw &amp; enjoy your ROI! </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
