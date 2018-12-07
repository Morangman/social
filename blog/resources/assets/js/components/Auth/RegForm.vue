<style>
    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    .divider-text {
        position: relative;
        text-align: center;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .divider-text span {
        padding: 7px;
        font-size: 12px;
        position: relative;   
        z-index: 2;
    }
    .divider-text:after {
        content: "";
        position: absolute;
        width: 100%;
        border-bottom: 1px solid #ddd;
        top: 55%;
        left: 0;
        z-index: 1;
    }

    .btn-facebook {
        background-color: #405D9D;
        color: #fff;
    }
    .btn-twitter {
        background-color: #42AEEC;
        color: #fff;
    }
</style>
<template>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="container">
            <div class="card bg-light">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Create Account</h4>
                    <p class="text-center">Get started with your free account</p>
                    <p>
                        <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
                    </p>
                    <p class="divider-text">
                        <span class="bg-light">OR</span>
                    </p>
                        <form>
                            <div class="alert alert-danger" v-if="error">
                                <strong>Error!</strong> {{msg}}
                            </div>
                            <div class="alert alert-success" v-if="success">
                                <strong>Success registration!</strong>
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <input name="" class="form-control" placeholder="Full name" type="text" v-model="name" :maxlength="max">
                            </div> <!-- form-group// -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                </div>
                                <input name="" class="form-control" placeholder="Email address" type="email" v-model="email">
                            </div> <!-- form-group// -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                </div>
                                <vue-tel-input v-model="phone"
                                               @onInput="onInput" :preferredCountries="['us', 'gb', 'ua']">
                                </vue-tel-input>
                            </div> <!-- form-group// -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input class="form-control" placeholder="Create password" type="password" v-model="password">
                            </div> <!-- form-group// -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input class="form-control" placeholder="Repeat password" type="password" v-model="password_confirmation">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <button @click.prevent="formSubmit" type="submit" class="btn btn-primary btn-block"> Create Account  </button>
                            </div> <!-- form-group// -->
                        </form>
                    <p class="text-center">Have an account? <router-link to="login">Log In</router-link> </p>
                </article>
                <p><router-link to="home">Server Data</router-link> </p>
            </div> <!-- card.// -->
        </div>
        <!--container end.//-->
    </div>
    </div>
</template>

<script>
    import 'vue-tel-input/dist/vue-tel-input.css';
    import Vue from 'vue'
    import VueTelInput from 'vue-tel-input'

    Vue.use(VueTelInput);

    export default {
        data() {
            return {
                name: null,
                email: null,
                phone: null,
                password: null,
                password_confirmation: null,
                error: false,
                success: false,
                msg: null,
                phone_valid: Boolean,
                max: 25
            };
        },
        methods: {
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
                currentObj.$Progress.start();
                if(!this.name || !this.email || !this.phone || !this.password || !this.password_confirmation){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Empty fields!";
                } else if(!this.validEmail(this.email)){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Email not valid!";
                } else if(!this.validName(this.name)){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Name not correct!";
                } else if(this.password.length <= 3){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Small password!";
                } else if(this.password !== this.password_confirmation){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Confirm password!";
                } else if(!this.phone_valid){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Phone number not valid!";
                } else {
                    axios.post('/register', {
                        name: this.name,
                        email: this.email,
                        phone: this.phone,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    },

                    {
                        headers: {
                            'accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .then(function (response) {
                        if(response){
                            currentObj.error = false;
                            currentObj.success = true;
                            currentObj.$router.push('home');
                            currentObj.$Progress.finish();
                        }
                    })
                    .catch(function (error) {
                        if(error){
                            currentObj.$Progress.fail();
                            console.log(error.response.data.errors);
                            currentObj.error = true;
                            currentObj.success = false;
                            currentObj.msg = error.response.data.errors.email;
                        }

                    });
                }
            },
            validEmail: function (email) {
                let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            validName: function (name) {
                let re = /[a-zA-ZА-яЁё]+/;
                return re.test(name);
            },
            onInput({ isValid}) {
                console.log(isValid);
                this.phone_valid = isValid;
            },
        }
    }

</script>