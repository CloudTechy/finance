<template>
    <div class="" style="">
        <Header class="p-0 m-0"></Header>
        <div style="min-height: 370px;  hidden; position: relative;">
            <router-view></router-view>
        </div>
        <Footer></Footer>
    </div>
</template>
<script>
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
export default {
    data() {
        return {
            //
        }
    },
    components: {
        Header,
        Footer,
    },
    created() {
        
    }

}

</script>
