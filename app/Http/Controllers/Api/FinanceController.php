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

class FinanceController extends Controller
{
    use apiResponseTrait ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $finances = Finance::all();
        return $this->apiResponse($finances, '205' , 'this is all finance paid');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addPaid(Request $request)
    {
          $student = Student::find($request->student_id);
          if ($student)
          {
              $student_paid = Finance::where('student_id',$request->student_id)->count();
             // return $student_paid;
             if ($student_paid == 0) {  // found ?????????????

                 $paid = Finance::create([
                     'id_paid'=>$request->id_paid,
                     'student_id'=>$request->student_id,
                     'amount_paid'  => $request->amount_paid,
                     'date_paid'=> Carbon::parse($request->date_paid),
                     'paid_code' => $request->paid_code,
                 ]);
                 return $this->apiResponse($paid, '201', 'insert paid in DB successfly');
             }
              return $this->apiResponse(null, '410' ,'Student has been paid already');
          }
          else
          {
              return $this->apiResponse(null , 402 ,'student not found' );
          }


    }


    /**
     * Display the specified resource.
     */
    public function piad_show (Request $request){
        $paid = Finance::find($request->id_paid);
        if ($paid) {
            return $this->apiResponse($paid, 205, 'ok');
        }
        return $this->apiResponse(null , 402 ,'paid not found' );

    }
    public function show(Request $request)
    {
        $student_funance_info = Student::with('finances')->find($request->id_student);
        if ($student_funance_info) {
            return $this->apiResponse($student_funance_info, 205 , 'ok');
        }

        return $this->apiResponse(null , 402 ,'student not found' );
    }

    /**
     * Update the specified resource in storage.
     */
    public function dipositepaid(Request $request)
    {
      $student_paid = Finance::find($request->id_paid);
      $student_paid->amount_paid = $student_paid->amount_paid + $request->amount_paid; // Old Paid + New Paid = All Paid
      $student_paid->date_paid = Carbon::parse($request->date_paid);  // change string to date for insert in DB
      $student_paid->save();
        return $this->apiResponse($student_paid , '202', 'deposite update success');
    }

    public function updatepaid(Request $request){
        $student_paid = Finance::find($request->id_paid);
        $student_paid -> update([
            'amount_paid'  => $request->amount_paid,
            'date_paid'=> Carbon::parse($request->date_paid),
            'paid_code' => $request->paid_code,
        ]);
        return $this->apiResponse($student_paid , '202', 'update successfly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $student_paid = Student :: find ($request ->id_student);
        $paid = $student_paid->finances()
            ->delete();

        return $this->apiResponse(null , 204 , 'delete successfully');


    }

}
