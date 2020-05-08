<template>
    <div class="container">
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="/home">
                    <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
                </a>
            </div>

            <div id="" class="navbar-menu ">
                <div class="navbar-start is-pulled-right">
                    <router-link :to="{name:'home'}" class="navbar-item" >Trang chủ</router-link>

                    <a class="navbar-item">
                        Trang cá nhân
                    </a>

                </div>


                <div class="navbar-end">
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            <span >{{user.name}}</span>
                        </a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item">
                               Đổi mật khẩu
                            </a>
                            <hr class="navbar-divider">
                            <a @click="logOut" class="navbar-item">
                                Đăng xuất
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "navbar",
        data(){
            return{
                user:{}

            }
        },
        methods:{
            logOut(){
                axios.get('http://127.0.0.1:8000/api/logout')
                .then( res =>{
                    location.reload();
                })
                .catch(err =>{
                    console.log(err)
                })
            },
            getInformation(){
                axios.get('http://127.0.0.1:8000/api/me')
                    .then( res =>{
                        this.user=res.data.data;
                        console.log(res.data.data);
                    })
                    .catch(err =>{
                        console.log(err)
                    })
            }
        },
        created() {
            this.getInformation();
        }
    }
</script>

<style scoped>

</style>
