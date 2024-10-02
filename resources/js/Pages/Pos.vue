<template lang="">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <input type="text" class=" form-control" placeholder="ຄົ້ນຫາ....">
                </div>
            </div>
            <PerfectScrollbar>
                <div style="height:61vh">
                    <div class="row">
                        <div class="col-md-3 mb-4" v-for=" item in 40" :key="item">
                            <div class="card h-100">
                                <img class="card-img-top" :src="url + '/assets/img/no-img.jpg'" alt="Card image cap">
                                <div class="card-body p-1 text-center">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">
                                    120,000 kip
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
                            <input type="text" class=" form-control mb-1" placeholder="...">
                            <label>ເບີໂທ:</label>
                            <input type="text" class=" form-control mb-1" placeholder="...">
                    </div>
                    <div class=" p-2 bg-info text-white">
                        ລາຍການສັ່ງຊື້
                    </div>
                    <PerfectScrollbar>
                    <div style="height:36vh">
                        <table class="table table-bordered">
                            <tbody>
                            <tr v-for="item in 15" :key="item">
                               <td class="p-1 d-flex">
                                    <img :src="url+'/assets/img/pd.jpg'" class="list-img-order">
                                    <div class="w-100 ms-1">
                                        <span>ຊື່ສິນຄ້າ</span>
                                        <div class="text-end">2 x 25,000</div>
                                        <div class="d-flex justify-content-between">
                                            <span>+ | - | x</span>
                                            <span>50,000</span>
                                        </div>
                                    </div>
                               </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </PerfectScrollbar>
                </div>


                <div class=" p-2 bg-info text-white">
                        ລວມຍອດເງິນ:
                    </div>
                    <div class="p-2">
                        <button type="button" class="btn rounded-pill btn-success w-100 ">ຊຳລະເງິນ</button>
                    </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            url: window.location.origin
        }
    },
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
</style>