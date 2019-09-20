<template>
    <div class="" style="min-width: 100vw">
        <Header></Header>
        <router-view style="min-height: 250px; position: relative;"></router-view>
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
    }
}

</script>
