<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GradesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $course_name = $this->course()->first()->name;
        $id_course = $this->course()->first()->id_course;
        $id_student =$this->student()->first()->id_student;
        $first_name = $this->student()->first()->first_name;
        $last_name = $this->student()->first()->last_name;


        return [

            'first_name' => $first_name,
            'last_name' => $last_name,
            'student_id' => $id_student,
            'th_grades'=>$this->th_grades,
            'pr_grades'=>$this->pr_grades,
          //  'student'=> new studentResource($this->student),
            'course'=>$course_name,
            'id_course'=>$id_course,


        ];
    }
}
