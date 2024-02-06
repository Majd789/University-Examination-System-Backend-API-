<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Trait\apiResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use apiResponseTrait;
                /*
                *This function to show all users in DB
                */
    public function index()
    {
        $users = User::all();
        return $this->apiResponse($users , 205 , 'get all users in DB');
    }
                /*
                 *This function to show user in DB
                */
    public function show(Request $request){
        $user = User::where('email'  , $request->email)->get();
        if (!$user->isEmpty())
        return $this->apiResponse($user, 205 , 'get  user in DB');
        return $this->apiResponse($user, 401 , 'not found user in DB');

    }

    public function get_permissions (){


    }
                /*
                *This function to create user in DB with Token
                */
    public function createUser(Request $request)
    {
        try {
            $validation = $request->validate([
                'password'=>'max:15|min:4' ,
                'email'=>'unique:users'
            ]);
            $user = User::create([
                'name' => $request->name,
                'permission' => $request->permission,
                'academic_rank'=>$request->academic_rank,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'data' => $user,
                'msg' => 'create user successfly',
                'token' => $user->createToken("User Token")->plainTextToken
            ], 201);



        } catch (\Throwable $throwable) {
            return $this->apiResponse('False' ,401 , $throwable->getMessage());
        }
    }

                /*
                *This function to Update user in DB
                */
    public function updateUser(Request $request )
    {
        try {
            $validation = $request->validate([
                'password'=>'max:15|min:4'

            ]);

            $user =User::where('email', $request->email)
                ->update([
                    'name' => $request->name,
                    'permission' => $request->permission,
                    'academic_rank' => $request->academic_rank,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

            return $this->apiResponse($user, 202, 'Update is successfly');
        } catch (\Throwable $throwable){
            return $this->apiResponse(false ,401 ,$throwable->getMessage());
        }
    }

                /*
                *This function to destroy user from DB
                */
    public function deleteUser(Request $request){
        $user = User::find($request->id);
        if ($user) {
            $user->delete();
            return $this->apiResponse($user, 204, 'delete is successfly');
        }
        return $this->apiResponse(null ,401 , 'user not found');
    }
}
