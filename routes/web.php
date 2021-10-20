<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\HMemberController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function(){
Route::middleware(['guest:web'])->group(function(){
Route::view('/login','dashboard.user.login')->name('login');
Route::view('/register','dashboard.user.register')->name('register');
Route::post('/create',[UserController::class,'create'])->name('create');
Route::post('/dologin',[UserController::class,'dologin'])->name('dologin');
Route::get('/forget-password',[UserController::class,'getForgetPassword'])->name('getForgetPassword');
Route::post('/forget-password',[UserController::class,'postForgetPassword'])->name('postForgetPassword');
Route::get('reset-password/{reset_code}',[UserController::class,'getResetPassword'])->name('getResetPassword');
Route::post('/reset-password/{reset_code}',[UserController::class,'postResetPassword'])->name('postResetPassword');
});

Route::middleware(['auth:web'])->group(function(){
    Route::view('/home','dashboard.user.home')->name('home');
    Route::post('/add',[UserController::class,'add'])->name('add');
    Route::get('/home',[UserController::class,'addList'])->name('home');
    Route::get('delete/{id}',[UserController::class,'delete']);
    Route::view('/edit','dashboard.user.edit')->name('edit');
    Route::get('edit/{id}',[UserController::class,'showData']);
    Route::post('/update',[UserController::class,'update'])->name('update');



    Route::post('/logout',[UserController::class,'logout'])->name('logout');
   // leave home
   Route::view('/whome', 'dashboard.user.homel')->name('whome');
   Route::post('/addData1',[HMemberController::class,'addData1'])->name('addData1');
   Route::get('/whome',[HMemberController::class,'addList1'])->name('whome');
   Route::get('delete1/{id}',[HMemberController::class,'delete1']);
   Route::view('/edit1','dashboard.user.editl')->name('edit1');
   Route::get('edit1/{id}',[HMemberController::class,'showData1']);
   Route::post('/update1',[HMemberController::class,'update1'])->name('update1');

});

});





Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin'])->group(function(){
    Route::view('/login','dashboard.admin.login')->name('login');
    Route::post('/dologin',[AdminController::class,'dologin'])->name('dologin');

    });

    Route::middleware(['auth:admin'])->group(function(){
        Route::view('/home','dashboard.admin.home')->name('home');
        Route::get('/home',[AdminController::class,'addList'])->name('home');
        Route::get('delete/{id}',[AdminController::class,'delete']);
        Route::view('/weekedit','dashboard.admin.edit')->name('weekedit');
        Route::get('weekedit/{id}',[AdminController::class,'showWeekData']);
        Route::post('/weekupdate',[AdminController::class,'weekupdate'])->name('weekupdate');



        // holiday
        Route::get('hdelete/{id}',[AdminController::class,'hdelete']);
        Route::view('/holidayedit','dashboard.admin.hedit')->name('holidayedit');
        Route::get('holidayedit/{id}',[AdminController::class,'showholidayData']);
        Route::post('/holidayupdate',[AdminController::class,'holidayupdate'])->name('holidayupdate');

        Route::post('/logout',[AdminController::class,'logout'])->name('logout');
    });

    });
