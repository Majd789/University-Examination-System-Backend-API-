<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_student';

    protected $fillable= [
        'id_student',
        'first_name',
        'middle_name',
        'last_name',
        'mother',
        'gender',
        'birth_place',
        'birth_date',
        'phone',
        'fidelity_constrain',
        'health_status',
        'certificate_type',
        'year',
        'year_join',
        'status_record',
        'amount',
    ];
    public function finances ()
    {
        return $this->hasMany(Finance::class,'student_id');
    }
    public function grades (){
        return $this->hasMany(Grades::class,'student_id');
    }



}
