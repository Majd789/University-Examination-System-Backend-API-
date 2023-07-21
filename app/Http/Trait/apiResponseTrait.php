<?php

namespace App\Http\Trait;

trait apiResponseTrait
{
        public function apiResponse($data, $status, $msg){
                $arr = [
                  'data' => $data,
                  'status' => $status,
                  'message'=> $msg
                ];
               if ($data = null){
                   return response($arr , 401 , 'not found');
               }
                else{
                    return response($arr , 200);
                }
        }
}
