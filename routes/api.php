<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Api\authController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\FinanceController;
use App\Http\Controllers\Api\GradesController;
use App\Http\Controllers\Api\MobailController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//fj

// student_Route
Route::get('students',[StudentController::class,'index']);
Route::get('student/show',[StudentController::class,'show']);
Route::post('student/add',[StudentController::class,'store']);
Route::get('student/finance/info',[StudentController::class,'show_finance_info']);
Route::get('student/grades/info',[StudentController::class,'show_grades_info']);
Route::put('student/update',[StudentController::class,'update']);
Route::delete('student/delete',[StudentController::class,'destroy']);

// Course_Route

Route::get('courses',[CourseController::class,'index']);
Route::get('course/show',[CourseController::class,'show']);
Route::get('course/grades/info',[CourseController::class,'show_course_grades']);
Route::post('course/add',[CourseController::class,'store']);
Route::put('course/update',[CourseController::class,'update']);
Route::delete('course/delete',[CourseController::class,'destroy']);


// Route Mobile

//Route::get('student/info',[MobailController::class,'student_info']); not used has been delete
Route::get('student/result',[MobailController::class,'student_result']);
Route::post('student/login',[MobailController::class,'login']);


// Admin
Route::get('admin/users' , [AdminController::class , 'index']); // show all users
Route::get('admin/user' , [AdminController::class , 'show']); // show User By email
Route::post('admin/auth/register' , [AdminController::class , 'createUser']); // Create User
Route::put('admin/user/update' , [AdminController::class , 'updateUser']);
Route::post('admin/delete' , [AdminController::class , 'deleteUser']);
Route::get('users/permissions',[AdminController::class,'get_permissions']);


// Auth
Route::post('auth/login' , [authController::class , 'loginUser']);


//Finances
Route::get('finance' , [FinanceController::class , 'index']);
Route::get('finance/student' , [FinanceController::class , 'show']);
Route::get('finance/paid/show',[FinanceController::class,'piad_show']);
Route::post('finance/addpaid' , [FinanceController::class , 'addPaid']);
Route::post('finance/dipositepaid' , [FinanceController::class , 'dipositepaid']); // diposite
Route::post('finance/updatepaid' , [FinanceController::class , 'updatepaid']); // update

// Grades
Route::get('grades' , [GradesController::class , 'index']);
Route::get('grades/show' , [GradesController::class , 'show']);
Route::post('grade/insertgrade', [GradesController::class , 'insertgrade']);
Route::put('grade/updategrade', [GradesController::class , 'updategrade']);
Route::delete('grade/deletegrade', [GradesController::class , 'deletegrade']);
Route::get('grades/score/sheet',[GradesController::class , 'score_sheet']);

//  Excel File Import to import grades

Route::post('grade/importexcel', [GradesController::class , 'importExcel']);

