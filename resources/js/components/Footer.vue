<template>
    <footer>
        <div class="footer-top">
            <div class="container row"><a href="#" class="our-certi">
                    <span class="bitcoin-logo"><img :src="$root.basepath + '/img/bitcoin.png'"></span>
                </a>
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
