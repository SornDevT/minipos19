<template lang="">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <input type="text" class=" form-control" v-model="Search" placeholder="ຄົ້ນຫາ....">
                </div>
            </div>
            <PerfectScrollbar>
                <div style="height:61vh">
                    <div class="row">
                        <div class="col-md-3 mb-4" v-for=" item in StoreData.data" key="item">
                            <div class="card h-100 text-center cursor-pointer" @click="AddProduct(item.id)" style="position:relative"> 
                                <span v-for="i in ListOrder">
                                    <span v-if="item.id==i.id" class="list-num"> {{ i.qty }} </span>
                                </span>
                                <span class="no-pro" v-if="item.qty==0">ສິນຄ້າໝົດ</span>
                                <img class="card-img-top pos-img pos-img"  v-if="item.image" :src="url + '/assets/img/'+item.image" alt="Card image cap">
                                <img class="card-img-top pos-img pos-img" v-else :src="url + '/assets/img/no-img.jpg'" alt="Card image cap">

                                <div class="card-body p-1 text-center">
                                    <h5 class="card-title">{{ item.name }}</h5>
                                    <p class="card-text">
                                    {{formatPrice(item.price_sell)}}
                                    </p>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
            </PerfectScrollbar>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3">
                            <label>ຊື່ລູກຄ້າ:</label>
                            <input type="text" v-model="customer_name" class="form-control mb-1" placeholder="...">
                            <label>ເບີໂທ:</label>
                            <input type="text" v-model="customer_tel" class=" form-control mb-1" placeholder="...">
                    </div>
                    <div class=" p-2 bg-info text-white">
                        ລາຍການສັ່ງຊື້
                    </div>
                    <PerfectScrollbar>
                    <div style="height:36vh">
                        <table class="table table-bordered">
                            <tbody>
                            <tr v-for="item in ListOrder" :key="item">
                               <td class="p-1 d-flex">
                                    <img :src="url+'/assets/img/'+item.image" v-if="item.image" class="list-img-order border border-1 shadow p-1">
                                    <img :src="url+'/assets/img/no-img.jpg'" v-else class="list-img-order border border-1 shadow p-1">
                                    <div class="w-100 ms-1 pe-2">
                                        <span>{{ item.name }}</span>
                                        <div class="text-end">{{ item.qty }} x {{formatPrice(item.price)}}</div>
                                        <div class="d-flex justify-content-between">
                                            <span> <i class='bx bxs-plus-circle text-success cursor-pointer' @click="AddProduct(item.id)"></i> | <i class='bx bxs-minus-circle text-warning cursor-pointer' @click="RemoveProduct(item.id)"></i> | <i class='bx bxs-trash text-danger cursor-pointer' @click="DeleteProduct(item.id)"></i></span>
                                            <span>{{ formatPrice(item.qty*item.price) }}</span>
                                        </div>
                                    </div>
                               </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </PerfectScrollbar>
                </div>


                <div class=" p-2 bg-info text-white d-flex justify-content-between">
                    <span> ລວມຍອດເງິນ:</span>
                    <span>{{ formatPrice(TotalAll) }} ກີບ</span>
                       
                    </div>
                    <div class="p-2">
                        <button type="button" class="btn rounded-pill btn-success w-100 " @click="Pay()">ຊຳລະເງິນ</button>
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dialog_pay" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
              <form class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="backDropModalTitle">ການຊຳລະເງິນ</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                        <div class="col-md-6">
                            <div class=" d-flex justify-content-between">
                                <span>ລວມຍອດເງິນ:</span>
                                <span>{{ formatPrice(TotalAll) }} ກີບ</span>
                            </div>
                            <div class=" d-flex justify-content-between text-danger" v-if="(CashAmount-TotalAll)>0">
                                <span>ເງິນທອນ:</span>
                                <span>{{ formatPrice(CashAmount-TotalAll) }} ກີບ</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <label>ຮັບເງິນນຳລູກຄ້າ</label>
                            <cleave :options="options" v-model="CashAmount" class=" form-control text-end" />
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100" @click="AddNum(500)" >500</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(1000)">1,000</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(2000)" >2,000</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(5000)">5,000</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(10000)">10,000</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(20000)" >20,000</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(50000)">50,000</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(100000)" >100,000</button>
                                </div>
                            </div>
                        </div>
                  </div>
                </div>
                <div class="modal-footer">
                  
                  <button type="button" class="btn btn-primary" :disabled="CheckBTPay" @click="ConfirmPay()" >ບັນທຶກ</button>
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ປິດ</button>
                </div>
              </form>
            </div>
          </div>


</template>
<script>
import axios from 'axios';
import { useStore } from '../Store/auth';

export default {
     setup(){
      const store = useStore();
      return { store }
    },
    data() {
        return {
            url: window.location.origin,
            StoreData:[],
            ListOrder:[],
            customer_name:'',
            customer_tel:'',
            Sort:"desc",
            Search:"",
            CashAmount:0,
            options: {
                  numeral: true,
                  numeralPositiveOnly: true,
                  noImmediatePrefix: true,
                  rawValueTrimPrefix: true,
                  numeralIntegerScale: 10,
                  numeralDecimalScale: 2,
                  numeralDecimalMark: '.',
                  delimiter: ','
                }
        }
    },
    computed:{
        CheckBTPay(){
                if(this.CashAmount>=this.TotalAll){
                    return false 
                } else {
                    return true
                }
            },
        TotalAll(){
            let val = this.ListOrder.reduce( (num, item)=> parseInt(num) + ( parseInt(item.qty)*parseInt(item.price) ),0);
            return val;
        }
    },
    methods:{
        async openLink(link){
            const response = await fetch(`${link}`,{ headers:{ Authorization: 'Bearer '+ this.store.get_token}});
            const html = await response.text();
            const blob = new Blob([html],{ type: "text/html"});
            const blobUrl = URL.createObjectURL(blob);
            window.open(blobUrl, "_blank");
        },
        ConfirmPay(){

            axios.post('/api/transection/add',{
                customer_name: this.customer_name,
                customer_tel: this.customer_tel,
                listorder: this.ListOrder
            },{ headers:{ Authorization: 'Bearer '+this.store.get_token } }).then((res)=>{
                if(res.data.success){

                    // ເຄີຍຂໍ້ມູນເກົ່າ
                    this.customer_name='';
                    this.customer_tel = '';
                    this.CashAmount = 0;
                    this.ListOrder = [];
                    this.GetStore()

                    $("#dialog_pay").modal("hide");

                    if(res.data.bill_id){
                        // window.open(window.location.origin+"/api/bills/print/"+res.data.bill_id, "_blank");

                        this.openLink(window.location.origin+"/api/bills/print/"+res.data.bill_id);
                    }

l
                } else {
                    this.$swal({
                                title: res.data.message,
                                icon: "error",
                                showConfirmButton:false,
                                timer: 4500
                            });
                }
            })

        },
        AddNum(num){
            this.CashAmount = parseInt(this.CashAmount?this.CashAmount:0) + parseInt(num) // 1 + 2 = 3

            // ຕົວຢ່າງການຂຽນ if else ແບບຫຍໍ້
            /*
            - ແບບປົກກະຕິ
            if(a=1){
                consol.log(a=1)
            } else {
                consol.log(a=0)
            }

            - ແບບຫຍໍ້
            a=1?a=1:a=0
            
            
            
            */
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        Pay(){

            $("#dialog_pay").modal("show");

        },  
        AddProduct(id){

            let item = this.StoreData.data.find((i)=>i.id == id);
            let old_item = this.ListOrder.find((i)=>i.id == id)

            // ກວດຈຳນວນ
            if(item.qty>0){

                if(old_item){

                    if(item.qty-old_item.qty>0){
                        old_item.qty++;
                    } else {
                        this.$swal({
                                        title:"ບໍ່ສາມາດຂາຍສິນຄ້າໄດ້!",
                                        text:"ສິນຄ້າດັ່ງກ່າວໄດ້ໝົດແລ້ວ!",
                                        showConfirmButton: false,
                                        icon:"error",
                                        timer:3500
                                    });
                    }

                    
                } else {
                    this.ListOrder.push({
                        id: item.id,
                        name: item.name,
                        image: item.image,
                        price: item.price_sell,
                        qty: 1
                    })
                }


            } else {
                this.$swal({
                                        title:"ບໍ່ສາມາດຂາຍສິນຄ້າໄດ້!",
                                        text:"ສິນຄ້າດັ່ງກ່າວໄດ້ໝົດແລ້ວ!",
                                        showConfirmButton: false,
                                        icon:"error",
                                        timer:3500
                                    });
            }

           
            

        },
        RemoveProduct(id){
            let item = this.ListOrder.find((i)=>i.id == id);
            if(item){
                item.qty--;
                if(item.qty<1){
                    this.ListOrder.splice(this.ListOrder.map((i)=>i.id).indexOf(id),1);
                }
            }
        },
        DeleteProduct(id){
            this.ListOrder.splice(this.ListOrder.map((i)=>i.id).indexOf(id),1);
        },
        GetStore(page){
            axios.get(`api/store?page=${page}perpage=${this.PerPage}&sort=${this.Sort}&&search=${this.Search}`,{ headers:{ Authorization: 'Bearer '+this.store.get_token } }).then((res)=>{

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

            this.GetStore()

    }
}
</script>
<style scoped>
    .list-img-order{
        width: 60px;
        height: 60px;
        object-fit: cover;
        object-position: center;
        border-radius: 5px;
    }
    .pos-img{
        width: 100%;
        object-fit: cover;
        object-position: center;
        height: 80px;
    }

    .list-num{
        position: absolute;
        top: 0px;
        right: 0px;
        background-color: blueviolet;
        color: white;
        padding: 5px;
        border-radius: 0px 5px 0px 5px;
    }
    .no-pro{
        position: absolute;
    width: 100%;
    background-color: #ff000087;
    color: white;
    top: 58px;
    }
</style>