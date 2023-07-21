<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $primaryKey = 'id_paid';
    use HasFactory;

    protected $fillable = [
        'student_id',
        'amount_paid',
        'date_paid',
        'paid_code'
    ];

    public function student(){

        return $this->belongsTo(Student::class ,'student_id','id_student' );

    }
}
