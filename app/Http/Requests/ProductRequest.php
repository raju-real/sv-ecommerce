<?php

namespace App\Http\Requests;

use App\Rules\DiscountPriceRule;
use App\Rules\PriceValidateRule;
use App\Rules\ProductColorRule;
use App\Rules\ProductSizeRule;
use App\Rules\ProductTagRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        //dd($this->all());
        $recordId = $this->route('product') ? $this->route('product') : null;
        return [
            'product_code' => ['required','max:10','unique:products'],
            'name' => ['required','string','max:191'],
            'category' => ['required','int','exists:categories,id'],
            'subcategory' => ['nullable','sometimes','int','exists:sub_categories,id'],
            'sub_subcategory' => ['nullable','sometimes','int','exists:sub_subcategories,id'],
            'brand' => ['nullable','sometimes','int','exists:brands,id'],
            'unit' => ['nullable','sometimes','int','exists:units,id'],
            'sizes' => ['nullable','sometimes','array'],
            'sizes.*' => ['required', new ProductSizeRule()],
            'colors' => ['nullable','sometimes','array'],
            'colors.*' => ['required', new ProductColorRule()],
            'tags' => ['nullable','sometimes','array'],
            'tags.*' => ['required', new ProductTagRule()],
            'unit_price' => ['required', 'gt:0', new PriceValidateRule()],
            'discount_price' => ['required', new DiscountPriceRule, new PriceValidateRule()],
            'short_description' => ['nullable','sometimes','string','max:2000'],
            'special_note' => ['nullable','sometimes','string','max:2000'],
            'video_link' => ['nullable','sometimes','string','url','max:255'],
            'product_details' => ['required','max:5000'],
            'sku' => ['required','int','min:0'],
            'alert_quantity' => ['required','int','min:0'],
            'product_thumbnail' => ['required','image','mimes:jpg,jpeg,png','max:1024'],
            'is_refundable' => ['required','in:0,1'],
            'is_exchangeable' => ['required','in:0,1'],
            'status' => ['required','in:active,in-active'],
            'warranty' => ['nullable','sometimes','max:2000'],
            'images' => ['nullable','sometimes','array'],
            'images.*' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:1024']
        ];
    }
}
