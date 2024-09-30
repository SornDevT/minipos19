<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    //

    public function index(){

        // $store = Store::orderBy("id","asc")->get();
        // return $store;
        $PerPage = \Request::get("perpage");
        $Sort = \Request::get("sort");

         $store = Store::orderBy("id",$Sort)
         ->paginate($PerPage)
         ->toArray();

        return  array_reverse($store);

    }

    public function add(Request $request){

        try { // try ຄືສ່ວນ code ທີ່ເຮັດວຽກ
            
                $store = new Store([
                    'name' => $request->name,
                    'image' => '',
                    'qty' => $request->qty,
                    'price_buy' => $request->price_buy,
                    'price_sell' => $request->price_sell,

                ]);
                $store->save();
                
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
            $store->update([
                "name" => $request->name,
                "qty" => $request->qty,
                "price_buy" => $request->price_buy,
                "price_sell" => $request->price_sell
            ]);
                    
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
            
            $store = Store::find($id);
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
