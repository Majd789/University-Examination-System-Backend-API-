<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Trait\apiResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//commit
class authController extends Controller
{
    use apiResponseTrait;
                /*
               *This function to login user in DB with Token
               */

    public function loginUser(Request $request){

        try {
            error_log($request->email);
            error_log($request->password);
            $authUser = Auth::attempt(['email'=>$request->email , 'password' => $request->password] , true);
            if (!$authUser) {
//
                return $this->apiResponse(false , 403 ,'Email and Password not match');
            }
            $user = User::where('email' , $request->email)->get();
//
            return $this->apiResponse($user ,203 ,'login user successfly');

        }catch (\Throwable $throwable){
            return $this->apiResponse('False' ,401 , $throwable->getMessage());
        }
    }
}



