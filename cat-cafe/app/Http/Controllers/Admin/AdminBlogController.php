<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\Category;
use App\Models\Cat;
use App\Models\Category as ModelsCategory;

class AdminBlogController extends Controller
{
    //ブログ一覧画面
    public function index()
    {
        $blogs = Blog::latest('updated_at')->simplepaginate(10);
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
    public function edit(Blog $blog)
    {
        $categories = ModelsCategory::all();
        $cats = Cat::all();
        return view('admin.blogs.edit',['blog' => $blog,'categories'=>$categories,'cats' => $cats]);
    }

    //指定したIDのブログの更新処理
    public function update(UpdateBlogRequest $request, $id)
    {
         $blog = Blog::findOrFail($id);
         $updateDate = $request->validated();

         if($request->has('image')){
            Storage::disk('public')->delete($blog->image);

            $updateDate['image'] = $request->file('image')->store('blogs','public');

         }
         $blog->category()->associate($updateDate['category_id']);
         $blog->cats()->sync($updateDate['cats'] ?? []);
         $blog->update($updateDate);

         return to_route('admin.blogs.index')->with('success','ブログを更新しました。');
    }

//指定したIDのブログの削除
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        Storage::disk('public')->delete($blog->image);
        return to_route('admin.blogs.index')->with('success','ブログを削除しました。');

    }
}
