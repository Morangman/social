<template>
<div class="content">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <ul class="navbar-nav">
                <router-link to="/" class="nav-link">Home</router-link>
                <router-link to="/" class="nav-link" >Spa-Page</router-link>
            </ul>
        </div>
    </nav>
        <div class="container">
            <div class="card bg-light">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h1>Data from server</h1>
                    {{info.name}}

                    <p><router-link to="/">Home</router-link> </p>
                    <form>
                    <button @click.prevent="Logout" type="submit" class="btn btn-primary btn-block"> Logout </button>
                    </form>
                </article>
            </div>
        </div>
</div>
</template>

<script>
    export default {

        data () {
            return {
                info: []
            }
        },
        mounted () {
            let currentObj = this;
            axios.get(`/getdata`)
                .then(function (response) {
                    if(response){
                        console.log(response);
                        currentObj.info = response.data.user;
                        if(response.data.success == false){
                            currentObj.$router.push('/');
                        }
                    }
                })
        },
        methods:{
            Logout(){
                let currentObj = this;
                axios.post('/logout', {
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
                        currentObj.$router.push('/');
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>

</style>