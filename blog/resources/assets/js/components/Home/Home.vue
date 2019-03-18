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

    .fa-thumbs-up{
        margin-left: 4px;
    }

    .fa-thumbs-down{
        margin-left: 4px;
    }   

    .emoji-invoker {
    position: absolute;
    bottom: 5px;
    right: 1.5rem;
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.2s;
    }
    .emoji-invoker:hover {
    transform: scale(1.1);
    }
    .emoji-invoker > svg {
    fill: #b1c6d0;
    }

    .emoji-picker {
    position: absolute;
    z-index: 9999;
    font-family: Montserrat;
    border: 1px solid #ccc;
    height: 20rem;
    overflow: scroll;
    padding: 1rem;
    box-sizing: border-box;
    border-radius: 0.5rem;
    background: #fff;
    box-shadow: 1px 1px 8px #c7dbe6;
    }
    .emoji-picker__search {
    display: flex;
    }
    .emoji-picker__search > input {
    flex: 1;
    border-radius: 10rem;
    border: 1px solid #ccc;
    padding: 0.5rem 1rem;
    outline: none;
    }
    .emoji-picker h5 {
    margin-bottom: 0;
    color: #b1b1b1;
    text-transform: uppercase;
    font-size: 0.8rem;
    cursor: default;
    }
    .emoji-picker .emojis {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    }
    .emoji-picker .emojis:after {
    content: "";
    flex: auto;
    }
    .emoji-picker .emojis span {
    padding: 0.2rem;
    cursor: pointer;
    border-radius: 5px;
    }
    .emoji-picker .emojis span:hover {
    background: #ececec;
    cursor: pointer;
    }
    .wrapper {
    position: relative;
    }

    .regular-input {
    border-radius: 3px;
    border: 1px solid #ccc;
    }
    .dropdown-menu-right > a:hover{
        background-color: #e0f0ff;
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
                        <div class="h7 text-muted">Телефон : {{info.phone}}</div>
                        <hr>
                        <div class="h7">{{info.info}}
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
                        <li class="list-group-item">Develop by Sosial</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <div class="card gedf-card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Сделать публикацию</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">#Тэги</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                    <form>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <div class="form-group">
                                    <label class="sr-only" for="message">title</label>
                                    <input class="form-control" id="message" name="title" v-model="title" placeholder="Заголовок"></input>
                                </div>
                                <div class="form-group">
                                <div class="wrapper">
                                    <label class="sr-only" for="message">post</label>
                                    <textarea class="form-control regular-input" id="message" name="text" v-model="text" rows="3" placeholder="Что нового?"></textarea>
                                    <emoji-picker @emoji="append" :search="search">
                                    <div
                                        class="emoji-invoker"
                                        slot="emoji-invoker"
                                        slot-scope="{ events }"
                                        v-on="events"
                                    >
                                        <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                                        </svg>
                                    </div>
                                    <div slot="emoji-picker" slot-scope="{ emojis, insert, display }">
                                        <div class="emoji-picker">
                                        <div class="emoji-picker__search">
                                            <input type="text" v-model="search" v-focus>
                                        </div>
                                        <div>
                                            <div v-for="(emojiGroup, category) in emojis" :key="category">
                                            <h5>{{ category }}</h5>
                                            <div class="emojis">
                                                <span
                                                v-for="(emoji, emojiName) in emojiGroup"
                                                :key="emojiName"
                                                @click="insert(emoji)"
                                                :title="emojiName"
                                                >{{ emoji }}</span>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </emoji-picker>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                    <div id="preview">
                                            <img style=" height: 38px;" v-if="image" :src="image" />
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" v-on:change="changeImage" aria-describedby="inputGroupFileAddon01"></input>
                                        <label class="custom-file-label" for="inputGroupFile01"><p>Прикрепить фото</p></label>
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
                                <button type="submit" @click.prevent="addPost" class="btn btn-primary" >Опубликовать</button>
                            </div>
                            <div class="btn-group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i :class="class_name"></i> {{select_name}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#" @click="selectVisible(0)"><i class="fa fa-globe"></i> Для всех</a>
                                    <a class="dropdown-item" href="#" @click="selectVisible(1)"><i class="fa fa-users"></i> Для друзей</a>
                                    <a class="dropdown-item" href="#" @click="selectVisible(2)"><i class="fa fa-user"></i> Для меня</a>
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
                                        <div class="h6 dropdown-header">Настройки</div>
                                        <a class="dropdown-item" @click="Hide(post.id)" href="javascript:void(0)">Скрыть</a>
                                        <a class="dropdown-item" @click="Refresh(true, post.id)" href="#">Изменить</a>
                                        <a class="dropdown-item" href="javascript:void(0)" @click.prevent="deletePost(post.id)">Удалить</a>
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
                            <span v-if="post.is_visible == 0" class="badge badge-success"><i class="fa fa-globe"></i> Для всех</span>
                            <span v-if="post.is_visible == 1" class="badge badge-info"><i class="fa fa-users"></i> Для друзей</span>
                            <span v-if="post.is_visible == 2" class="badge badge-primary"><i class="fa fa-user"></i> Для меня</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="text-muted">{{post.likes_cnt}}</span><a href="#" @click.prevent="addLike(post.id)" class="card-link"><i class="fas fa-thumbs-up"></i></a>
                        <span class="text-muted">{{post.dislikes}}</span><a href="#" @click.prevent="addDislike(post.id)" class="card-link"><i class="fas fa-thumbs-down"></i></a>
                        <a href="#" class="card-link"><i class="fa fa-comment"></i> Комментарии</a>
                        <a href="#" class="card-link"><i class="fas fa-bullhorn"></i> Поделиться</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Новые пользователи</h5>
                        <ul class="list"  v-for="user in users">
                            <a  @click="GoToProfile(user.id)" href="#" class="friend-link"><li class="list-item"><img v-bind:src="'http://localhost:8000/' + user.photo" style="width: 20px; height: 20px;"></img> <p id="friendName">{{ user.name }} </p></li></a>
                        </ul>
                    </div>
                </div>
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Мои друзья <span>{{count_friends}}</span></h5>
                        <ul class="list"  v-for="friend in friends">
                            <a  @click="GoToProfile(friend.id)" href="javascript:void(0)" class="friend-link"><li class="list-item"><img v-bind:src="'http://localhost:8000/' + friend.photo" style="width: 20px; height: 20px;"></img> <p id="friendName">{{ friend.name }} </p><i class="fas fa-comment-alt"></i></li></a>
                        </ul>
                    </div>
                    <a v-if="count_friends>10" href="#" class="card-link" style="text-align:center;">Показать всех</a>
                </div>
            </div>
        </div>
    </div>
            </div>
    </div>
</div>

</template>

<script>
import EmojiPicker from 'vue-emoji-picker'
    export default {
        components: {
            EmojiPicker,
        },

        data () {
            return {
                info: [],
                posts: [],
                users: [],
                tags: [],
                friends: [],
                title: null,
                text: '',
                search: '',
                image: '',
                name: '',
                likes: '',
                dislikes: '',
                prof_image: '',
                img_name: '',
                is_visible: 0,
                count_friends: 0,
                count_followers: 0,
                class_name: 'fa fa-globe',
                select_name: 'Для всех',
                is_refresh: false
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
                        currentObj.count_friends = response.data.count;
                        currentObj.count_followers = response.data.count_f;
                        currentObj.$Progress.finish();
                        
                        if(response.data.success == false){
                            currentObj.$Progress.fail();
                            currentObj.$router.push('/login');
                        }
                    }
                })
        },

        methods:{
            append(emoji) {
                this.text += emoji
            },
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

            Refresh(bool, id){
                let post_id = id;
                this.is_refresh = bool;
                console.log(this.is_refresh);
            },

            Hide(postId){
                let post_id = postId;
                let currentObj = this;
                currentObj.$Progress.start();
                axios.post('/hide_post', {
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

            selectVisible(e){
                this.is_visible = e;
                if(this.is_visible == 0){
                    this.class_name = "fa fa-globe";
                    this.select_name = "Для всех";
                }
                if(this.is_visible == 1){
                    this.class_name = "fa fa-users";
                    this.select_name = "Для друзей";
                }
                if(this.is_visible == 2){
                    this.class_name = "fa fa-user";
                    this.select_name = "Для меня";
                }
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
                        tags: this.tags,
                        image: this.image,
                        is_visible: this.is_visible
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
                         //   currentObj.$router.push('home');
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