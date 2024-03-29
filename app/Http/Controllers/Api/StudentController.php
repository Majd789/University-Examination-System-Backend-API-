<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\StudentMobailResource;
use App\Http\Trait\apiResponseTrait;
use App\Models\Course;
use App\Models\Grades;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class StudentController extends Controller
{
    use apiResponseTrait;

    public function index()
    {
        $students = Student::all();
//        return response()->json([
//            'data'=>$students,
//            'message'=>'ok',
//            'status'=>200
//        ]);
        return $this->apiResponse($students , 205 , 'ok');
    }


    public function store(Request $request)
    {

        try {
            $request->validate([
                    'id_student'=>'required|unique:Students,id_student|numeric|digits:9',
                    'year_join'=> 'regex:/^\d{4}\/\d{4}$/',
                ]);
            $student = Student::insert([
                'id_student' => $request->id_student,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'mother' => $request->mother,
                'gender' => $request->gender,
                'birth_place' => $request->birth_place,
                'birth_date' => Carbon::parse($request->birth_date),
                'phone' => $request->phone,
                'fidelity_constrain' => $request->fidelity_constrain,
                'health_status' => $request->health_status,
                'certificate_type' => $request->certificate_type,
                'faculty'=>$request->faculty,
                'year'=>$request->year,
                'year_join' => $request->year_join,
                'status_record' => $request->status_record,
                'amount' => $request->amount,
                'password' => Str::random(6),
            ]);

            return $this->apiResponse($student, 201, 'Done Insert Student successfully');
        } catch (\Throwable $throwable){
            return $this->apiResponse(false,401,$throwable->getMessage());
        }
    }



    public function show(Request $request)
    {
        try {


            $request->validate(
                [
                    'id_student' => 'required|numeric|digits:9',
                ]);
            $student = Student::find($request->id_student);
            if ($student) {

                return $this->apiResponse($student, 205, 'ok');
            }

            return $this->apiResponse($student, 402, 'student not found');
        }catch (\Throwable $throwable){
            return $this->apiResponse(null, 401, $throwable->getMessage());
        }
    }


    public function show_finance_info (Request $request)
    {
         $student_funance_info = Student::with('finances')->find($request->id_student);
        if ($student_funance_info) {
//            return response()->json([
//                'data' => $student_funance_info,
//                'message' => 'ok',
//                'status' => 200
//            ]);
            return $this->apiResponse($student_funance_info, 205 , 'ok');
        }
//        return response()->json([
//            'data' => null,
//            'message' => 'student not found',
//            'status' => 401
//        ]);
        return $this->apiResponse(null , 402 ,'student not found' );
    }



    public function show_grades_info (Request $request)
    {
//            $student_grades = Student::find($request->id_student);
        $students_grades = Student::with('grades')->find($request->id_student);
        if ($students_grades) {
            return $this->apiResponse( $students_grades,205 ,'ok');
//            return response()->json([
//                'data' => studentResource::collection($students_grades),
//                'message' => 'ok',
//                'status' => 200
//            ]);
        }

        return $this->apiResponse(null , 402 ,'students not found' );



    }



    public function update(Request $request)
    {
        try {

            $student = Student::find($request->id_student);
            if ($student) {
                $student->update([
                    'id_student' => $request->id_student,
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'mother' => $request->mother,
                    'gender' => $request->gender,
                    'birth_place' => $request->birth_place,
                    'birth_date' => Carbon::parse($request->birth_date),
                    'phone' => $request->phone,
                    'fidelity_constrain' => $request->fidelity_constrain,
                    'health_status' => $request->health_status,
                    'certificate_type' => $request->certificate_type,
                    'faculty'=>$request->faculty,
                    'year'=>$request->year,
                    'year_join' => $request->year_join,
                    'status_record' => $request->status_record,
                    'amount' => $request->amount
                ]);

                return $this->apiResponse($student, 202, 'update success');

            }
            return $this->apiResponse($student, 402, 'student not found');
        }catch (\Throwable $throwable){
            return $this->apiResponse(false ,401 ,$throwable->getMessage());
        }
    }


    public function destroy (Request $request)
    {

        $student = Student::find($request->id_student);
        if ($student)
        {
            $student->delete();

            return $this->apiResponse($student, 204 , 'delete success');
        }
        return $this->apiResponse(null , 402 ,'student not found' );

    }
    public function password (Request $request)
    {
        $request->validate([
            'id_student' => 'required|numeric|digits:9',
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $student = Student::find($request->id_student);

        if (!$student) { // اذا كان الطالب غير موجود
            return $this->apiResponse(null, 402, 'Student not found');
        }

        if (!Hash::check($request->old_password, $student-> password)) {    // يتم التحقق من كلمة المرور اذا كانت نفس كلمة المرور المخزنة في قاعدة البيانات
            return $this->apiResponse(null, 401, 'Invalid old password');
        }

        $student->password = Hash::make($request->new_password);    // اذا كانت كلمة المرور صحيحة
        $student->save();
        return $this->apiResponse($student, 200, 'Password changed successfully');
    }

}


