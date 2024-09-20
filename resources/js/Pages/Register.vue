<template lang="">
    <div class="row d-flex justify-content-center">
        <div class="authentication-wrapper authentication-basic container-p-y col-md-4">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
       
          <!-- /Logo -->
          <h4 class="mb-1">ລົງທະບຽນ ບັນຊີໃໝ່</h4>

            <div class="mb-6 fv-plugins-icon-container">
                <label for="email" class="form-label">ຊື່ຜູ້ໃຊ້:</label>
              <input type="text" class="form-control" id="email" name="email-username" placeholder="...." >

              
            </div>
            <div class="mb-6 fv-plugins-icon-container">
               
              <label for="email" class="form-label">ອີເມວລ໌:</label>
              <input type="text" class="form-control" id="email" name="email-username" placeholder="...." >

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                <div class="mb-6 form-password-toggle fv-plugins-icon-container">
                <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
                <div class="input-group input-group-merge has-validation">
                    <input type="password" id="password" class="form-control" name="password" placeholder="············" >
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div class="mb-6 form-password-toggle fv-plugins-icon-container">
                <label class="form-label" for="password">ຍືນຍັນລະຫັດຜ່ານ:</label>
                <div class="input-group input-group-merge has-validation">
                    <input type="password" id="password" class="form-control" name="password" placeholder="············" >
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
           
            
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" type="submit">ລົງທະບຽນ</button>
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
export default {
    
}
</script>
<style lang="">
    
</style>