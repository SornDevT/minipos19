<template lang="">
    <div class="card">
  <h5 class="card-header">ລາຍການ ສະຕ໋ອກສິນຄ້າ</h5>
  <div class="card-body">

    <div v-if="ShowForm">
        {{FormStore}}
        <div class="row">
            <div class="col-md-4">Image</div>
            <div class="col-md-8">

        <div class=" d-flex justify-content-end">
            <button type="button" class="btn rounded-pill btn-success me-2" :disabled="CheckForm" @click="SaveStore()" >ບັນທຶກ</button>
            <button type="button" class="btn rounded-pill btn-danger" @click="CancelStore()" >ຍົກເລີກ</button>
        </div>

        <div class="mb-2">
            <label  class="form-label fs-6">ຊື່ສິນຄ້າ:</label>
            <input type="text" class="form-control" v-model="FormStore.name" placeholder="...." >
        </div>

        <div class="mb-2">
            <label  class="form-label fs-6">ຈຳນວນ:</label>
            <input type="text" class="form-control" v-model="FormStore.qty" placeholder="...." >
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div>
                    <label  class="form-label fs-6">ລາຄາຊື້:</label>
                    <input type="text" class="form-control" v-model="FormStore.price_buy" placeholder="...." >
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <label  class="form-label fs-6">ລາຄາຂາຍ:</label>
                    <input type="text" class="form-control" v-model="FormStore.price_sell" placeholder="...." >
                </div>
            </div>
        </div>


            </div>
        </div>
    </div>

    <div class="table-responsive text-nowrap" v-if="!ShowForm">

    <div class=" d-flex justify-content-between mb-2 ">
        <div class=" d-flex align-items-center">
            <i class='bx bx-sort-down fs-4'></i>

            <select class="form-select ms-2" >
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
        </div>
        <div class=" d-flex">

            <div class="input-group me-2">
            <input type="text" class="form-control" placeholder="ຄົ້ນຫາ..." aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary px-2" type="button" id="button-addon2"><i class='bx bx-search-alt fs-5'></i></button>
            </div>

            <button type="button" class="btn rounded-pill btn-info" @click="AddStore()">ເພີ່ມໃໝ່</button>

        </div>
    </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>ຮູບ</th>
            <th>ຊື່ສິນຄ້າ</th>
            <th>ຈຳນວນ</th>
            <th>ລາຄາຊື້</th>
            <th>ຈັດການ</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>11</td>
            <td>11</td>
            <td>11</td>
            <td>11</td>
            <td>2222</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item text-info" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> ແກ້ໄຂ</a>
                  <a class="dropdown-item text-danger " href="javascript:void(0);"><i class="bx bx-trash me-1"></i> ລຶບ</a>
                </div>
              </div>
            </td>
          </tr>
          
          
        </tbody>
      </table>
    </div>
  </div>
</div>
</template>
<script>
import { useStore } from '../Store/auth';
import axios from 'axios';
export default {
    setup(){
      const store = useStore();
      return { store }
    },
    data() {
        return {
            ShowForm:false,
            FormType:true,
            EditID:'',
            FormStore:{
                name:'',
                image:'',
                qty:'',
                price_buy:'',
                price_sell:''
            }
        }
    },
    computed:{
        CheckForm(){
            if(this.FormStore.name == '' || this.FormStore.qty == '' || this.FormStore.price_buy =='' || this.FormStore.price_sell == ''){
                return true;
            } else {
                return false;
            }
        }
    },
    methods:{
        AddStore(){
            this.ShowForm = true;
            this.FormType = true;
        },
        CancelStore(){
            this.ShowForm = false;
        },
        EditStore(id){
            this.EditID = id;
            this.FormType = false;
        },
        SaveStore(){
            if(this.FormType){
                // ເພີ່ມຂໍ້ມູນໃໝ່

                axios.post('api/store/add',this.FormStore).then((res)=>{

                    if(res.data.success){
                        console.log(res);
                        // ເຄຍຂໍ້ມູນໃນ Form
                        this.FormStore.name = '';
                        this.FormStore.image = '';
                        this.FormStore.qty = '';
                        this.FormStore.price_buy = '';
                        this.FormStore.price_sell = '';

                        this.ShowForm = false;


                    } else {

                    }

                }).catch((error)=>{
                    console.log(error);
                })

            } else {
                // ອັບເດດຂໍ້ມູນ
            }
        }
    }
}
</script>
<style lang="">
    
</style>