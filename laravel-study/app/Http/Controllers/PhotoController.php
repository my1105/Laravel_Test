<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        return view('photos.create');
    }

    
    public function store(Request $request)
    {
        $savedFilePath = $request->file('image')->store('photos','public');
        Log::debug($savedFilePath);
        $fileName = pathinfo($savedFilePath,PATHINFO_BASENAME);
        Log::debug($fileName);


        return to_route('photos.show',['photo'=>$fileName])->with('success','アップロードしました。');
    }

    //画像の表示
    public function show($fileName)
    {
        return view('photos.show',['fileName'=>$fileName]);
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($fileName)
    {
        Storage::disk('public')->delete('photos/'.$fileName);
        return to_route('photos.create')->with('success','削除しました');
    }

    public function download($fileName)
    {
        return Storage::disk('public')->download('photos/'.$fileName,'アップロード画像.jpg');

    }
}
