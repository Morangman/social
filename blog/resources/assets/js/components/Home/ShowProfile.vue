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
        margin-top:10px;
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

    #add_to_friends{
        margin-top: 10px;
    }

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

    .fa-thumbs-up{
        margin-left: 4px;
    }

    .fa-thumbs-down{
        margin-left: 4px;
    }   

    .social_icons{
        display: flex;
        flex-direction: column;
        margin-left: 20px;
    }

    #crd_footer{
        display: inline-flex;
    }

    #crd_footer > .dropdown > button{
        padding: 0;
        margin-left: 10px;
    }

.popup-comments{
        background-color: whitesmoke;
        z-index: 3;
        position: fixed;
        top: 50%;
        left: 50%;
        width: 1000px;
        margin-left: -500px;
        margin-top: -280px;
    }

    .popup-post{
        float: left;
        width: 50%;
    }

    .comments-block{
        float: right;
        width: 50%;
        height: 500px;
        overflow-y: auto;
    }

    .comments{
            display: flex;
            flex-direction: column;
            padding: 10px;
    }

    .comment-header{
        display: flex;
        width: 100%;
        height: 100%;
    }

    .comment-header > .comment-author-photo{
            width: 40px;
            height: 40px;
            border-radius: 50%;
    }

    .comment-author-name{
            padding-left: 10px;
            padding-top: 5px;
    }

    .comment-body{
        width: 100%;
        height: 100%;
        background-color: antiquewhite;
        word-break: break-word;
        border-radius: 10px;
    }

    .comment-author-text{
        padding-left: 10px;
    }

    .comment_publication_date{
        margin-left: 10px;
        font-size: 12px;
        margin-top: 10px;
        color: darkgrey;
    }

    .popup-close{
        position: absolute;
        right: 29px;
        font-size: 25px;
        color: lightcoral;
    }

    .popup-post-image{
        max-width: 485px;
        max-height: 310px;
    }

    .comments_cnt{
        margin-left: 10px;
    }

    .comment_reply{
        margin-left: 10px;
        font-size: 12px;
        margin-top: 10px;
        color: darkgrey; 
    }

    .popup-post-created-at{
        margin-left: 10px;
        font-size: 12px;
        margin-top: 10px;
        color: darkgrey;
        float: right;
    }

    .popup-card{
        height: 500px;
        overflow-y: auto;
    }

    .dropdown{
        display: inline;
    }
</style>
<template>
<div class="content-home">
        <div class="container">
        <nav class="navbar navbar-light navbar-expand-sm navbar-template">
            <a class="navbar-brand" href="/home">Social</a>
            <div class="d-flex flex-row order-2 order-sm-3">
                <ul class="navbar-nav flex-row">
                    <li class="nav-item"><router-link class="nav-link px-2" to="/settings"><i class="fas fa-cog"></i></router-link></li>
                    <li class="nav-item"><a class="nav-link px-2"  @click='Logout' href="#"><i class="fas fa-sign-out-alt"></i></a></li>
                </ul>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse order-3 order-sm-2" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><router-link class="nav-link" to="/home">Главная</router-link></li>
                    <li class="nav-item"><router-link class="nav-link" to="/chat">Сообщения</router-link></li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img v-img class="card-img-top" v-bind:src="'http://localhost:8000/' + user.photo" alt="Card image cap"></img>
                </div>

                <div class="card">
                    <button id="wrtite" name="submit" type="submit" class="btn btn-primary" @click.prevent="Write(user.id)"><i class="fas fa-comments"></i> Написать</button></hr>
                    <button id="add_to_friends" name="submit" v-if="!check"  @click.prevent="addFriend(user.id)" type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> Добавить в друзья</button>
                    <a v-if="check"  @click.prevent="deleteFriend(user.id)" href="#" style="text-align:center; color: red;"><i class="fas fa-user-times"></i> Удалить с друзей</a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="h5">@{{user.nick}}</div>
                        <div class="h5 text-muted"> {{user.name}}</div>
                        <div class="h7 text-muted">E-mail : {{user.email}}</div>
                        <div class="h7 text-muted">Телефон: {{user.phone}}</div>
                        <hr>
                        <div class="h7">{{user.info}}
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Подписчиков</div>
                            <div class="h5">{{count_followers}}</div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Друзей</div>
                            <div class="h5">{{count_friends}}</div>
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
                        </div>

                    </div>
                    <div class="card-body">
                        <a class="card-link"  @click="openComments(post.id)" :href="'#' + 'post' + post.id" :name="'post' + post.id">
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
                        </div>
                    </div>
                    <div class="card-footer"  id="crd_footer">
                        <span>{{post.likes_cnt}}</span><a href="#" @click.prevent="addLike(post.id)" class="card-link"><i class="fas fa-heart"></i></a>
                        <span class="comments_cnt text-muted">{{post.comments_cnt}}</span><a  @click="openComments(post.id)" :href="'#' + 'post' + post.id" :name="'post' + post.id" class="card-link"><i class="fa fa-comment"></i> Комментарии</a>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bullhorn"></i> Поделиться
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                <social-sharing url="https://vuejs.org/" inline-template>
                                <div class="social_icons">
                                    <a href="javascript:void(0)"><network network="facebook">
                                    <i class="fab fa-facebook"></i> Facebook
                                    </network></a>
                                    <a href="javascript:void(0)"><network network="linkedin">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                    </network></a>
                                    <a href="javascript:void(0)"><network network="twitter">
                                    <i class="fab fa-twitter-square"></i> Twitter
                                    </network></a>
                                    <a href="javascript:void(0)"><network network="vk">
                                    <i class="fab fa-vk"></i> VKontakte
                                    </network></a>
                                    <a href="javascript:void(0)"><network network="whatsapp">
                                    <i class="fab fa-whatsapp-square"></i> Whatsapp
                                    </network></a>
                                </div>
                                </social-sharing>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popup-comments" v-show="open_popup">
            <a class="popup-close" href="javascript:void(0)" @click="closePopup"><span><i class="fas fa-times"></i></span></a>
            <div class="popup-post">
                <div class="card popup-card">
                    <div class="card-body">
                        <a class="card-link"href="#">
                            <h5 class="card-title">{{post.title}}</h5>
                        </a>
                        <div class="card" v-if="post.src">
                            <img v-bind:src="'http://localhost:8000/' + post.src" alt="Card image cap" class="popup-post-image"></img>
                        </div>
                        <div class="popup-post-info">
                            <p class="popup-post-created-at">{{post.created_at | moment("calendar")}}</p>
                            <span class="text-muted">{{post.likes_cnt}}</span><a href="#" @click.prevent="addLike(post.id)" class="card-link"><i class="fas fa-heart"></i></a>
                            <span class="comments_cnt text-muted">{{post.comments_cnt}}</span><a :href="'#' + 'post' + post.id" :name="'post' + post.id" @click="openComments(post.id)" class="card-link"><i class="fa fa-comment"></i> Комментарии</a>
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bullhorn"></i> Поделиться
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                    <social-sharing url="https://vuejs.org/" inline-template>
                                    <div class="social_icons">
                                        <a href="javascript:void(0)"><network network="facebook">
                                        <i class="fab fa-facebook"></i> Facebook
                                        </network></a>
                                        <a href="javascript:void(0)"><network network="linkedin">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                        </network></a>
                                        <a href="javascript:void(0)"><network network="twitter">
                                        <i class="fab fa-twitter-square"></i> Twitter
                                        </network></a>
                                        <a href="javascript:void(0)"><network network="vk">
                                        <i class="fab fa-vk"></i> VKontakte
                                        </network></a>
                                        <a href="javascript:void(0)"><network network="whatsapp">
                                        <i class="fab fa-whatsapp-square"></i> Whatsapp
                                        </network></a>
                                    </div>
                                    </social-sharing>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p class="card-text" >
                        {{post.post_body}}
                        </p>
                    </div>
                </div>
            </div>
                <div class="comments-block" id="commentbody">
                    <div class="comments" v-for="comment in comments">
                        <div class="comment">
                            <div class="comment-header">
                                <img v-bind:src="'http://localhost:8000/' + comment.photo" class="comment-author-photo"></img>
                                <p class="comment-author-name">{{comment.name}}</p>
                                <p class="comment_publication_date">{{ comment.created_at | moment("calendar") }}</p>
                                <a href="javascript:void(0)" class="comment_reply" @click="Reply(comment.name)">Ответить</a>
                            </div>
                            <div class="comment-body">
                                <p class="comment-author-text">{{comment.text}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="add-comment">
                        <form>
                            <textarea name="text" v-model="comment_text" rows="3" type="text" placeholder="Сообщение" class="text-msgs form-control text-message regular-input"></textarea>
                            <button type="submit" @click.prevent="sendComment" class="btn btn-info btn-block">Отправить</button>
                        </form>
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
                        <h5 class="card-title">{{user.nick}} friends <span>{{count_friends}}</span></h5>
                        <ul class="list"  v-for="friend in friends">
                            <a  @click="GoToProfile(friend.id)" href=""><li class="list-item"><img v-bind:src="'http://localhost:8000/' + friend.photo" style="width: 20px; height: 20px;"></img> <p id="friendName">{{ friend.name }} </p><i class="fas fa-comment-alt"></i></li></a>
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
        user_id: 0,
        user: '',
        posts: [],
        check: true,
        friends: [],
        count_friends: 0,
        count_followers: 0,
        is_active_add: false,
        is_active_delete: false,
        open_popup: false,
        comment_text: '',
        comment_postId: 0,
        comments: [],
        post: [],
        reply_name: ''
    }
},
mounted () {
    this.Start();
    this.checkFriend();
    this.getUser();
    this.getPosts();
    this.get_friends();
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

        openComments(e){

        this.open_popup = !this.open_popup;
        this.comment_postId = e;

        let currentObj = this;
        axios.post('/get_post_info', {
            post_id: currentObj.comment_postId
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
                currentObj.comments = response.data.comments;
                currentObj.post = response.data.post;
            }
        }).then(() => {
            currentObj.scrollToEnd();
            currentObj.comment_text = undefined;
        })
        .catch(function (error) {
            if(error){
                console.log(error.response.data);
            }
        }) 
        },

        closePopup(){
            this.open_popup = !this.open_popup;
            this.clearParam();
        },

        clearParam(){
            this.comments = '';
            this.post = '';
        },

        
        Reply(user_name){
            this.comment_text = '';
            this.reply_name = user_name;
            this.comment_text += '@'+ this.reply_name + ', ';
            this.scrollToEnd();
        },

        sendComment(e){
        e.preventDefault();
        let currentObj = this;
        if(this.comment_text || this.comment_postId)
        axios.post('/send_comment', {
            text: currentObj.comment_text,
            post_id: currentObj.comment_postId
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
                currentObj.comments = response.data.comments;
                console.log(currentObj.comments);
            }
        }).then(() => {
            currentObj.scrollToEnd();
            currentObj.comment_text = undefined;
        })
        .catch(function (error) {
            if(error){
                console.log(error.response.data);
            }
        })     
        },

        scrollToEnd: function() {    	
        let container = this.$el.querySelector("#commentbody");
        container.scrollTop = container.scrollHeight;
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
            axios.post('/get_friend_posts', {
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
                        //    currentObj.$router.push('home');
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

            addFriend(friendId) {
                let friend_id = friendId;
                let currentObj = this;
                currentObj.$Progress.start();
                if(!this.is_active_add){
                    axios.post('/add_friend', {
                        friend_id: friend_id
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
                            //    currentObj.$router.push('home');
                            currentObj.$Progress.finish();
                        }
                    }).then(() => {
                        currentObj.checkFriend();
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
                    this.is_active_add = true;
                }
            },

            deleteFriend(friendId) {
                let friend_id = friendId;
                let currentObj = this;
                currentObj.$Progress.start();
                if(!this.is_active_delete){
                axios.delete('/delete_friend/'+ friend_id, {
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
                            //    currentObj.$router.push('home');
                            currentObj.$Progress.finish();
                        }
                    }).then(() => {
                        currentObj.checkFriend();
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
                    this.is_active_delete = true;
                }    
            },
                
            checkFriend() {
                let friend_id = this.user_id;
                let currentObj = this;
                currentObj.$Progress.start();
                    axios.post('/check_friend', {
                        friend_id: friend_id
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
                            // currentObj.check = false;
                             currentObj.check = response.data.check;
                            //    currentObj.$router.push('home');
                            currentObj.$Progress.finish();
                        }else{
                            currentObj.check = true;
                        }
                    }).then(() => {
                        //currentObj.getPosts();
                    })
                    .catch(function (error) {
                        if(error){
                            currentObj.$Progress.fail();
                            // currentObj.error = true;
                            // currentObj.success = false;
                            // currentObj.msg = error.response.data.message;
                        }
                    })
                },

            get_friends() {
                let friend_id = this.user_id;
                let currentObj = this;
                currentObj.$Progress.start();
                    axios.post('/friend_friends', {
                        friend_id: friend_id
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
                             currentObj.friends = response.data.friends;
                             currentObj.count_friends = response.data.count;
                             currentObj.count_followers = response.data.count_f;
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

                Write(id){
                    let friend_id = id;
                    let currentObj = this;
                    currentObj.$Progress.start();
                    axios.post('/create_room', {
                        user_id: friend_id
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
                             currentObj.$router.push('/chat');
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

            GoToProfile(id){
                this.$router.push('/profile/'+id);
            }
    }
}

</script>