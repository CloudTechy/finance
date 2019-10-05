<template>
    <div class="m-0 p-0">
        <DashboardHeader></DashboardHeader>
        <section class="main-container m-lg-3 m-0 acc">
            <div class="main">
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
                                <!-- content goes here -->
                                <component @success = 'success' :success = "message" :plan = "selectedPlan" @changeComponent = "changeComponent" :user="user" class = "m-0 p-0" :is="componentName"></component>
                                <!--  content ends here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data() {
        return {
            componentName : 'DepositPlan',
            selectedPlan : '',
            message : ''
        }
    },
    mounted() {
        window.scrollTo(0,200)

    },
    watch : {
        message(){
            setTimeout(() => {this.message = ''}, 3000);
        },
    },
    computed: {
        user() {
            return this.$auth.user()
        }
    },
    methods: {
        changeComponent(component,plan='') {
            this.componentName = component
            this.selectedPlan = plan
        },
        success(msg) {
            this.message = msg
            this.componentName = 'DepositPlan'
        }
    }
}

</script>
<style>
    table.stat tbody td {
    font-size: 15px;
    line-height: 24px;
    padding: 12px 8px;
    /* border-top: 1px solid rgba(255,255,255,0.10); */
}
</style>
