<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('admin.attributes.category_list',compact('categories'));
    }

    public function create()
    {
        $route = route('admin.categories.store');
        return view('admin.attributes.category_add_edit',compact('route'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:50|unique:categories',
            'icon' => 'nullable|sometimes|mimes:jpg,jpeg,png|max:1024',
            'status' => 'required|max:10|in:active,in-active'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        if($request->file('icon')) {
            $category->icon = uploadImage($request->file('icon'),'category');
        }
        $category->status = $request->status;
        $category->created_by = Auth::id();
        $category->save();
        return redirect()->route('admin.categories.index')->with(successMessage());
    }


    public function edit($slug)
    {
        $category = Category::whereSlug($slug)->first();
        $route = route('admin.categories.update',$category->id);
        return view('admin.attributes.category_add_edit',compact('category','route'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:50|unique:categories,name,'.$id,
            'icon' => 'nullable|sometimes|mimes:jpg,jpeg,png|max:1024',
            'status' => 'required|max:10|in:active,in-active'
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        if($request->file('icon')) {
            $category->icon = uploadImage($request->file('icon'),'category');
        }
        $category->status = $request->status;
        $category->created_by = Auth::id();
        $category->save();
        return redirect()->route('admin.categories.index')->with(infoMessage());
    }


    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.categories.index')->with(deleteMessage());
    }
}
