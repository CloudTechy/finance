<template>
    <header>
        <div class="header-container p-2 m-0">
            <div class="container">
                <div class="row">
                    <div class="logo p-2 p-lg-1 mb-lg-0 mb-2">
                        <a href="https://bfinfinancialservices.com/?a=home"><img class="main-logo" :src="$root.basepath + '/img/logo.png'"><img class="hover-logo" :src="$root.basepath + '/img/logo-hover.png'"></a>
                    </div>
                    <div class="   m-auto ">
                    	<div class="btc-price">
                        <div class="price ">
                            <span class="btc-spin"><img :src="$root.basepath + '/img/btc-small.png'"></span>
                            <span class="label" style="color: #fff;">BTC Price</span>
                            <span class="figure">$<span class="btc-usd"><span class="price" style="margin-top: -21px;margin-left: -39px;">{{$root.numeral($root.rate)}}</span></span></span>
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
                                    <router-link :to="{ name : route.path }" :key="key"class="btn btn-default">{{route.name}}</router-link>
                                </li>
                            </ul>
                            <ul class="user-menu p-0  pt-lg-0 pt-3 pl-lg-2  m-auto clearfix" v-if="$auth.check(2)">
                                <li class="nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
                                    <router-link :to="{ name : route.path }" :key="key"class="btn btn-default">{{route.name}}</router-link>
                                </li>
                            </ul>
                            <ul class="user-menu p-0  pt-lg-0 pt-3 pl-lg-2  m-auto clearfix" v-if="!$auth.check()">
                                <li class="nav-item" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                                    <router-link :to="{ name : route.path }" :key="key"class="btn btn-default">{{route.name}}</router-link>
                                </li>
                            </ul>
                            <ul class="user-menu p-0  pt-lg-0 pt-3 pl-lg-2  m-auto clearfix" v-if="$auth.check()">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
                                </li>
                                <li class="nav-item" >
                                    <router-link :to="{ name : 'admin.dashboard' }" class="btn btn-default">{{route.name}}</router-link>
                                </li>

                            </ul>

                     <!--    <li><a href="https://bfinfinancialservices.com/?a=account" class="btn btn-default">Account</a></li>
                        <li><a href="https://bfinfinancialservices.com/?a=logout" class="btn btn-inverse">Sign Out</a></li> -->
                    
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
            }
        }
    },
    // components: { Menu },
    methods: {
        collapse() {
            // this.$refs.collapsibleNavbar.classList.add('in')
        }
    }
}

</script>
<style>
</style>
