<template lang="">
    <div class="row d-flex justify-content-center">
        <div class="authentication-wrapper authentication-basic container-p-y col-md-4">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">


</span>
              <span class="app-brand-text demo text-heading fw-bold">sneat</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">MiniPos 19! 👋</h4>
          <p class="mb-6">ສະບາຍດີ</p>

          
            <div class="mb-6 fv-plugins-icon-container">
          
              <label for="email" class="form-label">ອີເມວລ໌:</label>
              <input type="text" class="form-control" v-model="email" id="email" name="email-username" placeholder="...." >

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
            <div class="mb-6 form-password-toggle fv-plugins-icon-container">
              <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
              <div class="input-group input-group-merge has-validation">
                <input type="password" id="password" v-model="password" class="form-control" name="password" placeholder="············" >
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
            <div class="mb-8"> 
              <div class="d-flex justify-content-between mt-8">
                <div class="form-check mb-0 ms-2">
                  <input class="form-check-input" type="checkbox" v-model="remember_me" id="remember-me">
                  <label class="form-check-label" for="remember-me">
                    ຈື່ຂ້ອຍໄວ້ໃນລະບົບ
                  </label>
                </div>
             
              </div>
            </div>
            <div class="mb-6">
              <button class="btn btn-info d-grid w-100" :disabled="CheckBT" @click="Login()">ເຂົ້າສູ່ລະບົບ</button>
            </div>
            <div class="alert alert-warning" v-if="text_error" role="alert">
                  {{ text_error }}
                </div>

          <p class="text-center">
            <span>ບໍ່ມີບັນຊີຜູ້ໃຊ້?</span>
            <router-link to="/register">
              <span>ລົງທະບຽນ</span>
            </router-link>
          </p>

         
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
      return {
        email:'',
        password:'',
        remember_me: false,
        text_error:''
      }
    },
    computed:{
        CheckBT(){
            if(this.email != '' && this.password !=''){
              return false;
            } else {
              return true;
            }
        }
    },
    mounted(){
      // console.log(this.$route.query.email)
      this.email = this.$route.query.email 
    },
    methods:{
      Login(){  
          if(this.email != '' && this.password !=''){
              axios.post('api/login',{
                login_email: this.email,
                login_password: this.password,
                login_remeber_me: this.remember_me
              }).then((res)=>{
                  if(res.data.success){
                    this.text_error = '';
                    // console.log(res);

                    localStorage.setItem('web_token',res.data.token);
                    localStorage.setItem('web_user',JSON.stringify(res.data.user_data));

                    this.email = ''
                    this.password = ''

                    // go to root path
                    this.$router.push('/');


                  } else {
                    this.text_error = res.data.message;
                  }
              })
          }
      }
    }
}
</script>
<style lang="">
    
</style>