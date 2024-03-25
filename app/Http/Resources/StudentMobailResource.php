<?php

namespace App\Http\Resources;

use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class StudentMobailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $academic_year_not_block  = [] ; // هذه المصفوفة ستحتوس على الاعوام الدراسية التي لن تحجب فيها العالامات
        $grades_block = []; // العلامات المحجوبة
        $grades_not_block = []; // العلامات غير المحجوبة

        // الحصول على مجموع الدفعات التي قام الطالب بتسديدها في كل عام دراسي
        $paids_by_years = Finance::select('academic_year', DB::raw('SUM(amount_paid) as total_amount_paid'))
            ->where('student_id', $this->id_student)
            ->groupBy('academic_year')
            ->get();

        $grades = $this->grades()->get();  // علامات الطالب


        foreach ($paids_by_years as $paid_by_year){
           if ($this->amount * 0.5 <= $paid_by_year->total_amount_paid){
                $academic_year_not_block [] = $paid_by_year->academic_year;
           }
        }

        foreach ($grades as $grade) {
            // البحث عن القيمة داخل المصفوفة
            if (in_array($grade->academic_year, $academic_year_not_block)) {
                $grades_not_block [] = $grade;
            } else {
                $grades_block [] = $grade;
            }
        }


        return [
            'grades'=>$grades_not_block
        ];



//        $Found_Paid = Finance::find($this->finances()->first());
//
//        if ($Found_Paid) {
//            $paid = $this->finances()->first()->amount_paid;
//            $block = $this->amount * 0.5 <= $paid;
//            return [
//                'id_student' => $this->id_student,
//                'first_name' => $this->first_name,
//                'middle_name' => $this->middle_name,
//                'last_name' => $this->last_name,
//                'year_join' => $this->year_join,
//                'status_record' => $this->status_record,
//                'account_status' => $this->account_status,
//                'amount' => $this->amount,
//                'block' => !$block,
//                'finances' => FinanceMobailResource::collection($this->finances),
//                'grades' => $block ? GradeMobailResource::collection($this->grades) : [],
//            ];
//        }
//        else {
//
//            $paid = 0 ;
//            $block = $this->amount * 0.5 <= $paid;
//            return [
//                'id_student' => $this->id_student,
//                'first_name' => $this->first_name,
//                'middle_name' => $this->middle_name,
//                'last_name' => $this->last_name,
//                'year_join' => $this->year_join,
//                'status_record' => $this->status_record,
//                'account_status' => $this->account_status,
//                'amount' => $this->amount,
//                'block' => !$block,
//                'finances' => FinanceMobailResource::collection($this->finances),
//                'grades' => $block ? GradeMobailResource::collection($this->grades) : [],
//            ];
//        }
//


   }
}
