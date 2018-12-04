<template>
    <div class="content">
        <div class="container">
            <div class="card bg-light">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Login</h4>
                    <p class="text-center">Log In to your account</p>
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
                                <strong>Success logining!</strong>
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                </div>
                                <input name="" class="form-control" placeholder="Email address" type="email" v-model="email">
                            </div> <!-- form-group// -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input class="form-control" placeholder="Password" type="password" v-model="password">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <button @click.prevent="formSubmit" type="submit" class="btn btn-primary btn-block"> Log In </button>
                            </div> <!-- form-group// -->
                        </form>
                    <p class="text-center">First time? <router-link to="/">Register</router-link> </p>
                </article>
            </div> <!-- card.// -->
        </div>
        <!--container end.//-->
    </div>
</template>

<script>

    export default {
        data() {
            return {
                email: null,
                password: null,
                error: false,
                success: false,
                msg: null
            };
        },
        methods: {
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
                if(!this.email || !this.password){
                    this.error = true;
                    this.success = false;
                    this.msg = "Empty fields!";
                } else if(!this.validEmail(this.email)){
                    this.error = true;
                    this.success = false;
                    this.msg = "Email not valid!";
                } else if(this.password.length <= 3){
                    this.error = true;
                    this.success = false;
                    this.msg = "Small password!";
                } else {
                    this.error = false;
                    this.success = true;
                    axios.post('/login', {
                        email: this.email,
                        password: this.password
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
                            console.log(response.data);
                            currentObj.$router.push('home');
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            },
            validEmail: function (email) {
                let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
        }
    }

</script>