<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Transection;

class StoreController extends Controller
{
    //

    public function index(){

        // $store = Store::orderBy("id","asc")->get();
        // return $store;
        $PerPage = \Request::get("perpage");
        $Sort = \Request::get("sort");
        $Search = \Request::get("search");

         $store = Store::orderBy("id",$Sort)
         ->where(
            function($query) use ($Search){
                $query->where("name","LIKE","%{$Search}%")
                ->orWhere("price_buy","LIKE","%{$Search}%");
            }
         )
         ->paginate($PerPage)
         ->toArray();

        return  array_reverse($store);

    }

    public function add(Request $request){

        try { // try ຄືສ່ວນ code ທີ່ເຮັດວຽກ

            // ກຳນົດ path ເສັ້ນທາງອັບໂຫຼດຮູບ
            $upload_path = "assets/img"; 

            if($request->file('image')){

                // gen ຊື່ຮູບພາບໃໝ່
                $new_name_img = time().".".$request->image->getClientOriginalExtension();

                // ອັບໂຫຼດ
                $request->image->move(public_path($upload_path),$new_name_img);

            } else {
                $new_name_img = '';
            }
            
                $store = new Store([
                    'name' => $request->name,
                    'image' => $new_name_img,
                    'qty' => $request->qty,
                    'price_buy' => $request->price_buy,
                    'price_sell' => $request->price_sell,

                ]);
                $store->save();
                $product_id = $store->id;

                // 

                
                $number='';
                $read_tran = Transection::all()->sortByDesc('id')->take(1)->toArray();
                foreach($read_tran as $new){
                    $number = $new['tran_id'];
                }
    
                if($number!=''){
                    $number1 = str_replace("INC","",$number); // INC00001 = 00001 
                    $number2 = str_replace("EXP","",$number1);
                    $number3 = (int)$number2+1; // 1+1 = 2
                    $length = 5;
                    $number = substr(str_repeat(0,$length).$number3, - $length); //00002
                } else {
                    $number3 = 1;
                    $length = 5;
                    $number = substr(str_repeat(0,$length).$number3, - $length); //00001
                }

                $tran = new Transection([
                    "tran_id" => "EXP".$number, // date(ymds).rand(1000,9999)
                    "tran_type" => "expense",
                    "product_id"=> $product_id,
                    "qty"=> $request->qty,
                    "price"=>  $request->price_buy*$request->qty,
                    "detail"=> "ນຳເຂົ້າສິນຄ້າ ".$request->name
                ]);
                $tran->save();

                
                $success = true;
                $message = 'ບັນທຶກຂໍ້ມູນ ສຳເລັດ';
        
        } catch (\Illuminate\Database\QueryException $ex) { // catch ເປັນສ່ວນທີ່ ນຳເອົາ error ທີ່ເກີດຈາກ try ມາສະແດງຜົນ
            //throw $th;
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);

    }

    public function edit($id){
        $store = Store::find($id);
        return $store;
    }

    public function update($id,Request $request){
        try { // try ຄືສ່ວນ code ທີ່ເຮັດວຽກ
            

            $store = Store::find($id);

             // ກຳນົດ path ເສັ້ນທາງອັບໂຫຼດຮູບ
             $upload_path = "assets/img"; 

             if($request->file('image')){

                // ກວດໄຟລ໌ ຮູບເກົ່າ ຖ້າມີໃຫ້ລຶບ
                if($store->image){
                    if(file_exists($upload_path."/".$store->image)){
                        unlink($upload_path."/".$store->image);
                    }
                }

                // gen ຊື່ຮູບພາບໃໝ່
                $new_name_img = time().".".$request->image->getClientOriginalExtension();

                // ອັບໂຫຼດ
                $request->image->move(public_path($upload_path),$new_name_img);

                // ອັບເດດຂໍ້ມູນມູນ
                $store->update([
                    "name" => $request->name,
                    "image" => $new_name_img,
                    "qty" => $request->qty,
                    "price_buy" => $request->price_buy,
                    "price_sell" => $request->price_sell
                ]);

            } else {
                
                if($request->image){
                    // ອັບເດດຂໍ້ມູນມູນ
                    $store->update([
                        "name" => $request->name,
                        // "image" => $new_name_img,
                        "qty" => $request->qty,
                        "price_buy" => $request->price_buy,
                        "price_sell" => $request->price_sell
                    ]);
                } else {

                    // ກວດໄຟລ໌ ຮູບເກົ່າ ຖ້າມີໃຫ້ລຶບ
                    if($store->image){
                        if(file_exists($upload_path."/".$store->image)){
                            unlink($upload_path."/".$store->image);
                        }
                    }
                    // ອັບເດດຂໍ້ມູນມູນ
                    $store->update([
                        "name" => $request->name,
                        "image" => '',
                        "qty" => $request->qty,
                        "price_buy" => $request->price_buy,
                        "price_sell" => $request->price_sell
                    ]);


                }

            }
            



            


                    
                    $success = true;
                    $message = 'ອັບເດດຂໍ້ມູນ ສຳເລັດ';
            
            } catch (\Illuminate\Database\QueryException $ex) { // catch ເປັນສ່ວນທີ່ ນຳເອົາ error ທີ່ເກີດຈາກ try ມາສະແດງຜົນ
                //throw $th;
                $success = false;
                $message = $ex->getMessage();
            }

            $response = [
                'success' => $success,
                'message' => $message
            ];

            return response()->json($response);
    }

    public function detele($id){
        try { // try ຄືສ່ວນ code ທີ່ເຮັດວຽກ
            
            // ກຳນົດ path ເສັ້ນທາງອັບໂຫຼດຮູບ
            $upload_path = "assets/img"; 

            $store = Store::find($id);
            if($store->image){
                if(file_exists($upload_path."/".$store->image)){
                    unlink($upload_path."/".$store->image);
                }
            }



            $store->delete();

            
                    
                    $success = true;
                    $message = 'ລຶບຂໍ້ມູນ ສຳເລັດ';
            
            } catch (\Illuminate\Database\QueryException $ex) { // catch ເປັນສ່ວນທີ່ ນຳເອົາ error ທີ່ເກີດຈາກ try ມາສະແດງຜົນ
                //throw $th;
                $success = false;
                $message = $ex->getMessage();
            }

            $response = [
                'success' => $success,
                'message' => $message
            ];

            return response()->json($response);
    }
}
