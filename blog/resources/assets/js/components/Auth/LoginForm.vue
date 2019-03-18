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
                    <h4 class="card-title mt-3 text-center">Авторизация</h4>
                    <p class="text-center">Ввойдите в Ваш аккаунт</p>
                    <p>
                        <a href='/redirect' type="submit" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Вход через facebook</a>
                    </p>
                    <p class="divider-text">
                        <span class="bg-light">или</span>
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
                                <input name="" class="form-control" placeholder="Ваш почтовый адресс" type="email" v-model="email"></input>
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input class="form-control" placeholder="Пароль" type="password" v-model="password"></input>
                            </div> 
                            <div class="form-group">
                                <button @click.prevent="formSubmit" type="submit" class="btn btn-primary btn-block"> Войти </button>
                            </div> 
                        </form>
                    <p class="text-center">Впервые сдесь? <router-link to="/">Регистрация</router-link> </p>
                </article>
            </div>
        </div>
    </div>
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

        mounted() {
            if (localStorage.getItem('reloaded')) {
                localStorage.removeItem('reloaded');
            } else {
              localStorage.setItem('reloaded', 'OK');
               window.location.replace("/login");
            }
            //localStorage.removeItem('token');
            //localStorage.removeItem('expiration');
           // window.location.replace("/login");
        },
        methods: {
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
                currentObj.$Progress.start();
                if(!this.email || !this.password){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Empty fields!";
                } else if(!this.validEmail(this.email)){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Email not valid!";
                } else if(this.password.length <= 3){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Small password!";
                } else {
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
                            currentObj.error = false;
                            currentObj.success = true;
                            currentObj.$router.push('home');
                            currentObj.$Progress.finish();
                        }
                    })
                    .catch(function (error) {
                        if(error){
                            currentObj.$Progress.fail();
                            console.log(error.response.data);
                            currentObj.error = true;
                            currentObj.success = false;
                            currentObj.msg = error.response.data.message;
                        }
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