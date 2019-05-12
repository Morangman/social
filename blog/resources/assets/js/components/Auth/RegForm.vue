<template>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="container">
            <div class="card bg-light">
                <article class="card-body mx-auto" style="max-width: 340px;">
                    <h4 class="card-title mt-3 text-center">Создание аккаунта</h4>
                    <p class="text-center">Начните общение со своим бесплатным аккаунтом</p>
                    <p>
                        <a  href='/redirect' type="submit" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Регистрация через facebook</a>
                    </p>
                    <p class="divider-text">
                        <span class="bg-light">или</span>
                    </p>
                        <form>
                            <div class="alert alert-danger" v-if="error">
                                <strong>Ошибка!</strong> {{msg}}
                            </div>
                            <div class="alert alert-success" v-if="success">
                                <strong>Успех!</strong>
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <input name="" class="form-control" placeholder="Ник" type="text" v-model="nick" :maxlength="max">
                            </div> <!-- form-group// -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <input name="" class="form-control" placeholder="ФИО" type="text" v-model="name" :maxlength="max">
                            </div> <!-- form-group// -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                </div>
                                <input name="" class="form-control" placeholder="E-mail адресс" type="email" v-model="email">
                            </div> <!-- form-group// -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                </div>
                                <vue-tel-input v-model="phone" placeholder="Ваш номер телефона" 
                                               @onInput="onInput" :preferredCountries="['ua', 'us', 'gb']">
                                </vue-tel-input>
                            </div> <!-- form-group// -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input class="form-control" placeholder="Придумайте пароль" type="password" v-model="password">
                            </div> <!-- form-group// -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input class="form-control" placeholder="Повторите пароль" type="password" v-model="password_confirmation">
                            </div> <!-- form-group// -->
                            <div class="form-group capcha" v-if="capcha">
                                <vue-recaptcha
                                    ref="recaptcha"
                                    :sitekey="sitekey"
                                    @verify="recapcha"
                                    @expired="onCaptchaExpired"
                                />
                            </div>
                            <div class="form-group">
                                <button @click.prevent="formSubmit" type="submit" class="btn btn-primary btn-block"> Регистрация  </button>
                            </div> <!-- form-group// -->
                        </form>
                    <p class="text-center">Уже есть аккаунт? <router-link to="login">Войти</router-link> </p>
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
    import VueTelInput from 'vue-tel-input';
    import VueRecaptcha from 'vue-recaptcha';

    Vue.use(VueTelInput);

    export default {
        components: { VueRecaptcha },
        data() {
            return {
                nick: null,
                name: null,
                email: null,
                phone: null,
                password: null,
                password_confirmation: null,
                error: false,
                success: false,
                msg: null,
                phone_valid: Boolean,
                max: 25,
                sitekey: '6LdnNKEUAAAAAIzn8woHwzNxDirvs602Yj2TlhSB',
                capcha: false,
                validate: false
            };
        },

        methods: {

            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
                console.log('Capcha is - ' + this.capcha);
                if(!this.nick || !this.name || !this.email || !this.phone || !this.password || !this.password_confirmation){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Заполните поля!";
                } else if(!this.validEmail(this.email)){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Email не валиден!";
                } else if(!this.validName(this.name)){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Неверное имя!";
                } else if(!this.validNick(this.nick)){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Неверный ник!";
                }  else if(this.password.length <= 3){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Короткий пароль!";
                } else if(this.password !== this.password_confirmation){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Повторите пароль!";
                } else if(!this.phone_valid){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Номер не валиден!";
                } else {
                    this.error = false;
                    this.capcha = true;
                }

                if(this.validate){
                    this.recapcha();
                }
            },

            recapcha(token){
                let currentObj = this;
                axios.post('/recapcha', {
                    recaptcha_token: token
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
                        currentObj.validate = true;
                        currentObj.registration();

                    }
                })
                .catch(function (error) {
                    if(error){
                        currentObj.$Progress.fail();
                        currentObj.error = true;
                        currentObj.success = false;
                        currentObj.msg = error.response.data.errors.email;
                    }

                });
            },

            registration(){
                let currentObj = this;
                currentObj.$Progress.start();
                axios.post('/register', {
                    nick: this.nick,
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
                        currentObj.error = true;
                        currentObj.success = false;
                        currentObj.msg = error.response.data.errors.email[0];
                    }

                });
            },


            validEmail: function (email) {
                let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            validName: function (name) {
                let re = /[a-zA-ZА-яЁё]+/;
                return re.test(name);
            },
            validNick: function (nick) {
                let re = /[a-zA-ZА-яЁё0-9]+/;
                return re.test(nick);
            },
            onInput({ isValid}) {
                this.phone_valid = isValid;
            },

            onCaptchaExpired () {
              this.$refs.recaptcha.reset()
            }
        }
    }

</script>

<style>

    .full-height {
        height: 20px;
    }

    ul{
        width: 259px!important;
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

    .vue-tel-input{
        width: 259px;
    }

    .content {
        text-align: center;
        height: 100%;
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
</style>