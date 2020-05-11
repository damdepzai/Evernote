<template>
    <div class="container">
        <navbar></navbar>
       <router-view></router-view>
    </div>
</template>

<script>

  import navbar from "./components/navbar";
    export default {
        name: "App",
        components: {navbar},
        data(){
            return{

            }
        },
        mounted() {
        }
    }
</script>

<style scoped>

</style>
