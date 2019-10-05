<template>
    <div class="m-0 p-0">
        <DashboardHeader></DashboardHeader>
        <section class="main-container m-lg-3 m-0 acc">
            <div class="main">
                <!--start wrapper-->
                <div class="container">
                    <div class="wrapper" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;min-height:400px;'">
                        <div class="account-wrapper m-xl-2 row m-0 ">
                            <nav class="nav  navbar-dark ml-4 ml-lg-0 mb-3 mb-lg-b p-0 mt-3 navbar navbar-expand-lg ">
                                <button @click="" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar4">
                                    <span class="navbar-toggler-icon "></span>
                                </button>
                            </nav>
                            <DashboardSidebar></DashboardSidebar>
                            <div class="columns col-xl-9 p-0 pl-lg-2 col-lg-9 col-12 main-acc">
                                <div class="acc-block m-0 p-0">
                                    <div class="acc-heading clearfix">
                                        <h2>Referrals</h2>
                                        <ul class="breadcrumbs">
                                            <li>Main</li>
                                            <li><img :src="$root.basepath + '/img/right-b.png'"></li>
                                            <li class="active">Referrals</li>
                                        </ul>
                                    </div>
                                    <div class="acc-body m-0 p-0 referrals">
                                        <!--stats-->
                                        <div class="stat-box row p-0 m-0 clearfix">
                                            <div class="s-box col m-0 p-2">
                                                <img :src="$root.basepath + '/img/box-4.png'">
                                                <h4>Total Referrals</h4>
                                                <span>{{user.referrals}}</span>
                                            </div>
                                            <div class="s-box col m-0 p-2">
                                                <img :src="$root.basepath + '/img/box-5.png'">
                                                <h4>Active referrals</h4>
                                                <span>{{user.activeReferrals}}</span>
                                            </div>
                                            <div class="s-box col m-0 p-2">
                                                <img :src="$root.basepath + '/img/box-6.png'">
                                                <h4>Total commissions</h4>
                                                <span>{{$root.numeral(user.totalCommission)}}</span>
                                            </div>
                                        </div>
                                        <!--end stats-->
                                        <div class="acc-block affiliate-link">
                                            <div class="acc-heading clearfix">
                                                <h2>Affiliate Link</h2>
                                            </div>
                                            <div class="acc-body p-0 m-1 clearfix">
                                                <div class="aff-link-1 clearfix">
                                                    <a class="aff-link p-0" id="foo" :href="Referral_link">{{Referral_link}}</a>
                                                    <button v-clipboard="Referral_link" class="btn btn-default small" style="float:right;" data-clipboard-target="#foo">Copy</button>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="form-list clearfix">
                                        </ul>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <!--end account wrapper-->
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data() {
        return {}
    },
    mounted() {
        window.scrollTo(200, 200);
    },
    computed: {
        user() {
            return this.$auth.user()
        },
        Referral_link() {
            return this.$root.basepath + '/register?ref=' + this.user.username
        }
    },
    methods: {
        refCommision(ref, activeRef) {
            var total = 0
            for (var i = 0; i <= ref - 1; i++) {
                total += 3
            }
            for (var i = 0; i <= activeRef - 1; i++) {
                total += 5
            }
            //this.updateUserRefCommission(total)
            return this.$root.numeral(total)

        },
    //     updateUserRefCommission(total){
    //         this.form.referral_commission = total
    //         this.form.patch("/auth/users/" + this.user.id)
    //             .then(response => {
                   
    //             })
    //             .catch(error => {
    //             })
    //     }
    }
}

</script>
