<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FinanceMobailResource;
use App\Http\Resources\GradeMobailResource;
use App\Http\Resources\StudentInfoMobailResource;
use App\Http\Resources\StudentMobailResource;
use App\Http\Trait\apiResponseTrait;
use App\Models\Grades;
use App\Models\Student;
use Illuminate\Http\Request;

class MobailController extends Controller
{
    use apiResponseTrait;
//    public function student_info(Request $request){   // not used
//        $student_info = Student::find($request->id_student);
//        if ($student_info){
//
//            return $this->apiResponse(new StudentInfoMobailResource($student_info) , 205 , 'ok');
//        }
//        return $this->apiResponse(null , 402 ,'student not found' );
//
//    }


    public function login (Request $request)
    {
        $student = Student::find($request->id_student);
        if ($student){
            return $this->apiResponse($student->id_student , 203 , 'ok');
        }
        return $this->apiResponse(null , 402 ,'student not found' );

    }



    public function grades (Request $request) {
        $student = Student::find($request->id_student);
        if ($student) {
            return $this->apiResponse(new StudentMobailResource($student) , 205 , 'ok');
        }

        return $this->apiResponse(null , 402 ,'student not found' );

    }




}
