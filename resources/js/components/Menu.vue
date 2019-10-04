<template>
    <nav class="nav navbar navbar-expand-md bg-dark navbar-dark" :style="'background:url('+ $root.basepath +'/img/flower.jpg) no-repeat 0 0;'">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div ref="" class="justify-content-center p-0 collapse nav-container navbar-collapse" id="collapsibleNavbar">
            <ul class="menu clearfix navbar-nav ">
                <li class="m-0  m-lg-2 p-lg-2  m-md-1 p-md-0">
                    <router-link to="/">Home</router-link>
                </li>
                <li class="m-0  m-lg-2 p-lg-2  m-md-1 p-md-0">
                    <router-link to="/about">About</router-link>
                </li>
                <li class="m-0  m-lg-2 p-lg-2  m-md-1 p-md-0">
                    <router-link to="/getstarted">getstarted</router-link>
                </li>
                <li class="m-0  m-lg-2 p-lg-2  m-md-1 p-md-0">
                    <a href="https://t.me/bfinofficial">Channel link</a>
                </li>
                <li class="m-0  m-lg-2 p-lg-2  m-md-1 p-md-0">
                    <router-link to="/investmentPlans">Investment plans</router-link>
                </li>
                <li class="m-0  m-lg-2 p-lg-2  m-md-1 p-md-0">
                    <router-link to="/partners">Partners</router-link>
                </li>
                <li class="m-0  m-lg-2 p-lg-2  m-md-1 p-md-0">
                    <router-link to="/faq">Faq</router-link>
                </li>
                <li class="m-0  m-lg-2 p-lg-2  m-md-1 p-md-0">
                    <a href="https://tawk.link/5be61a8a70ff5a5a3a717ba7/vc/5c0a5e54af5de8c7a62ef1f4/v/f6499c5fa1bda2dc59c0aaf0ca87fa79564509c1/BFIN_FINANCIAL_SERVICES">Company Certificate</a>
                </li>
                <li class="m-0  m-lg-2 p-lg-2  m-md-1 p-md-0">
                    <router-link to="/news">News</router-link>
                </li>
                <li class="m-0  m-lg-2 p-lg-2  m-md-1 p-md-0">
                    <router-link to="/support">Support</router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
    export default {
    data() {
        return {

        }
    },
    mounted() {
        //
    }
}

</script>
<style type="text/css">
.router-link-exact-active  {
    background: linear-gradient(to right, #e25e5a 0%, #e25e5a 0%, #f8b982 100%, #f8b982 100%, #f8b982 100%) !important;
    color: #1a1a1a !important;
}

</style>
