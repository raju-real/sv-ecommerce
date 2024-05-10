<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubSubcategoryController extends Controller
{
    public function index()
    {
        $sub_subcategories = SubSubcategory::latest()->paginate(20);
        return view('admin.attributes.sub_subcategory_list', compact('sub_subcategories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->select('id', 'name')->get();
        $route = route('admin.sub-subcategories.store');
        return view('admin.attributes.sub_subcategory_add_edit', compact('categories', 'route'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('sub_subcategories', 'name')->whereNull('deleted_at')
            ],
            'category' => [
                'required',
                'int',
                Rule::exists('categories', 'id')->whereNull('deleted_at'),
            ],
            'subcategory' => [
                'required',
                'int',
                Rule::exists('sub_categories', 'id')->whereNull('deleted_at'),
            ],
            'icon' => 'nullable|sometimes|mimes:jpg,jpeg,png|max:1024',
            'status' => 'required|max:10|in:active,in-active'
        ]);

        $sub_category = new SubSubcategory();
        $sub_category->category_id = $request->category;
        $sub_category->subcategory_id = $request->subcategory;
        $sub_category->name = $request->name;
        $sub_category->slug = Str::slug($request->name);
        if ($request->file('icon')) {
            $sub_category->icon = uploadImage($request->file('icon'), 'sub_category');
        }
        $sub_category->status = $request->status;
        $sub_category->created_by = Auth::id();
        $sub_category->save();
        return redirect()->route('admin.sub-subcategories.index')->with(successMessage());
    }


    public function edit($slug)
    {
        $sub_subcategory = SubSubcategory::whereSlug($slug)->first();
        $categories = Category::orderBy('name')->select('id', 'name')->get();
        $route = route('admin.sub-subcategories.update', $sub_subcategory->id);
        return view('admin.attributes.sub_subcategory_add_edit', compact('sub_subcategory', 'categories', 'route'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('sub_subcategories', 'name')->whereNull('deleted_at')->ignore($id),
            ],
            'category' => [
                'required',
                'int',
                Rule::exists('categories', 'id')->whereNull('deleted_at')
            ],
            'subcategory' => [
                'required',
                'int',
                Rule::exists('sub_categories', 'id')->whereNull('deleted_at')
            ],
            'icon' => 'nullable|sometimes|mimes:jpg,jpeg,png|max:1024',
            'status' => 'required|max:10|in:active,in-active'
        ]);

        $sub_category = SubSubcategory::findOrFail($id);
        $sub_category->category_id = $request->category;
        $sub_category->subcategory_id = $request->subcategory;
        $sub_category->name = $request->name;
        $sub_category->slug = Str::slug($request->name);
        if ($request->file('icon')) {
            $sub_category->icon = uploadImage($request->file('icon'), 'sub_category');
        }
        $sub_category->status = $request->status;
        $sub_category->created_by = Auth::id();
        $sub_category->save();
        return redirect()->route('admin.sub-subcategories.index')->with(infoMessage());
    }


    public function destroy($id)
    {
        SubCategory::findOrFail($id)->delete();
        return redirect()->route('admin.subcategories.index')->with(deleteMessage());
    }
}
