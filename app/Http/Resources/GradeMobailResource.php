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
            'cource_chapter'=>$this->course->chapter,
            'course_year_related'=>$this->course->year_related,
            'th_grade'=>$this->th_grades,
            'pr_grade'=>$this->pr_grades
        ];
    }
}
