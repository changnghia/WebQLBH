<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use  App\Models\Cart;
use  App\Models\Product;


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

Route::get('/index.html',[CategoryController::class,'index'] )->name('indexuser');
Route::get('/fruit.html',[CategoryController::class,'indexfruit'] )->name('product.all')->middleware(['verified']);
Route::post('/search',[CategoryController::class,'search'] )->name('product.search');
Route::get('/fruit',[CategoryController::class,'indexfruitDK'] )->name('product.dm')->middleware(['verified']);
Route::get('/chitietsanpham',[CategoryController::class,'chitietsp'] )->name('chitietsp')->middleware(['verified']);
Route::get('/gio-hang-cua-ban',[CartController::class,'tanggiam'])->name('tanggiam');
Route::get('/In_PDF/{ID}',[PDFController::class,'In_PDF'])->name('In_PDF');


Route::post('/chitietsanpham/themvaogio',[CategoryController::class,'themvaogio'])->name('themvaogio')->middleware(['auth']);


Route::get('/don-hang-cua-ban',[CategoryController::class,'donhanguser'])->name('donhanguser')->middleware(['auth','verified']);
Route::get('/chi-tiet-don-hang-cua-ban',[CategoryController::class,'chitietdonhanguser'])->name('chitietdonhanguser')->middleware(['auth','verified']);
Route::get('/huy-don-hang-cua-ban',[CategoryController::class,'huydonhang'])->name('huydonhang')->middleware(['auth']);

Route::get('/Dathang',[CartController::class,'dathangthanhcong'])->name('hoanthanh')->middleware(['auth','verified']);
Route::get('/mailvnpay',[CartController::class,'mailvnpay'])->name('mailvnpay')->middleware(['auth']);
Route::get('/huydathang', function () {
  
    return view('huydathang');
})->middleware(['auth']);


Route::get('/about.html', function () {
    if(auth()->check()){
    $hover=Cart::where('id_user',auth()->user()->id)->get();
    return view('about')->with('hover',$hover);
}else{
    return view('about')->with('kiemtralogin','check');
}
});

Route::get('/thanhtoan.html', function () {
    $cart= Cart::where('id_user',auth()->user()->id)->get();
    $hover=Cart::where('id_user',auth()->user()->id)->get();
    $pd=Product::all();
    return view('thanhtoan')->with('hover',$hover)->with('cart',$cart)->with('pd',$pd);
})->name('thanhtoan')->middleware(['auth']);



Route::get('/contact.html', function () {
    if(auth()->check()){
        $hover=Cart::where('id_user',auth()->user()->id)->get();
        return view('contact')->with('hover',$hover);
    }else{
        return view('contact')->with('kiemtralogin','check');
    }
});

Route::get('/testimonial.html', function () {

    if(auth()->check()){
        $hover=Cart::where('id_user',auth()->user()->id)->get();
        return view('testimonial')->with('hover',$hover);
    }else{
        return view('testimonial')->with('kiemtralogin','check');
    }
});
Route::resource('/',CategoryController::class);
Route::resource('/Cart',CartController::class)->middleware(['auth']);
Route::resource('/Product',ProductController::class);

Route::prefix('admin')->middleware('Role')->group(function (){    
Route::get('/bangdieukhien', function () {
 
    return view('spica.index');

})->name('bangdieukhien');

Route::get('/danhsachsanpham', [ProductController::class,'index'] )->name('danhsachsanpham');
Route::post('/search-tukhoa', [ProductController::class,'searchdssp'] )->name('searchdssp');
Route::post('/searchdsspdm', [ProductController::class,'searchdsspdm'])->name('searchdsspdm');



Route::get('/DanhMucAdmin', [CategoryController::class,'DanhMucAdmin'] )->name('DanhMucAdmin');
Route::DELETE('/deletedm/{id}', [CategoryController::class,'deletedm'] )->name('deletedm');
Route::get('/{id}/edit', [CategoryController::class,'edit'] )->name('editDanhMucAdmin');
Route::PUT('/update/{id}', [CategoryController::class,'update'] )->name('updateDanhMucAdmin');
Route::get('/themdanhmuc', [CategoryController::class,'create'] )->name('createDanhMucAdmin');
Route::post('/Taodanhmuc', [CategoryController::class,'store'] )->name('storeDanhMucAdmin');

Route::get('/listdonhang', [CartController::class,'indexbill'] )->name('indexbill');

Route::get('/{Cart}/editdonhang', [CartController::class,'editdonhang'])->name('editdonhang');
Route::get('/viewctbill', [CartController::class,'indexctbill'])->name('indexctbill');

Route::post('/{Cart}/updatetrangthai', [CartController::class,'updatetrangthai'])->name('updatetrangthai');

Route::PUT('/{Cart}/updatedonhang', [CartController::class,'updatedonhang'])->name('updatedonhang');

Route::get('/danhsach-taikhoan', [CartController::class,'taikhoan'])->name('taikhoan');
Route::get('/{Cart}/taikhoan-edit', [CartController::class,'edittaikhoan'])->name('edittaikhoan');
Route::PUT('/{Cart}/updatetaikhoan', [CartController::class,'updatetaikhoan'])->name('updatetaikhoan');
Route::DELETE('/xoataikhoan/{Cart}', [CartController::class,'xoataikhoan'] )->name('xoataikhoan');
Route::get('/phanquyen', [CartController::class,'phanquyen'])->name('phanquyen');
Route::post('/{Cart}/updaterole', [CartController::class,'updaterole'])->name('updaterole');
Route::post('/{Cart}/updateroleuser', [CartController::class,'updateroleuser'])->name('updateroleuser');

Route::get('/Nhapkho', [CartController::class,'Nhapkho'])->name('Nhapkho');
Route::POST('/savekho', [CartController::class,'savekho'])->name('savekho');

Route::get('/Thongke', [CartController::class,'Thongke'])->name('Thongke');
Route::GET('/searchmonth', [CartController::class,'searchmonth'])->name('searchmonth');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
