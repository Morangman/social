<template>
    <form>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
        </div>
        <input name="" class="form-control" placeholder="Full name" type="text" v-model="name">
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
        <select class="custom-select" style="max-width: 120px;">
            <option selected="">+38</option>
            <option value="1">+7</option>
        </select>
        <input name="" class="form-control" placeholder="Phone number" type="text" v-model="phone">
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
        <button @click.prevent="register" type="submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div> <!-- form-group// -->                                                                    
</form>
</template>

<script>    
import auth from '../auth.js';
export default{
    data(){
        return{
            name: null,
            email: null,
            phone: null,
            password: null,
            password_confirmation: null,
            response: null,
            success: false,
            error: false
        }
    },

    methods:{
        register(){
            auth.register(this, this.name, this.email, this.phone, this.password, this.password_confirmation);
        }
    }
}
</script>