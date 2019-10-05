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
                                <div class="acc-body m-0 p-0 security">
                                    <div class="setting-block">
                                        <h3>Detect IP Address Change Sensitivity</h3>
                                        <ul class="form-list">
                                            <li>
                                                <input type="radio" name="ip" value="disabled" checked="" style="cursor: pointer;">
                                                <span class="radio-icon"><span></span></span>
                                                <label for="bitcoin">Disabled</label>
                                                <input type="radio" name="ip" value="medium" style="cursor: pointer;">
                                                <span class="radio-icon"><span></span></span>
                                                <label for="bitcoin">Medium</label>
                                                <input type="radio" name="ip" value="high" style="cursor: pointer;">
                                                <span class="radio-icon"><span></span></span>
                                                <label for="bitcoin">High</label>
                                                <input type="radio" name="ip" value="always" style="cursor: pointer;">
                                                <span class="radio-icon"><span></span></span>
                                                <label for="bitcoin">Paranoic</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="setting-block">
                                        <h3>Detect Browser Change</h3>
                                        <ul class="form-list ss">
                                            <li class="radio">
                                                <input type="radio" name="browser" value="disabled" checked="" style="cursor: pointer;">
                                                <span class="radio-icon"><span></span></span>
                                                <label for="bitcoin">Disabled</label>
                                                <input type="radio" name="browser" value="enabled" style="cursor: pointer;">
                                                <span class="radio-icon"><span></span></span>
                                                <label for="bitcoin">Enabled</label>
                                            </li>
                                        </ul>
                                    </div>
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

    },
    computed: {
        user() {
            return this.$auth.user()
        },
        Referral_link() {
            return this.$root.basepath + '/register?ref=' + this.user.username
        }
    },
    methods: {}
}

</script>
