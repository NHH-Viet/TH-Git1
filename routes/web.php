<?php

use App\Http\Controllers\AnChi\AnChiChuongController;
use App\Http\Controllers\Dat\HomeController;
use App\Http\Controllers\Dat\theloaiController;
use App\Http\Controllers\y\chuongController;
use App\Http\Controllers\y\truyenController;
use App\Http\Controllers\AnChi\AnChiTruyenController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
//asd
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
/*admin*/
Route::resource('/admintheloai',\App\Http\Controllers\Admin\theloaiController::class);
Route::resource('/adminquyen',\App\Http\Controllers\Admin\quyenController::class);
Route::resource('/trangchuadmin',\App\Http\Controllers\Admin\trangchuController::class);
Route::resource('/admintruyen',\App\Http\Controllers\Admin\truyenController::class);
Route::resource('/adminbinhluan',\App\Http\Controllers\Admin\binhluanController::class);
Route::resource('/adminuser',\App\Http\Controllers\Admin\userController::class);
Route::resource('/adminthongke',\App\Http\Controllers\Admin\thongkeController::class);
Route::resource('/BTTH',\App\Http\Controllers\admin\BTTHController::class);
Route::get('btarray1',[\App\Http\Controllers\admin\BTTHController::class,'btarray1']);
Route::get('btarray2',[\App\Http\Controllers\admin\BTTHController::class,'btarray2']);
Route::get('btarray3',[\App\Http\Controllers\admin\BTTHController::class,'btarray3']);
Route::get('btarray4',[\App\Http\Controllers\admin\BTTHController::class,'btarray4']);
Route::get('btarray5',[\App\Http\Controllers\admin\BTTHController::class,'btarray5']);
Route::get('btarray6',[\App\Http\Controllers\admin\BTTHController::class,'btarray6']);
Route::get('btarray7',[\App\Http\Controllers\admin\BTTHController::class,'btarray7']);
Route::get('bai1pf',[\App\Http\Controllers\admin\BTTHController::class,'bai1pf']);
Route::get('bai2pf',[\App\Http\Controllers\admin\BTTHController::class,'bai2pf']);
Route::get('bai3pf',[\App\Http\Controllers\admin\BTTHController::class,'bai3pf']);
Route::get('bai4pf',[\App\Http\Controllers\admin\BTTHController::class,'bai4pf']);
Route::get('bai5pf',[\App\Http\Controllers\admin\BTTHController::class,'bai5pf']);
Route::get('bai6_7pf',[\App\Http\Controllers\admin\BTTHController::class,'bai6_7pf']);
Route::get('bai8pf',[\App\Http\Controllers\admin\BTTHController::class,'bai8pf']);
Route::get('bai6_7pf1',[\App\Http\Controllers\admin\BTTHController::class,'bai6_7pf1']);
Route::get('bai8pf',[\App\Http\Controllers\admin\BTTHController::class,'bai8pf']);
Route::get('bai8pf1',[\App\Http\Controllers\admin\BTTHController::class,'bai8pf1']);




Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/theloai/{id}', [theloaiController::class, 'show'])->name('theloai');
Route::get('/truyen/{id}', [truyenController::class, 'show'])->name('xemtruyen');
Route::get('/truyen/{id_truyen}/chuong-{id_chuong}', [chuongController::class, 'show'])->name('doctruyen');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
   Route::get('/truyen/follow/{id}', [truyenController::class, 'follow'])->name('theogioi');
   Route::post('/truyen/like/{id}', [truyenController::class, 'like'])->name('like');
   Route::delete('/truyen/like/{id}', [truyenController::class, 'removeComment'])->name('y.remove.comment');
   Route::post('/truyen/{id_truyen}', [truyenController::class, 'create_comment'])->name('bltruyen');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


// can thiet cho verify email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/leaderboard', [\App\Http\Controllers\Viet\LeaderboardController::class, 'index']);
Route::get('/timkiem',[\App\Http\Controllers\Viet\timkiemController::class, 'index'])->name('search');;




//Pham An Chi

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

   Route::get('anchi-truyen', [AnChiTruyenController::class, 'index'])->name('anchi');
   Route::get('anchi-truyen/create', [AnChiTruyenController::class, 'create']);
   Route::post('anchi-truyen/store', [AnChiTruyenController::class, 'store']);
   Route::get('anchi-truyen/show/{id}', [AnChiTruyenController::class, 'show']);
   Route::get('anchi-truyen/edit/{id}', [AnChiTruyenController::class, 'edit']);
   Route::put('anchi-truyen/update/{id}', [AnChiTruyenController::class, 'update']);
   Route::delete('anchi-truyen/destroy/{id}', [AnChiTruyenController::class, 'destroy']);
   Route::get('anchi-truyen/submit-delete/{id}', [AnChiTruyenController::class, 'submit_delete']);


   Route::get('anchi-chuong/{id}', [AnChiChuongController::class, 'index']);
   Route::get('anchi-chuong/{id}/create', [AnChiChuongController::class, 'create']);
   Route::post('anchi-chuong/{id}/store', [AnChiChuongController::class, 'store']);
   Route::get('anchi-chuong/{id}/show', [AnChiChuongController::class, 'show']);
   Route::get('anchi-chuong/{idTruyen}/edit/{id}', [AnChiChuongController::class, 'edit']);
   Route::put('anchi-chuong/{idTruyen}/update/{id}', [AnChiChuongController::class, 'update']);
   Route::delete('anchi-chuong/{idTruyen}/destroy', [AnChiChuongController::class, 'destroy']);
});

