<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'student_id', 'th_grades' ,'pr_grades'];


//    public function student(){
//
//        return $this->belongsTo(Student::class);
//    }


    public function course ()
    {
        return $this->belongsTo(Course::class ,'course_id','id_course');

    }
    public function student ()
    {
        return $this->belongsTo(Student::class ,'student_id','id_student');
    }
}
