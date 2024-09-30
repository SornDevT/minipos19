<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use JWTAuth;

class UserController extends Controller
{
    //

    public function register(Request $request){

        try { // try ຄືສ່ວນ code ທີ່ເຮັດວຽກ
            
            $check_email = User::where('email',$request->form_user_email);

            if($check_email->count()){
                $success = false;
                $message = 'ອີເມວລ໌ນີ້:'.$request->form_user_email.' ໄດ້ຖຶກລົງທະບຽນແລ້ວ!';
            } else {
                $user = new User([
                    'name' => $request->form_user_name,
                    'email' => $request->form_user_email,
                    'password' => hash::make($request->form_password)
                ]);
                $user->save();
                
                $success = true;
                $message = 'ລົງທະບຽນສຳເລັດ';
            }

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


    public function login(Request $request){

        $user_login = [
            'email' => $request->login_email,
            'password' => $request->login_password
        ];
        
        if($request->login_remember_me == 'true'){
            JWTAuth::factory()->setTTL(43200); // 60 = 1h, 1month
        } 

       
        $token = JWTAuth::attempt($user_login);
        $user_data = Auth::user();

        if($token){

            $response = [
                'success' => true,
                'message' => 'ສຳເລັດ',
                'user_data' => $user_data,
                'token' => $token
            ];
    
            return response()->json($response);

        } else {

            $response = [
                'success' => false,
                'message' => 'ອີເມວລ໌ ຫຼື ລະຫັດຜ່ານບໍ່ຖຶກຕ້ອງ!'
            ];
    
            return response()->json($response);

        }

    }


    public function logout(){

        $token = JWTAuth::getToken();
        $invalidate = JWTAuth::invalidate($token);

        if($invalidate){
            $response = [
                'success' => true,
                'message' => 'ອອກຈາກລະບົບສຳເລັດ!'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'ອກກຈາກລະບົບ ບໍ່ສຳເລັດ!'
            ];
        }

        return response()->json($response);

    }
}
