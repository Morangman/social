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

    .emoji-trigger{
        position: absolute;
        right: 14px;
        top: 15px;
    }

    .emoji-mart{
        z-index: 999;
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
        overflow-y: scroll;
    }

    .comments{
            display: flex;
            flex-direction: column;
            padding: 20px;
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

    .popup-card{
        height: 500px;
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
                                    <picker 
                                        v-show="showEmojiPicker"
                                            set="apple"
                                            title="Pick your emoji…" 
                                            emoji="point_up"
                                            :style="{ position: 'absolute', bottom: '-331px', right: '-355px'}"
                                            @select="addEmoji"
                                            >
                                        </picker>

                                        <span
                                        class="emoji-trigger"
                                        :class="{ 'triggered': showEmojiPicker }"
                                        @mousedown.prevent="toggleEmojiPicker"
                                        >
                                        <svg
                                            style="width:20px;height:20px"
                                            viewBox="0 0 24 24"
                                        >
                                            <path fill="#888888" d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8C16.3,8 17,8.7 17,9.5M12,17.23C10.25,17.23 8.71,16.5 7.81,15.42L9.23,14C9.68,14.72 10.75,15.23 12,15.23C13.25,15.23 14.32,14.72 14.77,14L16.19,15.42C15.29,16.5 13.75,17.23 12,17.23Z" />
                                        </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                    <a v-if="image" href="javascript:void(0)" @click="hideFile" style="color: red; z-index: 2; padding-right: 10px;"><i class="fas fa-trash-alt"></i></a>
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
                        <a class="card-link" @click="openComments(post.id)" :href="'#' + 'post' + post.id" :name="'post' + post.id">
                            <h5 class="card-title"> {{post.title}}</h5>
                        </a>
                        <div class="card" v-if="post.src">
                            <img v-img:group class="card-img-top" v-bind:src="'http://localhost:8000/' + post.src" alt="Card image cap"></img>
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
                    <div class="card-footer" id="crd_footer">
                        <span class="text-muted">{{post.likes_cnt}}</span><a href="#" @click.prevent="addLike(post.id)" class="card-link"><i class="fas fa-heart"></i></a>
                        <a :href="'#' + 'post' + post.id" :name="'post' + post.id" @click="openComments(post.id)" class="card-link"><i class="fa fa-comment"></i> Комментарии</a>
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
                                    <a href="javascript:void(0)"><network network="googleplus">
                                    <i class="fab fa-google-plus-square"></i> Google +
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
                        <div class="card">
                            <img v-bind:src="'http://localhost:8000/' + post.src" alt="Card image cap" class="popup-post-image"></img>
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
                            </div>
                            <div class="comment-body">
                                <p class="comment-author-text">{{comment.text}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="add-comment">
                        <form>
                            <textarea name="text" v-model="comment_text" rows="4" type="text" placeholder="Сообщение" class="text-msgs form-control text-message regular-input"></textarea>
                            <button type="submit" @click.prevent="sendComment" class="btn btn-info btn-block">Отправить</button>
                        </form>
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
    export default {
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
                is_refresh: false,
                showEmojiPicker: false,
                open_popup: false,
                comment_text: '',
                comment_postId: 0,
                comments: [],
                post: []
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
            toggleEmojiPicker () {
                this.showEmojiPicker = !this.showEmojiPicker
            },
            addEmoji (emoji) {
                this.text += emoji.native
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

            hideFile(){
                this.image = undefined;
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