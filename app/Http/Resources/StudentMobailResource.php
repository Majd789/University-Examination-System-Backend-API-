<?php

namespace App\Http\Resources;

use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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

        // In The First Must Be Check tO Finance Table Are Found Paid Return To THis STUdent ?
        //if true /not found any problem send all data if the paid > 50% from amount the year
        // if false we send  finance and grades [] [] => null

        $Found_Paid = Finance::find($this->finances()->first());

        if ($Found_Paid) {
            $paid = $this->finances()->first()->amount_paid;
            $block = $this->amount * 0.5 <= $paid;
            return [
                'id_student' => $this->id_student,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'year_join' => $this->year_join,
                'status_record' => $this->status_record,
                'account_status' => $this->account_status,
                'amount' => $this->amount,
                'block' => !$block,
                'finances' => FinanceMobailResource::collection($this->finances),
                'grades' => $block ? GradeMobailResource::collection($this->grades) : [],
            ];
        }
        else {

            $paid = 0 ;
            $block = $this->amount * 0.5 <= $paid;
            return [
                'id_student' => $this->id_student,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'year_join' => $this->year_join,
                'status_record' => $this->status_record,
                'account_status' => $this->account_status,
                'amount' => $this->amount,
                'block' => !$block,
                'finances' => FinanceMobailResource::collection($this->finances),
                'grades' => $block ? GradeMobailResource::collection($this->grades) : [],
            ];
        }

    }
}
