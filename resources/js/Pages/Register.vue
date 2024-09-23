<template lang="">
    <div class="row d-flex justify-content-center">
        <div class="authentication-wrapper authentication-basic container-p-y col-md-4">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
       
          <!-- /Logo -->
          <h4 class="mb-1">ລົງທະບຽນ ບັນຊີໃໝ່</h4>
            <!-- {{ user_name }} -->
            <div class="mb-6 fv-plugins-icon-container">
                <label for="email" class="form-label">ຊື່ຜູ້ໃຊ້:</label>
              <input type="text" v-model="user_name" class="form-control"  id="email" name="email-username" placeholder="...." >

              
            </div>
            <div class="mb-6 fv-plugins-icon-container">
               
              <label for="email" class="form-label">ອີເມວລ໌:</label>
              <input type="text" class="form-control" id="email" v-model="user_email" name="email-username" placeholder="...." >

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                <div class="mb-6 form-password-toggle fv-plugins-icon-container">
                <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
                <div class="input-group input-group-merge has-validation">
                    <input type="password" id="password" v-model="password" class="form-control" name="password" placeholder="············" >
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div class="mb-6 form-password-toggle fv-plugins-icon-container">
                <label class="form-label" for="password">ຍືນຍັນລະຫັດຜ່ານ:</label>
                <div class="input-group input-group-merge has-validation">
                    <input type="password" id="password" v-model="password2" class="form-control" name="password" placeholder="············" >
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
           
                <div class="alert alert-warning" v-if="text_error" role="alert">
                  {{ text_error }}
                </div>

            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" @click="Register()" type="submit">ລົງທະບຽນ</button>
            </div>
          <input type="hidden">

          <p class="text-center">
            <span>ມີບັນຊີຜູ້ໃຊ້?</span>
            <router-link to="/login">
              <span>ເຂົ້າສູ່ລະບົບ</span>
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
        user_name:'',
        user_email:'',
        password:'',
        password2:'',
        text_error:''
      }
    },
    methods:{
      Register(){
          // console.log('register bt')
          if(this.user_name == '' ||  this.user_email == '' || this.password == '' || this.password2 == ''){
            this.text_error = 'ກະລຸນາປ້ອນຂໍ້ມູນ ໃຫ້ຄົບຖ້ວນ!';
          } else {

            if(this.password == this.password2){
              this.text_error = '';

              axios.post('api/register',{
                form_user_name: this.user_name,
                form_user_email: this.user_email,
                form_password: this.password
              }).then((res)=>{

                console.log(res);

                if(res.data.success){

              

                  // router go to login page
                  // this.$router.push('/login');

                  // ສົ່ງຂໍ້ມູນໄປພ້ອມ
                  this.$router.push({ path:'/login', query:{ email: this.user_email } });

                  this.text_error = '';
                  this.user_name = '';
                  this.user_email = '';
                  this.password = '';
                  this.password2 = '';

                } else {
                  this.text_error = res.data.message;
                }

              }).catch((error)=>{
                console.log(error);
              })

            } else {
              this.text_error = 'ລະຫັດຜ່ານບໍ່ກົງກັນ!';
            }

            

          }
      }
    }
}
</script>
<style lang="">
    
</style>