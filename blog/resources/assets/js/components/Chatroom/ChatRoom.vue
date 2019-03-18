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
  margin: 8px 0 0;
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


</style>
<template>
<div class="content-home">
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
                <li class="nav-item"><router-link class="nav-link" to="/chat">Сообщение</router-link></li>
            </ul>
        </div>
    </nav>
<div class="container">
	<div class="row">
    <div class="rooms col-sm-4">
    <input class="search-rooms form-control" name="title" placeholder="Поиск..."></input>
      <a href="javascript:void(0)" class="chatperson" v-for="room in rooms" @click="getMessages(room.room_id)">
        <div class="namechat">
            <div class="pname">{{room.room_id}}</div>
            <div class="lastmsg">{{latest_message.text}}</div>
        </div>
      </a>
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
            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>{{message.text}}</p>
                <span class="time_date">{{ message.created_at | moment("calendar") }}</span> 
              </div>
            </div>

              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>Test which is a new approach to have all
                    solutions</p>
                  <span class="time_date"> 11:01 AM    |    June 9</span></div>
              </div>

      </div>
    </div>

    <div v-if="check_msgs" class="row" id="send-form">
      <form>
      <div class="col-xs-9">
      <div class="wrapper">
        <textarea v-on:keyup.page-down="onPageDown(e)"  name="text" v-model="text" rows="4" type="text" placeholder="Сообщение" class="text-msgs form-control text-message regular-input"></textarea>
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
      <div class="col-xs-3">
        <button type="submit" @click="Send" class="btn btn-info btn-block">Отправить</button>
      </div>
      </form>
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

  data(){
    return {
      rooms: [],
      messages: [],
      latest_message: [],
      room_id: '',
      check: false,
      check_msgs: false,
      text: '',
      search: ''
    }
  },
  mounted(){
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

    scrollToEnd: function() {    	
      let container = this.$el.querySelector("#chatbody");
      container.scrollTop = container.scrollHeight;
      console.log("END");
    },

    Send(){
      let currentObj = this;
      currentObj.$Progress.start();
          axios.post('/send', {
              text: currentObj.text,
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
                  currentObj.$router.push('/chat/'.currentObj.room_id);
                 // currentObj.messages = response.data.messages;
                  currentObj.$Progress.finish();
              }
          })
          .catch(function (error) {
              if(error){
                  currentObj.$Progress.fail();
                  console.log(error.response.data);
              }
          })
    },

    getMessages(id){
      this.check_msgs = true;
      this.room_id = id;
      let currentObj = this;
      currentObj.$Progress.start();
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

                  currentObj.$Progress.finish();
              }
          }).then(() => {
            currentObj.scrollToEnd();
                })
          .catch(function (error) {
              if(error){
                  currentObj.$Progress.fail();
                  console.log(error.response.data);
              }
          })
    }
  }
}
</script>
