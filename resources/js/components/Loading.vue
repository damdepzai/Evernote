<template>
    <div v-if="show_loading" class="modal wrap_loading">
        <div class="loader"></div>
    </div>
</template>

<script>
    export default {
        name: "Loading",
        data(){
            return {
                show_loading: false,
            }
        },

        mounted() {
            Event.listen('loadingSubmit', data => {
                this.show_loading = data.type;
            });
        }
    }
</script>

<style scoped>
    .wrap_loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        max-width: unset;
        max-height: unset;
        z-index: 10000;
        background: rgba(0,0,0,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .loader {
        border: 4px solid #f3f3f3; /* Light grey */
        border-top: 4px solid #3498db; /* Blue */
        border-bottom: 4px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
        -webkit-animation: spin 2s linear infinite;
        -moz-animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }
</style>
