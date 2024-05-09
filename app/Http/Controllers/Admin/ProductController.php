<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::query();
        $products = $data->latest()->paginate(20);
        return view('admin.products.product_list', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();
        $colors = Color::orderBy('name')->get();
        $units = Unit::orderBy('name')->get();
        $route = route('admin.products.store');
        return view('admin.products.product_add_edit', compact('route','categories','brands','sizes','colors','units'));
    }

    public function store(ProductRequest $request)
    {
        $product = new Category();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        if ($request->file('icon')) {
            $product->icon = uploadImage($request->file('icon'), 'products');
        }
        $product->status = $request->status;
        $product->created_by = Auth::id();
        $product->save();
        return redirect()->route('admin.products.index')->with(successMessage());
    }


    public function edit($slug)
    {
        $product = Category::whereSlug($slug)->first();
        $route = route('admin.products.update', $product->id);
        return view('admin.products.product_add_edit', compact('product', 'route'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('sizes', 'name')->whereNull('deleted_at')->ignore($id),
            ],
            'icon' => 'nullable|sometimes|mimes:jpg,jpeg,png|max:1024',
            'status' => 'required|max:10|in:active,in-active'
        ]);

        $product = Category::findOrFail($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        if ($request->file('icon')) {
            $product->icon = uploadImage($request->file('icon'), 'products');
        }
        $product->status = $request->status;
        $product->created_by = Auth::id();
        $product->save();
        return redirect()->route('admin.products.index')->with(infoMessage());
    }


    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.products.index')->with(deleteMessage());
    }
}
