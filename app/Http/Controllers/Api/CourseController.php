<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Web\Controller;
use App\Http\Trait\apiResponseTrait;
use App\Models\Course;
use App\Models\Grades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PHPUnit\Event\Code\Throwable;

class CourseController extends Controller
{
    use apiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    // test
    public function index()
    {
        $courses = Course::all();
        return $this->apiResponse($courses ,205 ,'get all courses');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_course'=>'required|unique:Students,id_student|numeric',
                'mark'=>'required|in:full,fragmented'
            ]);

            if($validator->fails()){
                return $this->apiResponse(false, 401,$validator->errors() );
            }
//            $request->validate([
//                'id_course'=>'required|unique:Students,id_student|numeric',
//                'mark'=>['required|',Rule::in(['full','fragmented'])]
//            ]);
            $course = Course::insert([
                'id_course' => $request->id_course,
                'name' => $request->name,
                'chapter' => $request->chapter,
                'year_related' => $request->year_related,
                'mark'=>$request->mark
            ]);

            return $this->apiResponse($course, 201, 'insert successfully');
        }catch (\Throwable $throwable){
            return $this->apiResponse(false,401,$throwable->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $course = Course::find($request->id_course);
        if ($course) {

            return $this->apiResponse($course, 205 , 'get  course in DB');

        }

        return $this->apiResponse($course ,402 ,'course not found');
    }

      public function show_course_grades (Request $request)
      {
          $course = Course::with('grades')->find($request->id_course);
           if ($course) {
//               return response()->json([
//                   'data' => $course,
//                   'message' => 'ok',
//                   'status' => 200
//               ]);
               return $this->apiResponse($course , 205 , 'ok');
           }
//               return response()->json([
//                   'data'=>$course,
//                   'message'=>'course Not Found ',
//                   'status'=>401
//               ]);
          return $this->apiResponse($course , 402 , 'course not found');

      }
//
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $course = Course::find($request->id_course);
        if ($course) {
            try {
//                $request->validate([
//                    'id_course' => 'required|numeric'
//                ]);
                $validator = Validator::make($request->all(), [
                    'id_course'=>'required|unique:Students,id_student|numeric',
                    'mark'=>'required|in:full,fragmented'
                ]);

                if($validator->fails()){
                    return $this->apiResponse(false, 401,$validator->errors() );
                }

                $course->update([
                    'id_course' => $request->id_course,
                    'name' => $request->name,
                    'chapter' => $request->chapter,
                    'year_related' => $request->year_related,
                    'mark'=>$request->mark
                ]);
                return $this->apiResponse($course, 202, 'update successful');



            } catch (\Throwable $throwable) {
                return $this->apiResponse(false, 401, $throwable->getMessage());
            }
        }
        return $this->apiResponse($course, 401, 'This Course Not Found');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $course = Course::find($request->id_course);
        if ($course)
        {
            $course->delete();
//            return response()->json([
//                'data'=>$course,
//                'message'=>'done delete course',
//                'status'=>200
//            ]);
            return $this->apiResponse($course , 204 , 'delete successful');
        }
//        return response()->json([
//            'message'=>'course not found',
//            'status'=> 401
//        ]);
        return $this->apiResponse($course , 402 , 'course not found');
    }

}
