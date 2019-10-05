<template>
    <div aria-expanded="true" id="collapsibleNavbar4" class="columns p-0 mb-4 m-lg-0 mb-2 mt-1 mt-lg-0 col-xl-3 col-lg-3 collapse show nav-container navbar-collapse  alpha">
        <div class="left-menu">
            <h4 data-toggle="collapse" data-target="#collapsibleNavbar3">Overview &amp; Transactions </h4>
            <ul aria-expanded="true" id="collapsibleNavbar3" class="navbar-expand-md collapse p-1 show">
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/user/dashboard"><img :src="$root.basepath + '/img/ac-1.png'">Account</router-link></li>
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/user/dashboard/deposit"><img :src="$root.basepath + '/img/ac-2.png'">Deposit</router-link></li>
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/user/dashboard/withdraw"><img :src="$root.basepath + '/img/ac-3.png'">Withdraw</router-link></li>
            </ul>
            <h4 data-toggle="collapse" data-target="#collapsibleNavbar1">Reports </h4>
            <ul id="collapsibleNavbar1" class="collapse p-1 show">
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/user/dashboard/report/deposit"><img :src="$root.basepath + '/img/ac-4.png'">My Deposits</router-link></li>
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/user/dashboard/report/withdraw"><img :src="$root.basepath + '/img/ac-5.png'">Withdrawal History</router-link></li>
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/user/dashboard/report/transaction"><img :src="$root.basepath + '/img/ac-6.png'">Transactions</router-link></li>
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/user/dashboard/report/referral"><img :src="$root.basepath + '/img/ac-7.png'">Referrals</router-link></li>
            </ul>
            <h4 data-toggle="collapse" class="" data-target="#collapsibleNavbar2">Your Account</h4>
            <ul id="collapsibleNavbar2" class="last p-1 collapse show">
                <!-- <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="https://bfinfinancialservices.com/?a=referallinks"><img :src="$root.basepath + '/img/ac-8.png'">Banners</router-link></li> -->
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/user/dashboard/settings"><img :src="$root.basepath + '/img/ac-9.png'">Settings</router-link></li>
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/user/dashboard/security"><img :src="$root.basepath + '/img/ac-10.png'">Security</router-link></li>
            </ul>
        </div>
    </div>
</template>
