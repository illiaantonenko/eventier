<template>
    <form method="POST" action="#">

        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

            <div class="col-md-6">
                <input @keyup="clear" v-model="form.email" id="email" type="email" class="form-control" name="email" required autofocus>

                <span v-if="this.errors.email"  class="text-danger">
                    <strong>{{ this.errors.email[0] }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

            <div class="col-md-6">
                <input @keyup="clear" v-model="form.password" id="password" type="password" class="form-control" name="password" required>

                <span v-if="this.errors.password" class="text-danger">
                    <strong>{{ this.errors.password[0] }}</strong>
                </span>
            </div>
        </div>


        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button @click.prevent="login" type="submit" class="btn btn-primary">Login</button>


            </div>
        </div>
    </form>
</template>

<script>
    import axios from 'axios'
    export default {
        data(){
            return{
                form:{
                    'email':null,
                    'password':null
                },
                errors:{}
            }
        },
        methods:{
            login(){
               axios.post('/login',this.form).then((response)=>{
                    if (response.data.id){
                        window.location.href = this.$parent.url
                    }
               }).catch((errors)=>{
                   this.errors = errors.response.data.errors
               })
            },
            clear(event){
                this.errors[event.target.name] = {}
            }
        }
    }
</script>

<style scoped>
    form{
        margin: 30px 0px;
    }
</style>
