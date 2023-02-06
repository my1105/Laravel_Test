<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;


class AdminBlogController extends Controller
{
    //ブログ一覧画面
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index',['blogs'=>$blogs]);
    }

    //ブログ投稿画面
    public function create()
    {
        return view('admin.blogs.create');
    }

    //ブログ投稿処理
    public function store(StoreBlogRequest $request)
    {
        $savedImagePath = $request->file('image')->store('blogs','public');
        $blog = new Blog($request->validated());
        $blog->image = $savedImagePath;
        $blog->save();

        return to_route('admin.blogs.index')->with('success','ブログを投稿しました。');
    }


    public function show($id)
    {
        //
    }

    //指定したIDのブログの編集画面
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit',['blog' => $blog]);
    }

    //指定したIDのブログの更新処理
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
