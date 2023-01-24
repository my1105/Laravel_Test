<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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


        return to_route('photos.create')->with('success','アップロードしました。');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
