<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GradeMobailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'course_name'=>$this->course->name,
            'course_chapter'=>$this->course->chapter,
            'course_year_related'=>$this->course->year_related,
            'academic_year'=>$this->academic_year,
            'pr_grade'=>$this->pr_grades,
            'th_grade'=>$this->th_grades,

        ];
    }
}
