<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Web\Controller;
use App\Http\Trait\apiResponseTrait;
use App\Models\Finance;
use App\Models\Grades;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    use apiResponseTrait ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $finances = Finance::all();
        return $this->apiResponse($finances, '201' , 'this is all finance paid');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addPaid(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'paid_code' =>'required|unique:finances|numeric' ,
            'student_id'=>'required|numeric',
            'academic_year'=> 'regex:/^\d{4}\/\d{4}$/',
            'amount_paid'  =>'required|numeric' ,
        ]);

        if ($validator->fails()) {
           // $errors = $validator->errors();
            return $this->apiResponse(null , 404 ,$validator->errors() );

        }


        $student = Student::find($request->student_id);
          if ($student)
          {
              $student_amount = $student->amount;   // Amount Year for This Student /200 $ /
              $last_paid_for_this_academic_year = Finance::where('student_id' , $request->student_id)// The academic year for which the student will pay
                                                            ->where('academic_year' , $request->academic_year)
                                                            ->get();
              $amount = 0;
              foreach ($last_paid_for_this_academic_year as $record) {
                  $amount += $record->amount_paid; // get Sum Paid For This Student In This Academic Year
              }
              $remaining_amount = $student_amount - $amount;
              if ($remaining_amount == 0 ){
                  return $this->apiResponse( $remaining_amount , '402', 'The Student Complete Paid For This Academic Year');
              }elseif ($remaining_amount < $request->amount_paid){
                  $data = [
                      'remaining_amount' => $remaining_amount
                      ];
                  return $this->apiResponse($data , '402', 'The amount you want to pay is greater than the amount remaining on the student for this Academic Year');
              }

               $paid = Finance::create([
                     'paid_code' => $request->paid_code,
                     'student_id'=>$request->student_id,
                     'academic_year'=>$request->academic_year,
                     'amount_paid'  => $request->amount_paid,
                     'date_paid'=> Carbon::parse($request->date_paid),
                     'remaining_amount' => $remaining_amount
                 ]);

                $data = [
                    'paid_code' => $paid->paid_code,
                    'student_id'=>$paid->student_id,
                    'academic_year'=>$paid->academic_year,
                    'amount_paid'  => $paid->amount_paid,
                    'remaining_amount' =>   $remaining_amount - $paid-> amount_paid,
                    'date_paid'=> $paid->date_paid,


                ] ;
                 return $this->apiResponse($data, '201', 'Done Add Paid insert successfly');
          }
              return $this->apiResponse(null , 402 ,'student not found' );
    }


    /**
     * Display the specified resource.
     */

    public function show (Request $request){
        $paid = Finance::find($request->id_paid);
        if ($paid){
            return $this->apiResponse($paid , 201 ,'done');

        }
        return $this->apiResponse(null , 402 ,'Paid Not Found');

    }

    public function show_student_paid (Request $request) {

        $student = Student::find($request->student_id);
        if ($student){

            $student_paids = Finance::where('student_id', $request->student_id)
                ->orderBy('academic_year')
                ->get();

// تجهيز المصفوفة النهائية
            $result = [];

// تجميع البيانات بحسب العام الدراسي وحساب مجموع amount_paid
            foreach ($student_paids as $payment) {
                $academic_year = $payment->academic_year;

                // التحقق مما إذا كانت السنة الدراسية موجودة في المصفوفة النهائية
                if (!isset($result[$academic_year])) {
                    $result[$academic_year] = [
                        'total_amount_paid' => 0, // إعداد المجموع الابتدائي للعام الدراسي
                        'remaining_amount' => 0 ,
                        'payments' => [], // قائمة تفاصيل الدفعات المالية
                    ];
                }

                // إضافة تفاصيل الدفعة المالية إلى المصفوفة النهائية
                $result[$academic_year]['payments'][] = [
                    'id_paid' => $payment->id_paid,
                    'paid_code' => $payment->paid_code,
                    'student_id' => $payment->student_id,
                    'amount_paid' => $payment->amount_paid,
                    'date_paid' => $payment->date_paid,
                    'created_at' => $payment->created_at,
                    'updated_at' => $payment->updated_at,
                ];

                // إضافة مبلغ الدفعة إلى مجموع العام الدراسي
                $remaining_amount = $student->amount - ($result[$academic_year]['total_amount_paid'] += $payment->amount_paid );
                $result[$academic_year]['remaining_amount'] = $remaining_amount;
            }

            return $this->apiResponse($result , 402 ,'This All Paid For This Student');

        }
        return $this->apiResponse(null , 402 ,'Student Not Found');


    }



    public function update (Request $request) {
        $validator = Validator::make($request->all(), [
            'paid_code' =>'required|numeric' ,
            'student_id'=>'required|numeric',
            // 'academic_year'=> 'regex:/^\d{4}\/\d{4}$/',
            'amount_paid'  =>'required|numeric' ,
        ]);

        if ($validator->fails()) {
            // $errors = $validator->errors();
            return $this->apiResponse(null , 404 ,$validator->errors() );

        }

        $paid = Finance::find($request->id_paid);
        if ($paid){
            $paid->update([
                'paid_code' => $request->paid_code,
                'student_id'=>$request->student_id,
                'academic_year'=>$request->academic_year,
                'amount_paid'  => $request->amount_paid,
                'date_paid'=> Carbon::parse($request->date_paid),
            ]);
            return $this->apiResponse($paid, '201', 'Done Update Paid successfly');
        }
        return $this->apiResponse(null , 402 ,'Paid not found' );
    }

    public function destroy(Request $request)
    {
        $paid = Finance :: find ($request ->id_paid);
        if ($paid){
            $paid->delete();
            return $this->apiResponse($paid , 204 , 'Done delete paid successfully');
        }
        return $this->apiResponse(null , 401 , 'Paid Not Found');

    }

}
