<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::latest()->paginate(20);
        return view('admin.attributes.sub_category_list', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->select('id', 'name')->get();
        $route = route('admin.subcategories.store');
        return view('admin.attributes.sub_category_add_edit', compact('categories', 'route'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:sub_categories',
            'category' => 'required|int|exists:categories,id',
            'icon' => 'nullable|sometimes|mimes:jpg,jpeg,png|max:1024',
            'status' => 'required|max:10|in:active,in-active'
        ]);

        $sub_category = new SubCategory();
        $sub_category->category_id = $request->category;
        $sub_category->name = $request->name;
        $sub_category->slug = Str::slug($request->name);
        if ($request->file('icon')) {
            $sub_category->icon = uploadImage($request->file('icon'), 'sub_category');
        }
        $sub_category->status = $request->status;
        $sub_category->created_by = Auth::id();
        $sub_category->save();
        return redirect()->route('admin.subcategories.index')->with(successMessage());
    }


    public function edit($slug)
    {
        $subcategory = SubCategory::whereSlug($slug)->first();
        $categories = Category::orderBy('name')->select('id', 'name')->get();
        $route = route('admin.subcategories.update', $subcategory->id);
        return view('admin.attributes.sub_category_add_edit', compact('subcategory', 'categories', 'route'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:sub_categories,name,' . $id,
            'category' => [
                'required',
                'int',
                Rule::exists('categories', 'id')->whereNull('deleted_at'),
            ],
            'icon' => 'nullable|sometimes|mimes:jpg,jpeg,png|max:1024',
            'status' => 'required|max:10|in:active,in-active'
        ]);

        $sub_category = SubCategory::findOrFail($id);
        $sub_category->name = $request->name;
        $sub_category->category_id = $request->category;
        $sub_category->slug = Str::slug($request->name);
        if ($request->file('icon')) {
            $sub_category->icon = uploadImage($request->file('icon'), 'sub_category');
        }
        $sub_category->status = $request->status;
        $sub_category->created_by = Auth::id();
        $sub_category->save();
        return redirect()->route('admin.subcategories.index')->with(infoMessage());
    }


    public function destroy($id)
    {
        SubCategory::findOrFail($id)->delete();
        return redirect()->route('admin.subcategories.index')->with(deleteMessage());
    }
}
