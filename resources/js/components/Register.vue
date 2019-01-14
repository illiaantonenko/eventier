<template>
    <form method="POST" action="#">
        <div class="alert alert-danger" v-if="this.errors && this.errors.general"></div>
        <div class="form-group row">
            <label for="firstname" class="col-md-4 col-form-label text-md-right">First name</label>

            <div class="col-md-6">
                <input v-model="form.firstname" id="firstname" type="text" class="form-control" name="firstname" required autofocus>

                <span v-if="this.errors.firstname" class="text-danger">
                    <strong>{{ this.errors.firstname[0] }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="lastname" class="col-md-4 col-form-label text-md-right">Last name</label>

            <div class="col-md-6">
                <input v-model="form.lastname" id="lastname" type="text" class="form-control" name="lastname" required autofocus>

                <span v-if="this.errors.lastname" class="text-danger">
                    <strong>{{ this.errors.lastname[0] }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="middlename" class="col-md-4 col-form-label text-md-right">Middle name</label>

            <div class="col-md-6">
                <input v-model="form.middlename" id="middlename" type="text" class="form-control" name="middlename" required autofocus>

                <span v-if="this.errors.middlename" class="text-danger">
                    <strong>{{ this.errors.middlename[0] }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="nickname" class="col-md-4 col-form-label text-md-right">Nickname</label>

            <div class="col-md-6">
                <input v-model="form.nickname" id="nickname" type="text" class="form-control" name="nickname" autofocus>

                <span v-if="this.errors.nickname" class="text-danger">
                    <strong>{{ this.errors.nickname[0] }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="birthdate" class="col-md-4 col-form-label text-md-right">Birth date</label>

            <div class="col-md-6">
                <input v-model="form.birthdate" id="birthdate" type="text" class="form-control" name="birthdate" placeholder="dd-mm-yyyy" required autofocus>

                <span v-if="this.errors.birthdate" class="text-danger">
                    <strong>{{ this.errors.birthdate[0] }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

            <div class="col-md-6">
                <input v-model="form.email" id="email" type="email" class="form-control" name="email" required>

                <span v-if="this.errors.email" class="text-danger">
                    <strong>{{ this.errors.email[0] }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

            <div class="col-md-6">
                <input v-model="form.password" id="password" type="password" class="form-control" name="password" required>

                <span v-if="this.errors.password" class="text-danger">
                    <strong>{{ this.errors.password[0] }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

            <div class="col-md-6">
                <input v-model="form.password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button @click.prevent="register" type="submit" class="btn btn-primary">Register</button>
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
                    firstname:null,
                    lastname:null,
                    middlename:null,
                    nickname:null,
                    birthdate:null,
                    email:null,
                    password:null,
                    password_confirmation:null
                },
                errors:{}
            }
        },
        methods:{
            register(){
                axios.post('/register',this.form).then((response)=>{
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
