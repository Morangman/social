<template>
  
<div class="container">
	<div class="row">
		<div class="col-md-3 ">
		     <div class="list-group ">
              <a href="#" class="list-group-item list-group-item-action active">Настройки</a>
              <a href="#" class="list-group-item list-group-item-action">Персональная информация</a>
          </div> 
		</div>
		<div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Ваш аккаунт</h4>
                        <div style="background-color: green; color: white; border-radius: 10px; text-align: center;" v-if="savedOk"><p>Изменения успешно сохранены</p></div>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
                      <form>
                        <div class="form-group row">
                          <label for="username" class="col-4 col-form-label">Имя*</label> 
                          <div class="col-8">
                            <input id="username" v-model="name" placeholder="Имя" class="form-control here" required="required" type="text">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="text" class="col-4 col-form-label">Ник*</label> 
                          <div class="col-8">
                            <input id="text" v-model="nick" placeholder="Ник" class="form-control here" required="required" type="text">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-4 col-form-label">E-mail*</label> 
                          <div class="col-8">
                            <input id="email" disabled v-model="info.email" placeholder="E-mail" class="form-control here" required="required" type="text">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="phone" class="col-4 col-form-label">Телефон*</label> 
                          <div class="col-8">
                            <input id="phone" v-model="phone" placeholder="Phone" class="form-control here" required="required" type="text">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="publicinfo" class="col-4 col-form-label">Публичная информация</label> 
                          <div class="col-8">
                            <textarea id="publicinfo" v-model="uinfo" cols="40" rows="4" class="form-control"></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="newpass" class="col-4 col-form-label">Изменить пароль</label> 
                          <div class="col-8">
                            <input id="newpass" v-model="password" placeholder="Введите новый пароль" class="form-control here" type="text">
                          </div>
                        </div> 
                        <div class="form-group row">
                          <div class="offset-4 col-8">
                            <button type="submit" @click.prevent="updateProfileInfo" class="btn btn-primary">Сохранить</button>
                            <p><router-link to="/home">Отмена</router-link> </p>
                          </div>
                        </div>
                      </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
	</div>
</div>
</template>

<script>
export default{
  data () {
    return{
      info : [],
      uinfo : '',
      name : '',
      nick : '',
      phone: '',
      password : '',
      savedOk: false
    }
  },

  mounted () {
    let currentObj = this;
    currentObj.$Progress.start();
    axios.get(`/get_user_info`)
    .then(function (response) {
        if(response){
            currentObj.info = response.data.info;
            currentObj.name = response.data.info.name;
            currentObj.nick = response.data.info.nick;
            currentObj.phone = response.data.info.phone;
            currentObj.uinfo = response.data.info.info;
            currentObj.$Progress.finish();
            
            if(response.data.success == false){
                currentObj.$Progress.fail();
                currentObj.$router.push('/login');
            }
        }
    })
  },

  methods: {

    updateProfileInfo(e){
      e.preventDefault();
      let currentObj = this;
      currentObj.$Progress.start();
      axios.post('/update_profile_info', {
        info: this.uinfo,
        nick: this.nick,
        name: this.name,
        phone: this.phone,
        password: this.password,
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
              currentObj.$router.push('/settings');
              currentObj.password = undefined;
              currentObj.savedOk = true;
              currentObj.$Progress.finish();
          }
      }).then(() => {
          currentObj.getInfo();
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

    getInfo() {
      let currentObj = this;
      currentObj.$Progress.start();
      axios.get(`/get_user_info`)
          .then(function (response) {
              if(response){
                  currentObj.info = response.data.info;
                  console.log(currentObj.info);
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