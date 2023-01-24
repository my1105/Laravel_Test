<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class RequestSampleController extends Controller
{
    
    public function queryStrings(Request $request)
    {
        $keyword = $request->get('keyword','未設定');
        return 'キーワードは'.$keyword.'です。';
     }

     public function profile($id)
     {
        return 'IDは'.$id.'です。';
     }

     public function productsArchive(Request $request,$category,$year)
     {
        return 'category:'.$category.'<br>year:'.$year.'<br>page:'.$request->get('page',default:1);
     }
     
     public function routelink()
     {
        $url = route('profile',['id'=>1,'photos'=> 'yes']);
        return $url;
     }
     
     public function form()
     {
        return view('form');
     }

     public function loginForm()
     {
        return view('login');
     }

     public function login(Request $request)
    {
    if ($request->get('email') === 'user@example.com' && $request->get('password') === '12345678') {
        return 'ログイン成功';
    }
    return 'ログイン失敗';
    }
}
