<template>
    <div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-login-tab" data-toggle="pill" href="#login" role="tab" aria-controls="pills-home" aria-selected="true">Log In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-register-tab" data-toggle="pill" href="#register" role="tab" aria-controls="pills-profile" aria-selected="false">Register</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="pills-home-tab">
                <login></login>
            </div>
            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="pills-profile-tab">
                <register></register>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props:['url']
    }
</script>

<style scoped>

</style>
