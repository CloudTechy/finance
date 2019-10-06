<template>
    <footer class="" style="width: inherit; overflow: hidden; box-sizing: border-box; ">
        <div style="position: relative" class="footer-top">
            <div style="max-width: 100%; position: fixed; bottom : 2px; left:2px;right:2px; " class="alert m-auto alert-primary alert-dismissible fade show" role="alert">
                    <p class="_text_1nv7e_24 text-center">
                        We use cookies to provide our services and for analytics and marketing, 
                        By continuing to browse our website, you agree to our use of&nbsp;cookies.
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">OK</span>
                    </button>
                </div>
            <div class="text-center justify-content-center container m-auto p-sm-4 p-3 row">

                <span class="bitcoin-logo"><img :src="$root.basepath + '/img/bitcoin.png'"></span>
                <ul class="footer-menu">
                    <li>
                        <router-link to="/">Home</router-link>
                    </li>
                    <li>
                        <router-link to="/about">About Us</router-link>
                    </li>
                    <li>
                        <router-link to="/dataCenter">Data Center</router-link>
                    </li>
                    <li>
                        <router-link to="/faq">Faq</router-link>
                    </li>
                    <li>
                        <a href="https://t.me/bfinofficial">Channel link</a>
                    </li>
                    <li>
                        <router-link to="/News">News</router-link>
                    </li>
                    <!-- <li><a href="https://bfinfinancialservices.com/?a=rules">Terms</a></li>
 -->
                    <li>
                        <router-link to="/Support">Support</router-link>
                    </li>
                </ul>
                <span class="footer-logo"><img :src="$root.basepath + '/img/footer-logo.png'"></span>
            </div>
        </div>
        <div class="copyrights text-center">
            <p style="text-transform: uppercase;">© {{fullYear}} Bfin Financial Services Limited. All Rights Reserved.</p>
        </div>
    </footer>
</template>
<script>
import moment from 'moment'
export default {
    data() {
        return {

        }
    },
    computed: {
        fullYear() {
            return moment().get('year')
        }
    },
    methods: {
        collapse() {
            // this.$refs.collapsibleNavbar.classList.add('in')
        }
    }
}

</script>
<style scoped="">
._text_1nv7e_24 {
    font-family: Sailec-Regular, system-ui, -apple-system, Segoe UI, Roboto, Helvetica Neue, Helvetica, Arial, sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.6;
    margin: 0
}

</style>
