<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\trangchuController;
use App\Http\Controllers\nhapController;
use App\Http\Controllers\xuatController;
use App\Http\Controllers\khachhangController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\hangController;
use App\Http\Controllers\userController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [loginController::class,'index'])->name('login');
Route::post('/', [loginController::class,'postlogin'])->name('postlogin');

Route::middleware(['auth'])->group(function () {
    Route::prefix('trangchu')->name('trangchu.')->group(function () {
        Route::get('logout', [loginController::class,'logout'])->name('logout');
        Route::get('thongtintaikhoan', [loginController::class,'thongtinuser'])->name('thongtinuser');
        Route::prefix('quanlytaikhoan')->name('quanlytaikhoan.')->group(function () {
            Route::get('/', [userController::class,'index'])->name('index');
            Route::get('add', [userController::class,'create'])->name('getuser');
            Route::post('add', [userController::class,'store'])->name('postuser');
            Route::get('edit/{id}', [userController::class,'edit'])->name('edituser');
            Route::put('update', [userController::class,'update'])->name('updateuser');
            Route::delete('deleteuser{id}', [userController::class,'destroy'])->name('deleteuser');
        });
        Route::get('/', [trangchuController::class, 'index'])->name('index');
        Route::get('nhap', [nhapController::class, 'create'])->name('formnhap');
        Route::post('themthanghoa', [nhapController::class, 'addHangHoa'])->name('postaddhanghoa');
        Route::post('nhap', [nhapController::class, 'store'])->name('postnhap');
        Route::get('xuat', [xuatController::class, 'create'])->name('formxuat');
        Route::post('xuat', [xuatController::class, 'store'])->name('postxuat');
        Route::post('donvi', [nhapController::class, 'addDonVi'])->name('postdonvi');
        Route::prefix('baocao')->name('baocao.')->group(function () {
            Route::get('/', [trangchuController::class, 'showBaoCao'])->name('index');
            Route::get('nhap', [nhapController::class, 'index'])->name('shownhap');
            Route::delete('deletenhap{id}', [nhapController::class, 'destroy'])->name('deletenhap'); 
            Route::get('xuat', [xuatController::class, 'index'])->name('showxuat');
            Route::delete('deletexuat{id}', [xuatController::class, 'destroy'])->name('deletexuat');
            Route::get('ton-kho', [trangchuController::class, 'showTonKho'])->name('showtonkho');
            Route::get('hoa-don', [trangchuController::class, 'showHoaDon'])->name('showhoadon');
        });
        Route::prefix('khachhang')->name('khachhang.')->group(function () {
            Route::get('/', [trangchuController::class, 'khachhang'])->name('index');
            Route::get('Thongtinkhachhang', [khachhangController::class, 'index'])->name('showkhachhang');
            Route::get('Themkhachhang', [khachhangController::class, 'create'])->name('formkhachhang');
            Route::post('Themkhachhang', [khachhangController::class, 'store'])->name('postkhachhang');
            Route::get('editkhachhang/{id}', [khachhangController::class, 'edit'])->name('editkhachhang');
            Route::put('updatekhachhang', [khachhangController::class, 'update'])->name('updatekhachhang');
            Route::delete('deletekhachang{id}', [khachhangController::class, 'destroy'])->name('deletekhachang');
        });
        Route::prefix('thongke')->name('thongke.')->group(function () {
            Route::get('/', [trangchuController::class, 'thongke'])->name('index');
            Route::get('thongkehang', [trangchuController::class,'thongkehang'])->name('thongkehang');
        });
        Route::prefix('hanghoa')->name('hanghoa.')->group(function () {
            Route::get('/', [trangchuController::class, 'hanghoa'])->name('index');
            Route::get('thongtinhanghoa', [hangController::class,'index'])->name('showhanghoa');
            Route::get('themthanghoa', [hangController::class,'create'])->name('gethanghoa');
            Route::post('posthanghoa', [hangController::class,'store'])->name('posthanghoa');
            Route::get('edithanghoa/{id}', [hangController::class,'edit'])->name('edithanghoa');
            Route::put('updatehanghoa', [hangController::class,'update'])->name('updatehanghoa');
            Route::delete('deletehanghoa{id}', [hangController::class,'destroy'])->name('deletehanghoa');
        });
    });
});



