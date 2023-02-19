<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});

//お問い合わせフォーム
Route::get('/contact',[ContactController::class,'index'])->name('contact');
Route::post('/contact',[ContactController::class,'sendMail']);
Route::get('/contact/complete',[ContactController::class,'complete'])->name('contact.complete');


/*管理画面
Route::prefix('/admin')
->name('admin')
->group(function (){
    Route::middleware('auth')
    ->group(function (){
            //ブログ
            Route::resource('/blogs',AdminBlogController::class)->except('show');

            Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    });

    Route::middleware('guest')
    ->group(function(){


    //認証
    Route::get('/login',[AuthController::class,'showLoginForm'])->name('login');
    Route::post('/login',[AuthController::class,'login']);
    });

});

//ユーザ管理
Route::get('/admin/users/create',[UserController::class,'create'])->name('admin.users.create');
Route::post('/admin/users/users',[UserController::class,'store'])->name('admin.users.store');*/
/*Route::prefix('/admin')
->name('admin.')
->group(function() {
    // ログイン時のみアクセス可能なルート
     Route::middleware('auth')->group(function() {
         // ブログ
         Route::resource('/blogs', AdminBlogController::class)->except('show');

         // ログアウト
         Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

         // ユーザー管理
         Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
         Route::post('/users', [UserController::class, 'store'])->name('users.store');
     });

     // 未ログイン時のみアクセス可能なルート
     Route::middleware('guest')->group(function() {
         // 認証
         Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
         Route::post('/login', [AuthController::class, 'login']);
     });
 });
*/
Route::get('/admin/blogs',[AdminBlogController::class,'index'])->name('admin.blogs.index')->middleware('auth');
Route::get('/admin/blogs/create',[AdminBlogController::class,'create'])->name('admin.blogs.create')->middleware('auth');
Route::post('/admin/blogs',[AdminBlogController::class,'store'])->name('admin.blogs.store')->middleware('auth');
Route::get('/admin/blogs/{blog}',[AdminBlogController::class,'edit'])->name('admin.blogs.edit')->middleware('auth');
Route::put('/admin/blogs/{blog}',[AdminBlogController::class,'update'])->name('admin.blogs.update')->middleware('auth');
Route::delete('/admin/blogs/{blog}',[AdminBlogController::class,'destroy'])->name('admin.blogs.destroy')->middleware('auth');

//Route::get()
