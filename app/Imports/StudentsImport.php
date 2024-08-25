<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class StudentsImport implements ToModel, WithHeadingRow
{

    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // تحقق من وجود السجل
        $existingCourse = Student::find($row['id_student']);

        if ($existingCourse) {
            // سجل رسالة تنبيه عند وجود سجل مكرر
            Log::warning("سجل مكرر: ID Course - " . $row['id_student']);
            return null;// لا تقم بإدراج السجل المكرر
        }
        return new Student([
            'id_student'=> $row['id_student'],
            'first_name'=> $row['first_name'],
            'middle_name'=> $row['middle_name'],
            'last_name'=> $row['last_name'],
            'mother'=> $row['mother'],
            'gender'=> $row['gender'],
            'birth_place'=> $row['birth_place'],
            'birth_date'=> Carbon::parse($row['birth_date']),
            'phone'=> $row['phone'],
            'fidelity_constrain'=> $row['fidelity_constrain'],
            'health_status'=> $row['health_status'],
            'certificate_type'=> $row['certificate_type'],
            'faculty'=> $row['faculty'],
            'year'=> $row['year'],
            'year_join'=> $row['year_join'],
            'status_record'=> $row['status_record'],
            'amount'=> $row['amount'],
            'password' => Str::random(6)

        ]);
    }
}
