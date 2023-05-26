<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ChangePasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth','manager'])->group(function () {

		Route::get('user-management',[InfoUserController::class ,'index'])->name('user-management');
		Route::get('edit-user',[InfoUserController::class ,'edit'])->name('edit-user');
		Route::get('new-user',[InfoUserController::class ,'create'])->name('new-user');
		Route::post('store-user',[InfoUserController::class ,'store'])->name('store-user');
		Route::post('update-user',[InfoUserController::class ,'update'])->name('update-user');
		Route::get('destroy-user',[InfoUserController::class ,'destroy'])->name('destroy-user');
	
		Route::get('department',[DepartmentController::class ,'index'])->name('department');
		Route::get('edit-department',[DepartmentController::class ,'edit'])->name('edit-department');
		Route::post('update-department',[DepartmentController::class ,'update'])->name('update-department');
		Route::get('destroy-department',[DepartmentController::class ,'destroy'])->name('destroy-department');
		Route::get('new-department',[DepartmentController::class ,'create'])->name('new-department');
		Route::post('store-department',[DepartmentController::class ,'store'])->name('store-department');
	
		Route::get('type',[TypeController::class ,'index'])->name('type');
		Route::get('edit-type',[TypeController::class  ,'edit'])->name('edit-type');
		Route::post('update-typr',[TypeController::class  ,'update'])->name('update-type');
		Route::get('destroy-type',[TypeController::class  ,'destroy'])->name('destroy-type');
		Route::get('new-type',[TypeController::class  ,'create'])->name('new-type');
		Route::post('store-type',[TypeController::class  ,'store'])->name('store-type');

		Route::get('pdf_creator',[ReportController::class ,'pdf_creator'])->name('pdf_creator');
	
	
	});


Route::middleware(['auth','def'])->group(function () {
	Route::get('general-table',[ReportController::class ,'general'])->name('general-table');
	Route::post('searchGeneral',[ReportController::class ,'general'])->name('searchGeneral');

	Route::get('report-entry',[ReportController::class ,'index'])->name('report-entry');
	Route::post('report-save',[ReportController::class ,'store'])->name('report-save');
	
});
Route::group(['middleware' => 'auth','irr'], function () {

	Route::get('irr-table',[ReportController::class ,'irrTable'])->name('irr-table');
	Route::post('searchIrr',[ReportController::class ,'irrTable'])->name('searchIrr');


});
Route::middleware(['auth','doctor'])->group(function () {
	Route::get('irrDoc-table',[ReportController::class ,'irrTableDoc'])->name('irrDoc-table');
	Route::post('searchIrrDoc',[ReportController::class ,'irrTableDoc'])->name('searchIrrDoc');

	Route::get('completed',[ReportController::class ,'completed'])->name('completed');


});
Route::middleware(['auth'])->group(function () {
	Route::get('cdi',[ReportController::class ,'cdi'])->name('cdi');
	Route::get('notCompleted',[ReportController::class ,'notCompleted'])->name('notCompleted');
	Route::get('irr',[ReportController::class ,'irr'])->name('irr');
	Route::get('coding',[ReportController::class ,'coding'])->name('coding');
	Route::get('updateType',[ReportController::class ,'updateType'])->name('updateType');


});

Route::middleware(['auth','cdi'])->group(function () {

	Route::get('cdi-table',[ReportController::class ,'cdiTable'])->name('cdi-table');
	Route::post('searchCdi',[ReportController::class ,'cdiTable'])->name('searchCdi');
	

});
Route::middleware(['auth','coding'])->group(function () {

	Route::get('coding-table',[ReportController::class ,'codingTable'])->name('coding-table');
	Route::post('searchCoding',[ReportController::class ,'codingTable'])->name('searchCoding');
	Route::get('coding-done/{id}',[ReportController::class ,'coding_done'])->name('coding-done');
	Route::post('diagnosis',[ReportController::class ,'diagnosis'])->name('diagnosis');
	Route::get('coding-irr/{id}',[ReportController::class ,'coding_irr'])->name('coding-irr');



});
Route::middleware(['auth','esr'])->group(function () {
	

	Route::get('esr-table',[ReportController::class ,'esrTable'])->name('esr-table');
	Route::post('searchEsr',[ReportController::class ,'esrTable'])->name('searchEsr');


});

Route::group(['middleware' => 'auth'], function () {

	Route::get('/', function(){
		return redirect('dashboard');
	}
	);
	Route::get('dashboard', [HomeController::class, 'home'])->name('dashboard');
	Route::view('notification','notification')->name('notification');


    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');