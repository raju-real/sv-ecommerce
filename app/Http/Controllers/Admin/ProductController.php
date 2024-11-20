<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Tag;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $tags = Tag::orderBy('name')->get();
        $route = route('admin.products.store');
        return view('admin.products.product_add_edit', compact('route','categories','brands','sizes','colors','units','tags'));
    }

    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();
        $product = new Product();
        $product->product_code = $request->product_code;
        $product->name = $request->name;
        $product->slug = Str::slug($validatedData['product_code'].'-'.$validatedData['name']);
        $product->category_id = $validatedData['category'];
        $product->subcategory_id = $validatedData['subcategory'];
        $product->sub_subcategory_id = $validatedData['sub_subcategory'];
        $product->brand_id = $validatedData['brand'];
        $product->product_unit = $validatedData['unit'];
        $product->product_details = $validatedData['product_details'];
        $product->short_description = $validatedData['short_description'];
        $product->special_note = $validatedData['special_note'];
        $product->warranty = $validatedData['warranty'] ?? Null;
        $product->unit_price = $validatedData['unit_price'];
        $product->discount_price = $validatedData['discount_price'];
        $product->sku = $validatedData['sku'];
        $product->alert_quantity = $validatedData['alert_quantity'];
        $product->video_link = $validatedData['video_link'];

        if ($request->hasFile('product_thumbnail')) {
            $product->thumbnail_path = uploadImage($request->file('product_thumbnail'), 'products');
        }
        $product->product_sizes = count($request->sizes) ? implode(',',$request->sizes) : Null;
        $product->product_colors = count($request->colors) ? implode(',',$request->colors) : Null;
        $product->product_tags = count($request->tags) ? implode(',',$request->tags) : Null;
        $product->is_exchangeable = $request->is_exchangeable;
        $product->is_refundable = $request->is_refundable;
        $product->status = $request->status;
        $product->created_by = Auth::id();
        $product->updated_by = Auth::id();
        $product->save();
        if($request->hasfile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $product_image = new ProductImage();
                $product_image->product_id = $product->id;
                if (isset($request->file('images')[$key])) {
                    $product_image->image_path = uploadImage($image, 'products');
                }
                $product_image->save();
            }
        }
        if($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product has been saved successfully!'
            ]);
        } else {
            return redirect()->route('admin.products.index')->with(successMessage());
        }
    }


    public function edit($slug)
    {
        $product = Product::whereSlug($slug)->first();
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
