<?php

namespace App\Imports;

use App\Models\Course;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CoursesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        // تحقق من وجود السجل
        $existingCourse = Course::find($row['id_course']);

        if ($existingCourse) {
            // سجل رسالة تنبيه عند وجود سجل مكرر
            Log::warning("سجل مكرر: ID Course - " . $row['id_course']);
            return null ;// لا تقم بإدراج السجل المكرر
        }
        return new Course([
            'id_course' => $row['id_course'],
            'name' => $row['name'],
            'chapter' => $row['chapter'],
            'year_related' => $row['year_related'],
            'mark' => $row['mark']
        ]);
    }



}
