<template>
    <div aria-expanded="true" id="collapsibleNavbar4" class="columns p-0 mb-4 m-lg-0 mb-2 mt-1 mt-lg-0 col-xl-3 col-lg-3 collapse show nav-container navbar-collapse  alpha">
        <div class="left-menu">
            <h4 data-toggle="collapse" data-target="#collapsibleNavbar3">Dashboard </h4>
            <ul aria-expanded="true" id="collapsibleNavbar3" class="navbar-expand-md collapse p-1 show">
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/admin/dashboard"><img :src="$root.basepath + '/img/ac-1.png'">Account</router-link></li>
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/admin/dashboard/users"><img :src="$root.basepath + '/img/ac-2.png'">Users</router-link></li>
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/admin/dashboard/subscriptions"><img :src="$root.basepath + '/img/ac-2.png'">Subscriptions</router-link></li>
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/admin/dashboard/deposits"><img :src="$root.basepath + '/img/ac-3.png'">Deposits</router-link></li>
                <li class="p-0 mt-1 mb-1"><router-link class = "mb-2 mt-2" to="/admin/dashboard/withdrawals"><img :src="$root.basepath + '/img/ac-3.png'">Withdrawals</router-link></li>
            </ul>
        </div>
    </div>
</template>
