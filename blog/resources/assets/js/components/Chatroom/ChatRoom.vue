<template>
<div class="content-home">
<div class="container">
    <nav class="navbar navbar-light navbar-expand-sm navbar-template">
        <a class="navbar-brand" href="/home">Social</a>
        <div class="d-flex flex-row order-2 order-sm-3">
            <ul class="navbar-nav flex-row">
                <li class="nav-item"><router-link class="nav-link px-2" to="/settings"><i class="fas fa-cog"></i></router-link></li>
                <li class="nav-item"><a class="nav-link px-2" @click="Logout"  href="#"><i class="fas fa-sign-out-alt"></i></a></li>
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
                <li class="nav-item"><router-link class="nav-link" to="/chat">Сообщение</router-link></li>
            </ul>
        </div>
    </nav>
    </div>
<div class="container">
	<div class="row">
    <div class="rooms col-sm-4">

    <input class="search-rooms form-control" autocomplete="off" name="title" placeholder="Поиск..."  v-model="keywords"></input>
    <div v-if="!keywords">
      <a href="javascript:void(0)" class="chatperson" v-for="room in rooms"  @click="getMessages(room.room_id)">
        <div class="namechat">
            <div class="pname">{{room.name}}</div>
            <div class="lastmsg">Последнее сообщение</div>
        </div>
      </a>
    </div>
    <div v-if="keywords">
      <a href="javascript:void(0)" class="chatperson" v-for="result in results"  @click="getMessages(result.id)">
          <div class="namechat">
              <div class="pname">{{result.name}}</div>
              <div class="lastmsg">Последнее сообщение</div>
          </div>
      </a>
    </div>

    </div>
    <div class="col-sm-8">
    <div id="chatbody" class="chatbody">
    <div class="choise" v-if="!check_msgs">
      <p>Выберите, кому хотели бы написать</p>
    </div>
    <div class="choise" v-if="check">
      <p>Здесь пока ничего нет...</p>
    </div>
      <div v-for="message in messages">
        <div v-if="message.user_id == myId" class="outgoing_msg">
          <div class="sent_msg">
            <img v-img:group v-if="message.file" width="100%" style="border-radius: 5px;" v-bind:src="'http://localhost:8000/' + message.file" alt="">
            <p v-if="message.text">{{message.text}}</p>
            <span class="time_date">{{ message.created_at | moment("calendar") }}</span> 
          </div>
        </div>
        <div v-if="message.user_id != myId" class="received_msg">
          <div class="received_withd_msg">
            <img v-img v-if="message.file" width="100%" style="border-radius: 5px;" v-bind:src="'http://localhost:8000/' + message.file" alt="">
            <p v-if="message.text">{{message.text}}</p>
            <span class="time_date">{{ message.created_at | moment("calendar") }}</span> 
          </div>
        </div>
      </div>
    </div>
    
    <div v-if="check_msgs" class="row" id="send-form">
    <div class="typing"><p>Печатает...</p></div>
      <form method="post" enctype="multipart/form-data">
        <div class="col-xs-9">
          <div class="wrapper">
            <textarea v-on:keyup.page-down="onPageDown(e)" name="text" v-model="text" rows="4" type="text" placeholder="Сообщение" class="text-msgs form-control text-message regular-input"></textarea>
            <picker 
              v-show="showEmojiPicker"
                  set="apple"
                  title="Pick your emoji…" 
                  emoji="point_up"
                  :style="{ position: 'absolute', bottom: '111px', right: '-143px' }"
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
              <div class="preview" v-if="file">
                <a href="javascript:void(0)" @click="hideFile" style="color: red;"><i class="fas fa-trash-alt"></i></a>
                <img style=" height: 38px;" v-if="isImage" :src="file" />
                <span v-if="isArchive"><i class="fas fa-file-archive"></i></span> <p class="info">{{ name.name }} {{ fileInfo }}</p>
              </div>
              <input type="file" id="file" ref="file" name="file" hidden  v-on:change="addFile"></input>
              <a href="javascript:void(0)"  @click="$refs.file.click()" class="add_file"><i class="fas fa-paperclip"></i></a>
            </div>
          </div>
        <div class="col-xs-3">
          <button type="submit" @click.prevent="Send" class="btn btn-info btn-block">Отправить</button>
        </div>
      </form>
    </div>
    </div>
</div>
</div>
</div>
</template>

<script>

import Pusher from "pusher-js"

export default {

  data(){
    return {
      rooms: [],
      messages: [],
      latest_message: [],
      room_id: '',
      check: false,
      check_msgs: false,
      text: '',
      search: '',
      keywords: null,
      results: [],
      myId: null,
      showEmojiPicker: false,
      file: '',
      fileInfo: '',
      name: '',
      isImage: false,
      isArchive: false
    }
  },

  watch: {
      keywords(after, before) {
          this.SearchRoom();
      }
  },

  mounted(){
    let pusher = new Pusher('cd88d35360765f9ff6e7', {
      cluster: 'eu',
      forceTLS: true
    });
    

    window.Echo.channel('test')
    .listen('MessageSentEvent', (e) => {
         console.log('here');
         console.log(e);
    });

    let currentObj = this;
    currentObj.$Progress.start();
    axios.get(`/get_rooms`)
    .then(function (response) {
        if(response){
            currentObj.rooms = response.data.rooms;
            currentObj.latest_message = response.data.latest_msgs;
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
    hideFile(){
      this.file = undefined;
      this.image = undefined;
      this.name = undefined;
    },
    getFileInfo(file){
      this.fileInfo = Math.round(file.size/1024) +'KB' + ' ' + file.type;
    },
    addFile(e) {
      this.name = e.target.files[0];
      let files = e.target.files || e.dataTransfer.files;
      if(files[0]['type']==='image/jpg' || files[0]['type']==='image/png'|| files[0]['type']==='image/gif'|| files[0]['type']==='image/jpeg'){
        this.isImage = true;
        this.isArchive = false;
      }
      if(files[0]['type']==='application/zip' || files[0]['type']===''){
        this.isArchive = true;
        this.isImage = false;
      }

      if (!files.length){
          return;
      }
      this.createFile(files[0]);
    },
    createFile(file) {
        this.getFileInfo(file);
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
            vm.file = e.target.result;
        };
        reader.readAsDataURL(file);
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

    SearchRoom(){
      let currentObj = this;
      axios.post('/search', {
          name: currentObj.keywords
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
              currentObj.results = response.data.rooms;
          }
      })
      .catch(function (error) {
          if(error){
              currentObj.$Progress.fail();
              console.log(error.response.data);
          }
      })
    },

    scrollToEnd: function() {    	
      let container = this.$el.querySelector("#chatbody");
      container.scrollTop = container.scrollHeight;
    },

    Send(e){
      e.preventDefault();
      let currentObj = this;
      if(this.text || this.file)
      axios.post('/send', {
          text: currentObj.text,
          room_id: currentObj.room_id,
          file: currentObj.file,
          image: currentObj.image
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
              currentObj.messages = response.data.messages;
              currentObj.hideFile();
          }
      }).then(() => {
        currentObj.scrollToEnd();
        currentObj.text = undefined;
      })
      .catch(function (error) {
          if(error){
              console.log(error.response.data);
          }
      })
    },

    getMessages(id){
      this.check_msgs = true;
      this.room_id = id;
      let currentObj = this;
      axios.post('/get_messages', {
          room_id: currentObj.room_id
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
            if(response.data.messages == ''){
              currentObj.check = true;
            }else{
              currentObj.check = false;
            }
              currentObj.messages = response.data.messages;
              currentObj.myId = response.data.myId;
          }
      }).then(() => {
        currentObj.keywords = undefined;
        currentObj.scrollToEnd();
      })
      .catch(function (error) {
          if(error){
              console.log(error.response.data);
          }
      })
    }
  },

  directives: {
    focus: {
      inserted(el) {
        el.focus()
      },
    },
  }
}
</script>

<style scoped>
.chatperson{
  display: block;
  border-bottom: 1px solid #eee;
  width: 100%;
  display: flex;
  align-items: center;
  white-space: nowrap;
  overflow: hidden;
  margin-bottom: 15px;
  padding: 4px;
}
.chatperson:hover{
  text-decoration: none;
  border-bottom: 1px solid #2ca5e0;
  background-color: #e2f4ff;
}
.namechat {
    display: inline-block;
    vertical-align: middle;
}
.chatperson .chatimg img{
  width: 40px;
  height: 40px;
  background-image: url('http://i.imgur.com/JqEuJ6t.png');
}
.chatperson .pname{
  font-size: 18px;
  padding-left: 5px;
}
.chatperson .lastmsg{
  font-size: 12px;
  padding-left: 5px;
  color: #ccc;
}

.col-sm-8 {
  min-height: 250px;
}

.search-rooms{
  margin-bottom: 15px;
}

.text-msgs{
  width: 650px;
  margin-left: 20px;
}

#send-form{
  bottom: 0;
}

.btn-block{
  bottom: 0;
  float: right;
  width: 100px;
}

.chatbody{
  height: 400px;
  overflow-y: auto;
  width: 650px;
}

.rooms{
    height: 500px;
    overflow-y: auto;
}

.text-message{
  max-height: 110px;
  overflow-y: auto;
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
  height: 13rem;
  right: -12rem;
  top: -60px;
  width: 191px;
  overflow-y: auto;
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
  width: 100px;
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

.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 0 0 6px;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.choise{
  width: 295px;
  text-align: center;
  background-color: #81aad1;
  color: white;
  border-radius: 10px;
}

.typing{
  color: #747474;
  background-color: mintcream;
  border-radius: 10px;
  display: block;
  font-size: 12px;
  width: 60px;
  height: 22px;
  text-align: center;
  position: absolute;
  bottom: 150px;
  left: 20px;
}

.typing > p{
  width: 60px;
}

.add_file{
  position: absolute;
  right: 114px;
  margin-top: 5px;
  font-size: 23px;
  opacity: 0.5;
  color: black;
}

.preview{
  position: absolute;
  left: 20px;
  margin-top: 7px;
}

.info{
display: inline-flex;
opacity: 0.5;
color: black;
max-width: 400px;
}
</style>
