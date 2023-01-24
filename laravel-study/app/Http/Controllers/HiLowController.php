<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HiLowController extends Controller
{
    public function index() {
        $dealersNumber = random_int(1, 12);
        //セッションに保存
        session(['dealersNumber' =>$dealersNumber]);
    
        return view('hi-low.index', ['dealersNumber' => $dealersNumber]);
    }
    
    public function result(Request $request) {
        // (hidden値で送信されたもの)を取得
        $dealersNumber = session('dealersNumber');
    
        // 数字を1~12の中からランダムに取得
        $playersNumber = random_int(1, 12);
        // 数字が大きいか判定(大きい場合にtrue)
        $isHigh = $playersNumber > $dealersNumber;
        // 判定
        $isCorrect = ($isHigh && $request->get('guess') === 'high') || (!$isHigh && $request->get('guess') === 'low');
        return view('hi-low.result', [
            'dealersNumber' => $dealersNumber,
            'playersNumber' => $playersNumber,
            'isCorrect' => $isCorrect,
        ]);
    }
}
