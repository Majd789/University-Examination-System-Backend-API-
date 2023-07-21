<?php

namespace App\Imports;

use App\Models\Grades;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class GradeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Grades([
            'course_id' => $row['course_id'],
            'student_id' => $row['student_id'],
            'th_grades' => $row['th_grades'],
            'pr_grades' => $row['pr_grades'],
        ]);
    }
}
