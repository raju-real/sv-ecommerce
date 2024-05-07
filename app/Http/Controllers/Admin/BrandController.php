<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(20);
        return view('admin.attributes.brand_list', compact('brands'));
    }

    public function create()
    {
        $route = route('admin.brands.store');
        return view('admin.attributes.brand_add_edit', compact('route'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('brands', 'name')->whereNull('deleted_at')
            ],
            'logo' => 'nullable|sometimes|mimes:jpg,jpeg,png|max:1024',
            'status' => 'required|max:10|in:active,in-active'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        if ($request->file('logo')) {
            $brand->logo = uploadImage($request->file('logo'), 'brand');
        }
        $brand->status = $request->status;
        $brand->created_by = Auth::id();
        $brand->save();
        return redirect()->route('admin.brands.index')->with(successMessage());
    }


    public function edit($slug)
    {
        $brand = Brand::whereSlug($slug)->first();
        $route = route('admin.brands.update', $brand->id);
        return view('admin.attributes.brand_add_edit', compact('brand', 'route'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('brands', 'name')->whereNull('deleted_at')->ignore($id),
            ],
            'logo' => 'nullable|sometimes|mimes:jpg,jpeg,png|max:1024',
            'status' => 'required|max:10|in:active,in-active'
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        if ($request->file('logo')) {
            $brand->logo = uploadImage($request->file('logo'), 'brand');
        }
        $brand->status = $request->status;
        $brand->created_by = Auth::id();
        $brand->save();
        return redirect()->route('admin.brands.index')->with(infoMessage());
    }


    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();
        return redirect()->route('admin.brands.index')->with(deleteMessage());
    }
}
