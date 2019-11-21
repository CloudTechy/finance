<template>
    <header >
        <div class="header-container p-2 m-0" >
            <div class="container">
                <div class="row">
                    <div class="logo p-2 p-lg-1 mb-lg-0 mb-2">
                        <router-link style="background: none !important" to="/home"><img class="main-logo" :src="$root.basepath + '/img/logo.png'"><img class="hover-logo" :src="$root.basepath + '/img/logo-hover.png'"></router-link>
                    </div>
                    <div class=" p-2 pb-0 pt-0 pt-lg-0 m-auto ">
                        <div class="btc-price">
                            <div class="price ">
                                <span class="btc-spin"><img :src="$root.basepath + '/img/btc-small.png'"></span>
                                <span class="label" style="color: #fff;">BTC Price</span>
                                <span class="figure">$<span class="btc-usd"><span class="price" style="margin-top: -21px;margin-left: -39px;">{{$root.normalNumeral($root.rate)}}</span></span></span>
                            </div>
                        </div>
                        <div class="server-time">
                            <div class="time pl-lg-3 pl-0">
                                <span class="label" style="color: #fff;">Server Time</span>
                                <span class="figure"><span id="clock">{{$root.time}}</span></span>
                            </div>
                        </div>
                    </div>
                    <ul class="user-menu p-0  pt-lg-0 pt-3 pl-lg-2  m-auto clearfix" v-if="$auth.check(1)">
                        <li class="nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
                            <router-link :to="{ name : route.path }" :key="key" class="btn btn-default">{{route.name}}</router-link>
                        </li>
                    </ul>
                    <ul class="user-menu p-0  pt-lg-0 pt-3 pl-lg-2  m-auto clearfix" v-if="$auth.check(2)">
                        <li class="nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
                            <router-link :to="{ name : route.path }" :key="key" class="btn btn-default">{{route.name}}</router-link>
                        </li>
                    </ul>
                    <ul class="user-menu p-0  pt-lg-0 pt-3 pl-lg-2  m-auto clearfix" v-if="!$auth.check()">
                        <li class="nav-item" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                            <router-link :to="{ name : route.path }" :key="key" class="btn btn-default">{{route.name}}</router-link>
                        </li>
                    </ul>
                    <ul class="user-menu p-0  pt-lg-0 pt-3 pl-md-3  m-auto clearfix" v-if="$auth.check()">
                        <li class="nav-item">
                            <a class="btn btn-default" href="#" @click.prevent="$auth.logout()">Logout</a>
                        </li>
                        <li v-if="$auth.user().isAdmin" class="nav-item">
                            <router-link v-if="$route.path != '/admin/dashboard'  && $auth.user().isEmailVerified" to="/admin/dashboard" class="btn btn-default">Account</router-link>
                        </li>
                        <li v-else class="nav-item">
                            <router-link v-if="$route.path != '/user/dashboard'  && $auth.user().isEmailVerified" to="/user/dashboard" class="btn btn-default">Account</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <Menu></Menu>
    </header>
</template>
<script>
export default {
    data() {
        return {
            routes: {
                // UNLOGGED
                unlogged: [
                    { name: 'Register', path: 'register' },
                    { name: 'Login', path: 'login' }
                ],
                // LOGGED USER
                user: [
                    { name: 'Dashboard', path: 'dashboard' }
                ],
                // LOGGED ADMIN
                admin: [
                    { name: 'Dashboard', path: 'admin.dashboard' }
                ]
            },
            rate : ''
        }
    },
    computed: {},
    // components: { Menu },
    methods: {
       
        
    }
}

</script>
<style>
</style>
