<style scoped>
    body {
        background-color: #eeeeee;
    }

    .h7 {
        font-size: 0.8rem;
    }

    .gedf-wrapper {
        margin-top: 0.97rem;
    }

    @media (min-width: 992px) {
        .gedf-main {
            padding-left: 4rem;
            padding-right: 4rem;
        }
        .gedf-card {
            margin-bottom: 2.77rem;
        }
    }

    /**Reset Bootstrap*/
    .dropdown-toggle::after {
        content: none;
    }
    .container{
        margin-top:50px;
    }

    .profile-pic {
        height: 270px;
        background-size: cover;
        background-position: center;
        background-blend-mode: multiply;
        vertical-align: middle;
        text-align: center;
        color: transparent;
        transition: all .3s ease;
        text-decoration: none;
        cursor: pointer;
    }

    .profile-pic:hover {
        background-color: rgba(0,0,0,.5);
        z-index: 10000;
        color: #fff;
        transition: all .3s ease;
        text-decoration: none;
    }

    .profile-pic span {
        display: inline-block;
        padding-top: 8em;
        padding-bottom: 4.5em;
    }

</style>
<template>
<div class="content-home">
    <nav class="navbar navbar-light navbar-expand-sm navbar-template">
        <a class="navbar-brand" href="/home">Social</a>
        <div class="d-flex flex-row order-2 order-sm-3">
            <ul class="navbar-nav flex-row">
                <li class="nav-item"><a class="nav-link px-2" href="#"><i class="fab fa-facebook"></i></a></li>
                <li class="nav-item"><a class="nav-link px-2" href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="nav-item"><a class="nav-link px-2" href="#"><i class="fab fa-youtube"></i></a></li>
                <li class="nav-item"><a class="nav-link px-2" href="#"><i class="fab fa-instagram"></i></a></li>
                <li class="nav-item"><router-link class="nav-link px-2" to="settings"><i class="fas fa-cog"></i></router-link></li>
                <li class="nav-item"><a class="nav-link px-2"  @click="Logout" href="#"><i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse order-3 order-sm-2" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"> <router-link class="nav-link" to="/home">Home</router-link></li>
                <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
            </ul>
        </div>
    </nav>
        <div class="container">
        <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img v-img class="card-img-top" v-bind:src="'http://localhost:8000/' + user.photo" alt="Card image cap"></img>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="h5">@{{user.nick}}</div>
                        <div class="h7 text-muted">Fullname : {{user.name}}</div>
                        <div class="h7 text-muted">E-mail : {{user.email}}</div>
                        <div class="h7 text-muted">Phone: : {{user.phone}}</div>
                        <hr>
                        <div class="h7">Developer of web applications, JavaScript, PHP, Java, Python, Ruby, Java, Node.js,
                            etc.
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Followers</div>
                            <div class="h5">5.2342</div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Following</div>
                            <div class="h5">6758</div>
                        </li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <div class="card gedf-card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <p>All posts</p>
                    </div>
                </div>

                <div class="card gedf-card" v-for="post in posts">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" v-bind:src="'http://localhost:8000/' + user.photo" alt=""></img>
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0">@{{user.nick}}</div>
                                    <div class="h7 text-muted">{{ post.created_at | moment("calendar") }}</div>
                                </div>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        <a class="dropdown-item" href="#">Save</a>
                                        <a class="dropdown-item" href="#">Hide</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <a class="card-link" href="#">
                            <h5 class="card-title"> {{post.title}}</h5>
                        </a>
                        <div class="card" v-if="post.src">
                            <img v-img class="card-img-top" v-bind:src="'http://localhost:8000/' + post.src" alt="Card image cap"></img>
                        </div>
                        <hr>
                        <p class="card-text" >
                            {{post.post_body}}
                        </p>
                        <div>
                            <span class="badge badge-primary">JavaScript</span>
                            <span class="badge badge-primary">Android</span>
                            <span class="badge badge-primary">PHP</span>
                            <span class="badge badge-primary">Node.js</span>
                            <span class="badge badge-primary">Ruby</span>
                            <span class="badge badge-primary">Paython</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span>{{post.likes_cnt}}</span><a href="#" @click.prevent="addLike(post.id)" class="card-link"><i class="fa fa-gittip"></i>Like</a>
                        <span>{{post.dislikes}}</span><a href="#" @click.prevent="addDislike(post.id)" class="card-link"><i class="fa fa-gittip"></i>Dislike</a>
                         <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Find friends!</h5>
                        <div class="container">
                            <div class="row">
                            //
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
    </div>
</div>

</template>

<script>
export default {


data () {
    return {
        user_id: '',
        user: '',
        posts: [],
    }
},
mounted () {
    this.Start();
    this.getUser();
    this.getPosts();
},

    methods:{
        Logout(){
            let currentObj = this;
            currentObj.$Progress.start();
            axios.post('/logout', {
            })
            .then(function (response) {
                if(response){
                    currentObj.$router.push('/login');
                    currentObj.$Progress.finish();
                }
            })
            .catch(function (error) {
                currentObj.$Progress.fail();
                console.log(error);
            });
        },
        Start(){
            this.$Progress.start();
            this.user_id = this.$route.params.id;
        },

        getUser(){
            let currentObj = this;
            currentObj.$Progress.start();
            axios.post('/get_user', {
                user_id: this.user_id
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
                    currentObj.user = response.data.user[0];
                    console.log(currentObj.user);
                    currentObj.$Progress.finish();
                }
            })
            .catch(function (error) {
                if(error){
                    currentObj.$Progress.fail();
                    console.log(error.response.data);
                    // currentObj.error = true;
                    // currentObj.success = false;
                    // currentObj.msg = error.response.data.message;
                }
            })
        
        },

        getPosts(){
            let currentObj = this;
            currentObj.$Progress.start();
            axios.post('/get_posts', {
                user_id: this.user_id
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
                    currentObj.posts = response.data.posts;
                    console.log(currentObj.user);
                    currentObj.$Progress.finish();
                }
            })
            .catch(function (error) {
                if(error){
                    currentObj.$Progress.fail();
                    console.log(error.response.data);
                    // currentObj.error = true;
                    // currentObj.success = false;
                    // currentObj.msg = error.response.data.message;
                }
            })
        
        },
        addLike(postId) {
            let post_id = postId;
            let currentObj = this;
            currentObj.$Progress.start();
                axios.post('/like', {
                    postId: post_id
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
                        // currentObj.error = false;
                        // currentObj.success = true;
                        // console.log(response.data);
                        //currentObj.array_likes = response.data;
                            currentObj.$router.push('home');
                        currentObj.$Progress.finish();
                    }
                }).then(() => {
                    currentObj.getPosts();
                })
                .catch(function (error) {
                    if(error){
                        currentObj.$Progress.fail();
                        console.log(error.response.data);
                        // currentObj.error = true;
                        // currentObj.success = false;
                        // currentObj.msg = error.response.data.message;
                    }
                })
            },

            addDislike(postId) {
            let post_id = postId;
            let currentObj = this;
            currentObj.$Progress.start();
                axios.post('/dislike', {
                    postId: post_id
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
                        // currentObj.error = false;
                        // currentObj.success = true;
                            currentObj.$router.push('home');
                        currentObj.$Progress.finish();
                    }
                }).then(() => {
                    currentObj.getPosts();
                })
                .catch(function (error) {
                    if(error){
                        currentObj.$Progress.fail();
                        console.log(error.response.data);
                        // currentObj.error = true;
                        // currentObj.success = false;
                        // currentObj.msg = error.response.data.message;
                    }
                })
            }
    }
}

</script>