<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\GradeMobailResource;
use App\Http\Resources\GradesResource;
use App\Http\Trait\apiResponseTrait;
use App\Imports\GradeImport;
use App\Models\Course;
use App\Models\Grades;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GradesController extends Controller
{
    use apiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    // get student & name courses & Grades
    public function index()
    {
       $grade = Grades::all();
       return $this->apiResponse($grade , 205 , 'get all grades ');

    }


//    public function store (Request $request)
//    {
//        try {
//
//
//        $request->validate([
//            "course_id"=>'required|numeric',
//            "student_id"=>'required|numeric',
//        ]);
//        $course = Course::find($request->course_id);
//        $student = Student::find($request->student_id);
//
//        if ($course != null  && $student != null) // التحقق من وجود الطالب والمادة في النظام
//        {
//            $GradesExists = Grades::where('student_id', $request->student_id)
//                ->where('course_id', $request->course_id)
//                ->exists();
//
//
//            if ($GradesExists) { // التحقق من وجود علامة لهذه المادة متعلقة بهذا الطالب من قبل
//                // يوجد سجل سابق يحتوي على نفس القيم في العمودين
//                $LastGrades = Grades::where('student_id', $request->student_id)
//                    ->where('course_id', $request->course_id)
//                    ->first();
//                if ($LastGrades->th_grades != null ) {// تم اضافة علامة نظري
//                    return $this->apiResponse($LastGrades, 401, 'Already Done Input Grades This Course To this Student');
//                }else{ // لم تتم اضافة علامة نظري هنا سيتم اضافتها
//                    $LastGrades->update([
//                        'th_grades' => $request->th_grades,
//                    ]);
//                }
//            } else {
//                // لا يوجد سجل سابق يحتوي على نفس القيم في العمودين
//                // اضافة علامة عملي
//                $request->validate([
//                    "pr_grades" =>'lt:30|numeric',
//                ]);
//                $grade = Grades::create([
//                    'course_id' => $request->course_id,
//                    'student_id' => $request->student_id,
//                    'th_grades' => $request->th_grades,
//                    'pr_grades' => $request->pr_grades,
//                ]);
//
//                return $this->apiResponse($grade, 201, 'create success');
//            }
//        }
//        if($course != null && $student == null)
//        {
//            return $this->apiResponse(null , 402 , 'student not found');
//        }
//        if($course == null && $student != null)
//        {
//            return $this->apiResponse(null , 402 , 'course not found');
//        }
//        if($course == null && $student == null)
//        {
//            return $this->apiResponse(null , 402 , 'student and course not found');
//        }
//            }catch (\Throwable $throwable){
//            return $this->apiResponse(false , 401 , $throwable->getMessage());
//        }
//
//    }

    public function add_pr_grades (Request $request){
        try {


            $request->validate([
                "course_id"=>'required|numeric',
                "student_id"=>'required|numeric',
            ]);
            $course = Course::find($request->course_id);
            $student = Student::find($request->student_id);

            if ($course != null  && $student != null) // التحقق من وجود الطالب والمادة في النظام
            {
               if ($course->mark == 'fragmented') {
                $GradesExists = Grades::where('student_id', $request->student_id)
                    ->where('course_id', $request->course_id)
                    ->exists();
                if ($GradesExists) { // التحقق من وجود علامة عملي لهذه المادة متعلقة بهذا الطالب من قبل
                    // يوجد سجل سابق يحتوي على نفس القيم في العمودين
                    $LastGrades = Grades::where('student_id', $request->student_id)
                        ->where('course_id', $request->course_id)
                        ->first();
                    return $this->apiResponse($LastGrades, 401, 'Already Done Input pr_grades For this Student');
                } else {
                    // لا يوجد سجل سابق يحتوي على نفس القيم في العمودين
                    // اضافة علامة عملي

                    $request->validate([
                        "pr_grades" =>'lt:31|numeric',
                    ]);
                    $grade = Grades::create([
                        'course_id' => $request->course_id,
                        'student_id' => $request->student_id,
                       // 'th_grades' => $request->th_grades,
                        'academic_year'=>$request->academic_year,
                        'pr_grades' => $request->pr_grades,
                    ]);

                    return $this->apiResponse($grade, 201, 'Done Input Pr_Grades success');
                }
            }else{
                   return $this->apiResponse(false, 401, 'You Can Not ADD Pr Grades For This Course');
               }
            }
            if($course != null && $student == null)
            {
                return $this->apiResponse(null , 402 , 'student not found');
            }
            if($course == null && $student != null)
            {
                return $this->apiResponse(null , 402 , 'course not found');
            }

                return $this->apiResponse(null , 402 , 'student and course not found');

        }catch (\Throwable $throwable){
            return $this->apiResponse(false , 401 , $throwable->getMessage());
        }

    }
    public function add_th_grades (Request $request){
        try {
            $request->validate([
                "course_id"=>'required|numeric',
                "student_id"=>'required|numeric',
            ]);
            $course = Course::find($request->course_id);
            $student = Student::find($request->student_id);

            if ($course != null  && $student != null) // التحقق من وجود الطالب والمادة في النظام
            {
                if ($course->mark == 'fragmented'){
                $GradesExists = Grades::where('student_id', $request->student_id)
                    ->where('course_id', $request->course_id)
                    ->exists();
                if ($GradesExists) { // التحقق من وجود علامة لهذه المادة متعلقة بهذا الطالب من قبل
                    $LastGrades = Grades::where('student_id', $request->student_id)
                        ->where('course_id', $request->course_id)
                        ->first();

                    if ($LastGrades->th_grades != null ) {  // تمت اضافة علامة نظري مسبقا
                        return $this->apiResponse($LastGrades, 401, 'Already Done Input Th_Grades For This Student');
                    }else{  // لم تتم اضافة علامة نظري هنا سيتم اضافتها
                        $request->validate([
                            "th_grades" =>'lt:71|numeric',
                        ]);
                        $LastGrades->update([
                            'academic_year'=>$request->academic_year,
                            'th_grades' => $request->th_grades,
                        ]);
                        return $this->apiResponse($LastGrades, 201, 'Done Input TH_Grades success');
                    }


                } else {
                    // لا يوجد سجل سابق يحتوي على نفس القيم في العمودين
                    return $this->apiResponse(false, 401, 'You Must Add Pr_Grades Before Add Th_Grades');
                }
            } else {

                    $GradesExists = Grades::where('student_id', $request->student_id)
                        ->where('course_id', $request->course_id)
                        ->exists();
                    if ($GradesExists) { // التحقق من وجود علامة لهذه المادة متعلقة بهذا الطالب من قبل
                        $LastGrades = Grades::where('student_id', $request->student_id)
                            ->where('course_id', $request->course_id)
                            ->first();
                            return $this->apiResponse($LastGrades, 401, 'Already Done Input Th_Grades For This Student');
                        }else{  // لم تتم اضافة علامة نظري هنا سيتم اضافتها

                        $grade = Grades::create([
                            'course_id' => $request->course_id,
                            'student_id' => $request->student_id,
                            'academic_year'=>$request->academic_year,
                            'th_grades' => $request->th_grades,
                            'pr_grades' => null,
                        ]);

                        return $this->apiResponse($grade, 201, 'Done Input TH_Grades success');
                    }


                    }

            }
            if($course != null && $student == null)
            {
                return $this->apiResponse(null , 402 , 'student not found');
            }
            if($course == null && $student != null)
            {
                return $this->apiResponse(null , 402 , 'course not found');
            }
                return $this->apiResponse(null , 402 , 'student and course not found');

        }catch (\Throwable $throwable){
            return $this->apiResponse(false , 401 , $throwable->getMessage());
        }

    }


    public function show(Request $request)
    {
        $grades = Grades::find($request->id);
        if ($grades){
            return $this->apiResponse($grades , 205 , 'ok');
        }
        else {
            return $this->apiResponse(null , 401 , 'not found Grades');
        }

    }



    public function grades_student(Request $request)
    {
        // استرجاع الدرجات بناءً على student_id
        $grades = Grades::where('student_id', $request->student_id)->get();
        
        if (!$grades->isEmpty()) {
            // استرجاع الدورات بناءً على course_id في الدرجات
            $course_ids = $grades->pluck('course_id')->toArray();
            $courses = Course::whereIn('id_course', $course_ids)->get();
            
            // دمج البيانات
            $mergedData = $grades->map(function ($grade) use ($courses) {
                // العثور على الدورة المناسبة بناءً على course_id
                $course = $courses->firstWhere('id_course', $grade->course_id);
                
                // دمج خصائص الدورة مع الدرجة
                return [
                    'grade_id' => $grade->id,
                    'course_id' => $grade->course_id,
                    'student_id' => $grade->student_id,
                    'academic_year' => $grade->academic_year,
                    'th_grades' => $grade->th_grades,
                    'pr_grades' => $grade->pr_grades,
                    'course_name' => $course ? $course->name : 'غير متوفر',
                    'course_chapter' => $course ? $course->chapter : 'غير متوفر',
                    'course_year_related' => $course ? $course->year_related : 'غير متوفر',
                    'course_mark' => $course ? $course->mark : 'غير متوفر',
                ];
            });
    
            // إرسال البيانات المدمجة
            return $this->apiResponse($mergedData, 205, 'ok');
        } else {
            return $this->apiResponse(null, 401, 'not found Grades');
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $grade = Grades::find($request->id);
        if ($grade) {
            $grade->update([
                'course_id' => $request->course_id,
                'student_id' => $request->student_id,
                'academic_year' => $request->academic_year,
                'th_grades' => $request->th_grades,
                'pr_grades' => $request->pr_grades,
            ]);
            return $this->apiResponse($grade, 202, 'update success');
        }
        return $this->apiResponse($grade, 202, 'Grade Not Found');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $grade = Grades::find($request->id);
        if ($grade) {
            $grade->delete();
            return $this->apiResponse($grade, 204, 'delete success');
        }
        return $this->apiResponse(null, 204, 'grade not found');

    }

    public function importExcel(Request $request ){
        Excel::import(new GradeImport, $request->file('file'));
        return response('saved');
    }
    public function score_sheet (){
        $grade = Grades::all();
        if ($grade)
        {
            return $this->apiResponse(GradesResource::collection($grade) , 205 ,'students not found' );
        }
        return $this->apiResponse(null , 402 ,'students not found' );

    }
}
