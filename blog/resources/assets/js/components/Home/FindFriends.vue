<template>
<div class="content-home" id="content-home">
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
            <div class="row friends-cards">
            <div class="search-block">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Поиск людей" v-model="search">
                <div class="input-group-append">
                <button class="btn btn-secondary" v-if="search" @click.prevent="searchFriend()" type="submit">
                    <i class="fa fa-search"></i>
                </button>
                </div>
            </div>
            </div>
                <div class="friend-card" v-for="user in paginate_users" v-if="opened">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action align-items-start  mb-1 p-1">
                            <div class="d-flex justify-content-between align-items-center"  data-toggle="tooltip" :title="user.nick">
                                <img v-bind:src="'http://localhost:8000/' + user.photo" class="img-arkadas">
                                <div class="flex-column mx-1">
                                <a @click="GoToProfile(user.id)" href="javascript:void(0)" class="text-dark"><small><strong>{{ user.name }}</strong></small></a>
                                </div>
                                <button class="btn btn-dark fa-pull-right btn-block golge w-25 h-25 mx-1" @click.prevent="addFriend(user.id)" type="submit"><i
                                    class="fas fa-user-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="friend-card" v-for="user in result_search" v-if="!opened">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action align-items-start  mb-1 p-1">
                            <div class="d-flex justify-content-between align-items-center"  data-toggle="tooltip" :title="user.nick">
                                <img v-bind:src="'http://localhost:8000/' + user.photo" class="img-arkadas">
                                <div class="flex-column mx-1">
                                <a @click="GoToProfile(user.id)" href="javascript:void(0)" class="text-dark"><small><strong>{{ user.name }}</strong></small></a>
                                </div>
                                <button class="btn btn-dark fa-pull-right btn-block golge w-25 h-25 mx-1" @click.prevent="addFriend(user.id)" type="submit"><i
                                    class="fas fa-user-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="pagination">
            <button 
                :disabled="pageNumber === 0" 
                @click="prevPage" class="previous">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button 
                :disabled="pageNumber >= page_count" 
                @click="nextPage" class="next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
    <back-to-top bottom="50px" right="50px">
    <button type="button" class="btn btn-info btn-to-top"><i class="fa fa-chevron-up"></i></button>
    </back-to-top>
</div>
</template>

<script> 
export default {
    data () {
        return {
            users: [],
            paginate_users: [],
            search: '',
            opened: true,
            result_search: [],
            pageNumber: 0,
            page_count: 0,
            size: 5
        }
    },
    mounted(){
        let currentObj = this;
        axios.get(`/get_all_users`)
        .then(function (response) {
            if(response){
                currentObj.users = response.data.users;
                currentObj.$Progress.finish();
                
                if(response.data.success == false){
                    currentObj.$Progress.fail();
                    currentObj.$router.push('/login');
                }
            }
        }).then(() =>{
            this.pageCount();
            this.paginatedData();
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

        pageCount(){
        let l = this.users.length,
            s = this.size;
        this.page_count =  Math.floor(l/s);
        },
        paginatedData(){
            const start = this.pageNumber * this.size,
                end = start + this.size
            this.paginate_users =  this.users.slice(start, end);

        },

        nextPage(){
         this.pageNumber++;
         this.pageCount();
         this.paginatedData();
        },
        prevPage(){
            this.pageNumber--;
            this.pageCount();
            this.paginatedData();
        },

        GoToProfile(id){
            this.$router.push('/profile/'+id);
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

        searchFriend(){
            this.opened = false;
            let currentObj = this;
            currentObj.$Progress.start();
            axios.post('/search_friend', {
                search: currentObj.search
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
                    currentObj.result_search = response.data.result_search;
                    currentObj.$Progress.finish();
                }
            }).then(() =>{
                this.pageCount();
                this.paginatedData();
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

    .pagination{
        position: relative;
        top: 50%;
        left: 50%;
        width: 500px;
        margin-left: -250px;
        justify-content: center;
    }

    .previous {
    color: #fff!important;
    background-color: #000!important;
    width: 50px;
    margin-right: 10px;
    text-align: center;
    height: 26px;
    }

    .next {
    color: #fff!important;
    background-color: #000!important;
    width: 50px;
    text-align: center;
    height: 26px;
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

    .friend-card{
        position: relative;
        top: 50%;
        left: 50%;
        width: 500px;
        margin-left: -250px;
        height: 80px;
        display: flex;
        flex-direction: row;
    }

    .friend-photo{
        width: 100px;
        height: auto;
    }

    .search-block{
        position: relative;
        top: 50%;
        left: 50%;
        width: 500px;
        margin-left: -250px;
        height: 80px;
    }
    
    .golge{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
    0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .isteColor{
    color: #cd2147;
    }
    .isteColor:hover{
    color: #353A40;
    }
    .img-deneyim {
    object-fit: cover;
    border-radius:50%;
    width: 90px;
    height: 90px;
    border-style: solid;
    }
    .img-arkadas {
    object-fit: cover;
    border-radius:50%;
    width: 40px;
    height: 40px;
    border-style: solid;
    }

    .list-group-item{
        width: 500px;
    }

    .friends-cards{
        display: flex;
        flex-direction: column;
    }

    </style>