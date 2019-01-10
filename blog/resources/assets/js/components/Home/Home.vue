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

    .fa-camera { transform: scale(2,2); cursor: pointer;}
    .fa-trash { transform: scale(2,2); cursor: pointer;}

    .list{    
        list-style: none;
        margin: 0;
        padding: 0;
    }

    li.list-item{
        margin: 0;
        padding: 0;
        display: flex;
    }

    #friendName{
        margin-left: 5px;
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
                <li class="nav-item"><router-link class="nav-link px-2" to="/settings"><i class="fas fa-cog"></i></router-link></li>
                <li class="nav-item"><a class="nav-link px-2"  @click="Logout" href="#"><i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse order-3 order-sm-2" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><router-link class="nav-link" to="/home">Home</router-link></li>
                <li class="nav-item"><router-link class="nav-link" to="/chat">Messages</router-link></li>
                <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
            </ul>
        </div>
    </nav>
        <div class="container">
        <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                <form>
                    <div class="profile-pic" v-bind:style="{ backgroundImage: 'url(' + info.photo + ')' }">
                        <span><a @click="$refs.file.click()"><i style="margin-right: 50px;" class="fas fa-camera"></i></a></span>
                        <span><a @click="deleteUserPhoto()"><i class="fas fa-trash"></i></a></span>
                        <input type="file" ref="file" hidden  v-on:change="changeProfileImage" ></input>
                    </div>
                </form>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="h5">@{{info.nick}}</div>
                        <div class="h5 text-muted"> {{info.name}}</div>
                        <div class="h7 text-muted">E-mail : {{info.email}}</div>
                        <div class="h7 text-muted">Phone : {{info.phone}}</div>
                        <hr>
                        <div class="h7">{{info.info}}
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
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                                    a publication</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Tags</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                    <form>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <div class="form-group">
                                    <label class="sr-only" for="message">title</label>
                                    <input class="form-control" id="message" name="title" v-model="title" placeholder="Title"></input>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="message">post</label>
                                    <textarea class="form-control" id="message" name="text" v-model="text" rows="3" placeholder="What are you thinking?"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                    <div id="preview">
                                            <img style=" height: 38px;" v-if="image" :src="image" />
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" v-on:change="changeImage" aria-describedby="inputGroupFileAddon01"></input>
                                        <label class="custom-file-label" for="inputGroupFile01"><p>Select photo</p></label>
                                        <div class="custom-file-label" v-if="image">{{name.name}}</div>
                                    </div>
                                </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <input-tag v-model="tags" placeholder="Input tags"></input-tag>
                                <div class="py-4"></div>
                            </div>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="submit" @click.prevent="addPost" class="btn btn-primary" >share</button>
                            </div>
                            <div class="btn-group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-globe"></i> Public
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <div class="card gedf-card" v-for="post in posts">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" v-bind:src="'http://localhost:8000/' + info.photo" alt=""></img>
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0">@{{info.nick}}</div>
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
                                        <a class="dropdown-item" href="#" @click.prevent="deletePost(post.id)">Delete</a>
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
                        <ul class="list"  v-for="user in users">
                            <a  @click="GoToProfile(user.id)" href="#"><li class="list-item"><img v-bind:src="'http://localhost:8000/' + user.photo" style="width: 20px; height: 20px;"></img> <p id="friendName">{{ user.name }} </p></li></a>
                        </ul>
                    </div>
                </div>
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">My friends</h5>
                        <ul class="list"  v-for="friend in friends">
                            <a  @click="GoToProfile(friend.id)" href="#"><li class="list-item"><img v-bind:src="'http://localhost:8000/' + friend.photo" style="width: 20px; height: 20px;"></img> <p id="friendName">{{ friend.name }} </p><i class="fas fa-comment-alt"></i></li></a>
                        </ul>
                    </div>
                    <a href="#" class="card-link" style="text-align:center;">View all</a>
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
                info: [],
                posts: [],
                users: [],
                friends: [],
                title: null,
                text: null,
                image: '',
                name: '',
                likes: '',
                dislikes: '',
                prof_image: '',
                img_name: ''
            }
        },
        mounted () {
            let currentObj = this;
            currentObj.$Progress.start();
            axios.get(`/getdata`)
                .then(function (response) {
                    if(response){
                        currentObj.info = response.data.user;
                        currentObj.$Progress.finish();
                        
                        if(response.data.success == false){
                            currentObj.$Progress.fail();
                            currentObj.$router.push('/login');
                        }
                    }
                }),
                axios.get(`/posts`)
                .then(function (response) {
                    if(response){
                        currentObj.posts = response.data.posts;
                        currentObj.$Progress.finish();
                        
                        if(response.data.success == false){
                            currentObj.$Progress.fail();
                            currentObj.$router.push('/login');
                        }
                    }
                }),
                axios.get(`/get_users`)
                .then(function (response) {
                    if(response){
                        currentObj.users = response.data.users;
                        currentObj.$Progress.finish();
                        
                        if(response.data.success == false){
                            currentObj.$Progress.fail();
                            currentObj.$router.push('/login');
                        }
                    }
                }),

                axios.get(`/get_all_friends`)
                .then(function (response) {
                    if(response){
                        currentObj.friends = response.data.friends;
                        currentObj.$Progress.finish();
                        
                        if(response.data.success == false){
                            currentObj.$Progress.fail();
                            currentObj.$router.push('/login');
                        }
                    }
                })
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

            changeImage(e) {
                this.name = e.target.files[0];
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            changeProfileImage(e) {
                this.img_name = e.target.files[0];
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createProfileImage(files[0]);
            },
            createProfileImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.prof_image = e.target.result;
                    vm.updateProfileImage();
                };
                reader.readAsDataURL(file);
                
            },

            updateProfileImage(){
                let currentObj = this;
                currentObj.$Progress.start();
                axios.post('/update_image', {
                    prof_image: this.prof_image
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
                        currentObj.$router.push('/home');
                        currentObj.$Progress.finish();
                    }
                }).then(() => {
                    currentObj.getUser();
                }).then(() => {
                    currentObj.getUsers();
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
                axios.get(`/posts`)
                .then(function (response) {
                    if(response){
                        currentObj.posts = response.data.posts;
                        currentObj.$Progress.finish();
                        
                        if(response.data.success == false){
                            currentObj.$Progress.fail();
                            currentObj.$router.push('/login');
                        }
                    }
                })
            },

            getUser(){
                let currentObj = this;
                currentObj.$Progress.start();
                axios.get(`/getdata`)
                    .then(function (response) {
                        if(response){
                            currentObj.info = response.data.user;
                            currentObj.$Progress.finish();
                            
                            if(response.data.success == false){
                                currentObj.$Progress.fail();
                                currentObj.$router.push('/login');
                            }
                        }
                    })
            },

            getUsers(){
                axios.get(`/get_users`)
                .then(function (response) {
                    if(response){
                        currentObj.users = response.data.users;
                        currentObj.$Progress.finish();
                        
                        if(response.data.success == false){
                            currentObj.$Progress.fail();
                            currentObj.$router.push('/login');
                        }
                    }
                })
            },

            addPost(e) {
                e.preventDefault();
                let currentObj = this;
                currentObj.$Progress.start();
                if(!this.title || !this.text){
                    currentObj.$Progress.fail();
                    this.error = true;
                    this.success = false;
                    this.msg = "Empty fields!";
                } else {
                    axios.post('/add_post', {
                        title: this.title,
                        text: this.text,
                        image: this.image
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
                            currentObj.$router.push('/home');
                            currentObj.$Progress.finish();
                            currentObj.title = undefined;
                            currentObj.text = undefined;
                            currentObj.image = undefined;
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
            },

            deletePost(id) {
                let currentObj = this;
                currentObj.$Progress.start();
                let post_id = id;
                axios.delete('/post_delete/'+ post_id, {
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
            },

            deleteUserPhoto() {
            let currentObj = this;
            currentObj.$Progress.start();
                axios.delete('/delete_image' , {
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
                    currentObj.getUser();
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

            GoToProfile(id){
                this.$router.push('/profile/'+id);
            }
        }
    }
</script>