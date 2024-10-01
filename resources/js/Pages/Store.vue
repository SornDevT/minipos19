<template lang="">
    <div class="card">
  <h5 class="card-header">ລາຍການ ສະຕ໋ອກສິນຄ້າ</h5>
  <div class="card-body">

    <div v-if="ShowForm">
        {{FormStore}}
        <div class=" d-flex justify-content-end">
            <button type="button" class="btn rounded-pill btn-success me-2" :disabled="CheckForm" @click="SaveStore()" >ບັນທຶກ</button>
            <button type="button" class="btn rounded-pill btn-danger" @click="CancelStore()" >ຍົກເລີກ</button>
        </div>
        <div class="row">
            <div class="col-md-4 text-center">

                <img :src="Image_preview" @click="$refs.img_store.click()" class=" cursor-pointer"  style=" width:70%; ">


                <input type="file" ref="img_store" style=" display:none;" @change="onSelect($event)" >

            </div>
            <div class="col-md-8">

      

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
            <div class=" d-flex align-items-center cursor-pointer" @click="ChangeSort()">
                <i class='bx bx-sort-up fs-4' v-if="Sort=='asc'"></i>
                <i class='bx bx-sort-down fs-4' v-if="Sort=='desc'"></i>
            </div>

            <select v-model="PerPage" class="form-select ms-2" @change="GetStore(1)" >
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
        </div>
        <div class=" d-flex">

            <div class="input-group me-2">
            <input type="text" class="form-control" placeholder="ຄົ້ນຫາ..." v-model="Search" @keyup.enter="GetStore(1)" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary px-2" type="button" id="button-addon2" @click="GetStore(1)"><i class='bx bx-search-alt fs-5'></i></button>
            </div>

            <button type="button" class="btn rounded-pill btn-info" @click="AddStore()">ເພີ່ມໃໝ່</button>

        </div>
    </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th width="80">ID</th>
            <th width="120">ຮູບ</th>
            <th>ຊື່ສິນຄ້າ</th>
            <th>ຈຳນວນ</th>
            <th>ລາຄາຊື້</th>
            <th>ຈັດການ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in StoreData.data" :key="item.id">
            <td>{{item.id}}</td>
            <td> 
                <img :src="url + '/assets/img/'+item.image" v-if="item.image" class="img-list-store shadow" >
                <img :src="url + '/assets/img/no-img.jpg'" v-else class="img-list-store shadow" >
            </td>
            <td>{{ item.name }}</td>
            <td>{{ item.qty }}</td>
            <td>{{ item.price_buy }}</td>
            <td>
                <!-- <i class='bx bx-edit-alt fs-4 text-info cursor-pointer' @click="EditStore(item.id)" ></i>  | <i class='bx bx-message-square-x fs-4 text-danger cursor-pointer' @click="DelStore(item.id)"></i> -->
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item text-info" href="javascript:void(0);" @click="EditStore(item.id)" ><i class="bx bx-edit-alt me-1"></i> ແກ້ໄຂ</a>
                  <a class="dropdown-item text-danger " href="javascript:void(0);" @click="DelStore(item.id)"><i class="bx bx-trash me-1"></i> ລຶບ</a>
                </div>
              </div>
            </td>
          </tr>
          
          
        </tbody>
      </table>

      <button @click="showAlert">Hello world</button>

      <Pagination :pagination="StoreData" :offset="4" @paginate="GetStore($event)" />

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
            url: window.location.origin,
            Image_preview: window.location.origin + '/assets/img/upload-img.png',
            ShowForm:false,
            FormType:true,
            EditID:'',
            FormStore:{
                name:'',
                image:'',
                qty:'',
                price_buy:'',
                price_sell:''
            },
            StoreData:[],
            PerPage:5,
            Sort:"desc",
            Search:"",
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
        showAlert() {
      // Use sweetalert2
      this.$swal({
                                position: 'top-end',
                                toast:true,
                                title: 'aaaaaa',
                                icon: "success",
                                showConfirmButton:false,
                                timer: 2500
                            });
    },
    onSelect(event){
        // console.log(event);
            this.FormStore.image = event.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(this.FormStore.image);
            reader.addEventListener("load", function(){
                this.Image_preview = reader.result
            }.bind(this,false));
    },
        ChangeSort(){
            if(this.Sort=='asc'){
                this.Sort = 'desc';
            } else {
                this.Sort = 'asc';
            }
            this.GetStore();
        },
        AddStore(){
            this.ShowForm = true;
            this.FormType = true;
            this.Image_preview = window.location.origin + '/assets/img/upload-img.png';
        },
        CancelStore(){
            this.ShowForm = false;
        },
        EditStore(id){
            this.EditID = id;
            this.FormType = false;
            

            axios.get(`api/store/edit/${id}`,{ headers:{ Authorization: 'Bearer '+this.store.get_token } }).then((res)=>{
                this.FormStore = res.data;

                if(res.data.image){
                    this.Image_preview = this.url + "/assets/img/" + res.data.image;
                } else {
                    this.Image_preview = this.url + '/assets/img/upload-img.png';
                }

                this.ShowForm = true;
            }).catch((error)=>{
                console.log(error);
                if(error.response.status == 401){
                    // ເຄຼຍຂໍ້ມູນໃນ localstorage
                    localStorage.removeItem("web_token");
                    localStorage.removeItem("web_user");
                    // ເຄຼຍ Token ແລະ user ໃນ pinia
                    this.store.remove_token();
                    this.store.remove_user();
                    this.$router.push("/login");
                }
            });
        },
        DelStore(id){


            this.$swal(
                {
                    title: "ທ່ານແນ່ໃຈບໍ່?",
                    text: "ທີ່ຈະລຶບຂໍ້ມູນນີ້!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ຕົກລົງ!",
                    cancelButtonText:"ຍົກເລີກ"
                    }).then((result) => {
                    if (result.isConfirmed) {

                        axios.delete(`api/store/delete/${id}`,{ headers:{ Authorization: 'Bearer '+this.store.get_token } }).then((res)=>{

                            if(res.data.success){
                                this.GetStore();
                                this.$swal({
                                    title: "ການລຶບຂໍ້ມູນ!",
                                    text: res.data.message,
                                    showConfirmButton:false,
                                    icon: "success",
                                    timer: 3500
                                });

                            } else {

                            this.$swal({
                                title: res.data.message,
                                icon: "error",
                                showConfirmButton:false,
                                timer: 4500
                            });

                            }

                        }).catch((error)=>{
                            console.log(error);
                            if(error.response.status == 401){
                                // ເຄຼຍຂໍ້ມູນໃນ localstorage
                                localStorage.removeItem("web_token");
                                localStorage.removeItem("web_user");
                                // ເຄຼຍ Token ແລະ user ໃນ pinia
                                this.store.remove_token();
                                this.store.remove_user();
                                this.$router.push("/login");
                                }
                        });

                                
                            }
                    }
            );

                
        },
        SaveStore(){
            if(this.FormType){
                // ເພີ່ມຂໍ້ມູນໃໝ່

                axios.post('api/store/add',this.FormStore,{ headers:{ "Content-Type":"multipart/form-data", Authorization: 'Bearer '+this.store.get_token } }).then((res)=>{

                    if(res.data.success){
                        console.log(res);
                        // ເຄຍຂໍ້ມູນໃນ Form
                        this.FormStore.name = '';
                        this.FormStore.image = '';
                        this.FormStore.qty = '';
                        this.FormStore.price_buy = '';
                        this.FormStore.price_sell = '';

                        this.ShowForm = false;

                        this.GetStore();

                        this.$swal({
                                position: 'top-end',
                                toast:true,
                                title: res.data.message,
                                icon: "success",
                                showConfirmButton:false,
                                timer: 2500
                            });

                    } else {
                        this.$swal({
                                title: res.data.message,
                                icon: "error",
                                showConfirmButton:false,
                                timer: 4500
                            });
                    }

                }).catch((error)=>{
                    console.log(error);

                    if(error.response.status == 401){
                        // ເຄຼຍຂໍ້ມູນໃນ localstorage
                        localStorage.removeItem("web_token");
                        localStorage.removeItem("web_user");
                        // ເຄຼຍ Token ແລະ user ໃນ pinia
                        this.store.remove_token();
                        this.store.remove_user();
                        this.$router.push("/login");
                        }
                })

            } else {
                // ອັບເດດຂໍ້ມູນ
                axios.post(`api/store/update/${this.EditID}`,this.FormStore,{ headers:{ "Content-Type":"multipart/form-data", Authorization: 'Bearer '+this.store.get_token } }).then((res)=>{

                    if(res.data.success){
                         // ເຄຍຂໍ້ມູນໃນ Form
                        this.FormStore.name = '';
                        this.FormStore.image = '';
                        this.FormStore.qty = '';
                        this.FormStore.price_buy = '';
                        this.FormStore.price_sell = '';

                        this.ShowForm = false;
                        // ອັບເດດ ຕາຕະລາງ
                        this.GetStore();
                        this.$swal({
                                position: 'top-end',
                                toast:true,
                                title: res.data.message,
                                icon: "success",
                                showConfirmButton:false,
                                timer: 2500
                            });
                    } else {
                        this.$swal({
                                title: res.data.message,
                                icon: "error",
                                showConfirmButton:false,
                                timer: 4500
                            });
                    }

                }).catch((error)=>{
                    console.log(error);

                    if(error.response.status == 401){
                        // ເຄຼຍຂໍ້ມູນໃນ localstorage
                        localStorage.removeItem("web_token");
                        localStorage.removeItem("web_user");
                        // ເຄຼຍ Token ແລະ user ໃນ pinia
                        this.store.remove_token();
                        this.store.remove_user();
                        this.$router.push("/login");
                        }
                })
            }
        },
        GetStore(page){
            axios.get(`api/store?page=${page}&perpage=${this.PerPage}&sort=${this.Sort}&search=${this.Search}`,{ headers:{ Authorization: 'Bearer '+this.store.get_token } }).then((res)=>{

                this.StoreData = res.data;

            }).catch((error)=>{

                if(error.response.status == 401){

                    // ເຄຼຍຂໍ້ມູນໃນ localstorage
                    localStorage.removeItem("web_token");
                    localStorage.removeItem("web_user");

                    // ເຄຼຍ Token ແລະ user ໃນ pinia
                    this.store.remove_token();
                    this.store.remove_user();

                    this.$router.push("/login");
                    }

            });
        }   
    },
    created(){
        this.GetStore();
    },
    watch:{
        Search(){
            if(this.Search == ''){
                this.GetStore()
            }
        }
    }
}
</script>
<style scoped>
    .img-list-store{
        width: 80px;
        border-radius: 5px;
        border: 2px #ffffff solid;
    }
</style>