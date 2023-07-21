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
        $user = User::get()->where('email'  , $request->email);
        return $this->apiResponse($user, 205 , 'get  user in DB');

    }

    public function get_permissions (){


    }
                /*
                *This function to create user in DB with Token
                */
    public function createUser(Request $request)
    {
        try {
//                     create user
            $user = User::create([
                'name' => $request->name,
                'permission' => $request->permission,
                'academic_rank'=>$request->academic_rank,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'data' => true,
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
       // $user = User::where('email' , $request->email)->get();
  //      $user = User::get()->where('email'  , $request->email);
//        return response()->json([
//           'data'=>$user
//        ]);
//        $user->update(
//            [
//                'permission' => $request->permission,
//            ]
//        );
        $user = DB::table('users')
            ->where('email',$request->email )
            ->update(['permission' => $request->permission]);

        return $this->apiResponse($user , 202 , 'Update is successfly');

    }

                /*
                *This function to destroy user from DB
                */
    public function deleteUser(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return $this->apiResponse(null , 204 , 'delete is successfly');
    }
}
