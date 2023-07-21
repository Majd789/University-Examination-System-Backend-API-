<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FinanceMobailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           'amount_paid'=>$this->amount_paid,
            'date_paid'=>$this->date_paid,
            //'block'=> $this->isBlock($this->student->amount , $this->amount_paid)
        ];
    }
//    public function isBlock ($amount , $amount_paid){
//
//        $fifteen = $amount*0.5;
//        if ($amount_paid >= $fifteen )
//        {
//            return true;
//        }
//        return false;
//    }
}
