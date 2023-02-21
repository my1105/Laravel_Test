<?php

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
    return view('welcome');
});

Route::get('/quizzes', function () {
    return view('quizzes.index');
});

Route::get('quizzes/show',function(){
    return view('quizzes.show');
});

Route::get('quizzes/create',function(){
    return view('quizzes.create');
});


Route::delete('quizzes/{id}', function ($id) {
    return json_encode(['message' => 'ID:'.$id.' が削除されるIDもです(仮の出力)']);
});
