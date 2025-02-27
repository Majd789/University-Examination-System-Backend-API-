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
use Illuminate\Support\Facades\Hash;

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
        if ($student->password == $request->password){
            return $this->apiResponse($student->id_student , 203 , 'ok');
        }
        return $this->apiResponse(null , 402 ,'الرقم الجامعي او كلمة المرور غير صحيحتان' );

    }



    public function grades (Request $request) {
        $student = Student::find($request->id_student);
        if ($student) {
            return $this->apiResponse(new StudentMobailResource($student) , 205 , 'ok');
        }

        return $this->apiResponse(null , 402 ,'student not found' );

    }



    public function reset_password (Request $request)
    {
        $request->validate([
            'id_student' => 'required|numeric|digits:9',
            'password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $student = Student::find($request->id_student);

        if (!$student) { // إذا كان الطالب غير موجود
            return $this->apiResponse(null, 402, 'Student not found');
        }

        // التحقق من تطابق كلمة المرور
        if ($request->password !== $student->password) {
            return $this->apiResponse(null, 401, 'Invalid old password');
        }

        $student->password = $request->new_password; // تغيير كلمة المرور
        $student->save();

        return $this->apiResponse($student, 200, 'Password changed successfully');
    }




}
