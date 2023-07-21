<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\GradeMobailResource;
use App\Http\Resources\GradesResource;
use App\Http\Resources\studentResource;
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
    //   $grade = $grade->fresh('student','course');

       return $this->apiResponse($grade , 205 , 'get all grades ');

    }

                    /**
                     * This Functtion to insert grades
                     */
    public function insertgrade(Request $request)
    {
        $course = Course::find($request->course_id);
        $student = Student::find($request->student_id);

        if ($course != null  && $student != null)
        {
            $grade = Grades::create([
                'course_id' => $request->course_id,
                'student_id' => $request->student_id,
                'th_grades'  => $request->th_grades,
                'pr_grades'  => $request->pr_grades,
            ]);

            return $this->apiResponse($grade , 201 , 'create success');
        }
        if($course != null && $student == null)
        {
            return $this->apiResponse(null , 402 , 'student not found');
        }
        if($course == null && $student != null)
        {
            return $this->apiResponse(null , 402 , 'course not found');
        }
        if($course == null && $student == null)
        {
            return $this->apiResponse(null , 402 , 'student and course not found');
        }
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Update the specified resource in storage.
     */
    public function updategrade(Request $request)
    {
        $grade = Grades::find($request->id);
        $grade -> update([
            'course_id' => $request->course_id,
            'student_id' => $request->student_id,
            'th_grades'  => $request->th_grades,
            'pr_grades'  => $request->pr_grades,
        ]);
        return $this->apiResponse($grade , 202 , 'update success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletegrade(Request $request)
    {
        $grade = Grades::find($request->id);
        $grade ->delete();
        return $this->apiResponse($grade ,204 , 'delete success');
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
