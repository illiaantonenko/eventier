<template>
    <div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a v-bind:class="{active:login}" class="nav-link" id="pills-login-tab" data-toggle="pill" href="#login" role="tab" aria-controls="pills-home">Log In</a>
            </li>
            <li class="nav-item">
                <a v-bind:class="{active:register}" class="nav-link" id="pills-register-tab" data-toggle="pill" href="#register" role="tab" aria-controls="pills-profile">Register</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div v-bind:class="{show:login,active:login}" class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="pills-home-tab">
                <login></login>
            </div>
            <div v-bind:class="{show:register,active:register}" class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="pills-profile-tab">
                <register></register>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                currentRoute: window.location.pathname,
                login: false,
                register: false
            }
        },
        mounted(){
            if (this.currentRoute.includes('login')){
                this.login = true;
            }else if(this.currentRoute.includes('register')){
                this.register = true;
            }
        }
    }
</script>

<style scoped>

</style>
