<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $primaryKey = 'id_paid';
    use HasFactory;

    protected $fillable = [
        'id_paid',
        'student_id',
        'amount_paid',
        'academic_year',
        'date_paid',
        'paid_code'
    ];

    public function student(){

        return $this->belongsTo(Student::class ,'student_id','id_student' );

    }
}
