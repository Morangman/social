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
                <li class="nav-item"><router-link class="nav-link" to="/news">Новости</router-link></li>
                <li class="nav-item"><router-link class="nav-link" to="/friends">Найти друзей</router-link></li>
                <li class="nav-item"><router-link class="nav-link" to="/chat">Сообщения</router-link></li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="news">
        <div class="lds-spinner" v-if="showPreloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        <div class="check-news" v-if="exist"><p class="check-news-message">Новостей пока нет..</p></div>
        <div class="card gedf-card" v-for="post in posts">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" v-bind:src="'http://localhost:8000/' + post.photo" alt=""></img>
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0">@{{post.nick}}</div>
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
                        <div class="post_body" v-html="post.post_body"></div>
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
        </div>
        <back-to-top bottom="50px" right="50px">
        <button type="button" class="btn btn-info btn-to-top"><i class="fa fa-chevron-up"></i></button>
        </back-to-top>
    </div>
    </div>
    
</div>
</template>

<script>
    export default {
        data () {
            return {
                posts: [],
                showPreloader: false,
                exist: false
            }
        },

        mounted() {
            this.getPosts();
        },

        methods: {
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

            getPosts(){
                this.showPreloader = true;
                let currentObj = this;
                axios.get(`/get_news`)
                .then(function (response) {
                    if(response){
                        currentObj.showPreloader = false;
                        currentObj.posts = response.data.posts;
                        if(currentObj.posts.length == 0){
                            currentObj.exist = true;
                        }else{
                            currentObj.exist = false;
                        }
                        currentObj.$Progress.finish();
                        
                        if(response.data.success == false){
                            currentObj.$Progress.fail();
                            currentObj.$router.push('/login');
                        }
                    }
                })
            }
        }
    }
</script>

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

    .check-news{
        text-align: center;
        background-color: #81aad1;
        color: white;
        border-radius: 10px;
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

    .comment_reply{
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

    .comments_cnt{
        margin-left: 10px;
    }

    .dropdown{
        display: inline;
    }

    .news{
        position: relative;
        top: 50%;
        left: 50%;
        width: 500px;
        margin-left: -250px;
    }

.lds-spinner {
  color: official;
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
  left: 50%;
  top: 100px;
}
.lds-spinner div {
  transform-origin: 32px 32px;
  animation: lds-spinner 1.2s linear infinite;
}
.lds-spinner div:after {
  content: " ";
  display: block;
  position: absolute;
  top: 3px;
  left: 29px;
  width: 5px;
  height: 14px;
  border-radius: 20%;
  background: black;
}
.lds-spinner div:nth-child(1) {
  transform: rotate(0deg);
  animation-delay: -1.1s;
}
.lds-spinner div:nth-child(2) {
  transform: rotate(30deg);
  animation-delay: -1s;
}
.lds-spinner div:nth-child(3) {
  transform: rotate(60deg);
  animation-delay: -0.9s;
}
.lds-spinner div:nth-child(4) {
  transform: rotate(90deg);
  animation-delay: -0.8s;
}
.lds-spinner div:nth-child(5) {
  transform: rotate(120deg);
  animation-delay: -0.7s;
}
.lds-spinner div:nth-child(6) {
  transform: rotate(150deg);
  animation-delay: -0.6s;
}
.lds-spinner div:nth-child(7) {
  transform: rotate(180deg);
  animation-delay: -0.5s;
}
.lds-spinner div:nth-child(8) {
  transform: rotate(210deg);
  animation-delay: -0.4s;
}
.lds-spinner div:nth-child(9) {
  transform: rotate(240deg);
  animation-delay: -0.3s;
}
.lds-spinner div:nth-child(10) {
  transform: rotate(270deg);
  animation-delay: -0.2s;
}
.lds-spinner div:nth-child(11) {
  transform: rotate(300deg);
  animation-delay: -0.1s;
}
.lds-spinner div:nth-child(12) {
  transform: rotate(330deg);
  animation-delay: 0s;
}
@keyframes lds-spinner {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
</style>