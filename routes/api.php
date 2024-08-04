<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Api\ArticleController;
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

// Admin
Route::get('admin/users' , [AdminController::class , 'index']); // show all users
Route::get('admin/user' , [AdminController::class , 'show']); // show User By email
Route::post('admin/auth/register' , [AdminController::class , 'createUser']); // Create User
Route::put('admin/user/update' , [AdminController::class , 'updateUser']);
Route::delete('admin/delete' , [AdminController::class , 'deleteUser']);
Route::get('users/permissions',[AdminController::class,'get_permissions']);

// User
Route::post('auth/login' , [authController::class , 'loginUser']);


// student_Route
Route::get('students',[StudentController::class,'index']);
Route::get('student/show',[StudentController::class,'show']);
Route::post('student/add',[StudentController::class,'store']);
Route::get('student/finance/info',[StudentController::class,'show_finance_info']);
Route::get('student/grades/info',[StudentController::class,'show_grades_info']);
Route::post('student/update',[StudentController::class,'update']);
Route::delete('student/delete',[StudentController::class,'destroy']);


// Course_Route

Route::get('courses',[CourseController::class,'index']);
Route::get('course/show',[CourseController::class,'show']);
Route::get('course/grades/info',[CourseController::class,'show_course_grades']);
Route::post('course/add',[CourseController::class,'store']);
Route::post('course/update',[CourseController::class,'update']);
Route::delete('course/delete',[CourseController::class,'destroy']);


//Finances
Route::get('finance' , [FinanceController::class , 'index']); // all
Route::get('finance/paid/show',[FinanceController::class,'show']); // id paid
Route::get('finance/student/paid' , [FinanceController::class , 'show_student_paid']); // student_id
Route::post('finance/addpaid' , [FinanceController::class , 'addPaid']);
Route::post('finance/paid/update' , [FinanceController::class , 'update']); // update
Route::delete('finance/paid/delete',[FinanceController::class,'destroy']);
// Grades
Route::get('grades' , [GradesController::class , 'index']);
Route::get('grades/show' , [GradesController::class , 'show']);
Route::get('grades/show/student' , [GradesController::class , 'grades_student']);
//Route::post('grade/add', [GradesController::class , 'store']);
Route::post('grade/add/pr_grades', [GradesController::class , 'add_pr_grades']); // عملي
Route::post('grade/add/th_grades', [GradesController::class , 'add_th_grades']); // نظري
Route::post('grade/update', [GradesController::class , 'update']);
Route::delete('grade/delete', [GradesController::class , 'destroy']);
// EXCEL
Route::get('grades/score/sheet',[GradesController::class , 'score_sheet']);
Route::post('grade/importexcel', [GradesController::class , 'importExcel']);

// Articles
Route::get('article' ,[ArticleController::class , 'index']);
Route::get('article/show' ,[ArticleController::class , 'show']);
Route::post('article/add',[ArticleController::class,'store']);
Route::post('article/update' ,[ArticleController::class , 'update']);
Route::delete('article/delete',[ArticleController::class,'destroy']);

// Route Mobile

Route::post('student/login',[MobailController::class,'login']);
Route::get('student/grades',[MobailController::class,'grades']);
Route::post('student/password/reset',[MobailController::class,'reset_password']);
