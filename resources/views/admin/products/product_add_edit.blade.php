@extends('admin.layouts.app')
@section('title','Product Add/Edit')
@push('css') @endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Product Add/Edit</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $route }}" method="POST" id="prevent-form" enctype="multipart/form-data">
                        @csrf
                        @isset($category)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">SKU {!! starSign() !!}</label>
                                    <input type="text" name="sku" value="{{ old('sku') ?? $category->sku ?? '' }}"
                                           class="form-control {{ hasError('sku') }}"
                                           placeholder="SKU">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Product Code {!! starSign() !!}</label>
                                    <input type="text" name="product_code"
                                           value="{{ old('product_code') ?? $category->product_code ?? '' }}"
                                           class="form-control {{ hasError('product_code') }}"
                                           placeholder="Product Code">
                                    @error('product_code')
                                    {!! displayError($message) !!}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name {!! starSign() !!}</label>
                                    <input type="text" name="name" value="{{ old('name') ?? $category->name ?? '' }}"
                                           class="form-control {{ hasError('name') }}"
                                           placeholder="Name">
                                    @error('name')
                                    {!! displayError($message) !!}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category {!! starSign() !!}</label>
                                    <select name="category" id="category"
                                            class="form-control select2">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{ $category->id }}" {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sub Category</label>
                                    <select name="subcategory" id="subcategory"
                                            class="form-control select2 {{ hasError('subcategory') }} "
                                            data-old-value="{{ $sub_subcategory->subcategory_id ?? old('subcategory')  }}">
                                        <option value="">Select Sub Category</option>
                                        @isset($sub_subcategory)
                                            <option value="{{ $sub_subcategory->subcategory_id }}"
                                                    selected>{{ $sub_subcategory->subcategory->name ?? '' }}</option>
                                        @endisset
                                    </select>
                                    @error('subcategory')
                                    {!! displayError($message) !!}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sub Subcategory</label>
                                    <select name="sub_subcategory" id="sub_subcategory"
                                            class="form-control select2 {{ hasError('sub_subcategory') }} "
                                            data-old-value="{{ $sub_subcategory->sub_subcategory_id ?? old('sub_subcategory')  }}">
                                        <option value="">Select Sub Subcategory</option>
                                        @isset($sub_subcategory)
                                            <option value="{{ $sub_subcategory->sub_subcategory_id }}"
                                                    selected>{{ $sub_subcategory->sub_subcategory->name ?? '' }}</option>
                                        @endisset
                                    </select>
                                    @error('sub_subcategory')
                                    {!! displayError($message) !!}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label d-flex align-items-center justify-content-between">
                                        <span>Brand</span>
                                        <a type="button" class="text-primary" data-bs-toggle="modal"
                                           data-bs-target="#brand-add-modal">
                                            <i class="fa fa-plus-circle fa-xl"></i>
                                        </a>
                                    </label>
                                    <select name="brand" id="brand"
                                            class="form-control select2 {{ hasError('brand') }} ">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option
                                                value="{{ $brand->id }}" {{ old('brand') == $brand->id || isset($product) && $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name ?? '' }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label d-flex align-items-center justify-content-between">
                                        <span>Unit</span>
                                        <a type="button" class="text-primary" data-bs-toggle="modal"
                                           data-bs-target="#unit-add-modal">
                                            <i class="fa fa-plus-circle fa-xl"></i>
                                        </a>
                                    </label>
                                    <select name="unit" id="unit" class="form-control select2 {{ hasError('unit') }} ">
                                        <option value="">Select Brand</option>
                                        @foreach($units as $unit)
                                            <option
                                                value="{{ $unit->id }}" {{ old('unit') == $unit->id || isset($product) && $product->product_unit == $unit->id ? 'selected' : '' }}>{{ $unit->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                    {!! displayError($message) !!}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label d-flex align-items-center justify-content-between">
                                        <span>Sizes</span>
                                        <a type="button" class="text-primary" data-bs-toggle="modal"
                                           data-bs-target="#size-add-modal">
                                            <i class="fa fa-plus-circle fa-xl"></i>
                                        </a>
                                    </label>
                                    <select name="sizes[]" id="size" class="form-control select2" multiple="multiple"
                                            data-placeholder="Sizes ...">
                                        <option value="">Select Sizes</option>
                                        @foreach($sizes as $size)
                                            <option value="{{ $size->name }}">{{ $size->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                    {!! displayError($message) !!}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label d-flex align-items-center justify-content-between">
                                        <span>Colors</span>
                                        <a type="button" class="text-primary" data-bs-toggle="modal"
                                           data-bs-target="#color-add-modal">
                                            <i class="fa fa-plus-circle fa-xl"></i>
                                        </a>
                                    </label>
                                    <select name="colors[]" id="color" class="form-control select2" multiple="multiple"
                                            data-placeholder="Colors ...">
                                        <option value="">Select Colors</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->name }}">{{ $color->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                    {!! displayError($message) !!}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Unit Price {!! starSign() !!}</label>
                                    <input type="text" name="unit_price" value="{{ $product->unit_price ?? '' }}"
                                           class="form-control"
                                           placeholder="Unit Price">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Discount Price</label>
                                    <input type="text" name="discount_price" value="{{ $product->discount_price ?? 0 }}"
                                           class="form-control"
                                           placeholder="Discount Price">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control"
                                              placeholder="Short Description">{{ $product->short_description ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Special Note</label>
                                    <textarea name="special_note" class="form-control"
                                              placeholder="Special Note">{{ $product->special_note ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Video Link</label>
                                    <input type="text" name="video_link" value="{{ $product->video_link ?? '' }}"
                                           class="form-control"
                                           placeholder="Video Link">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Product Details</label>
                                    <textarea class="form-control" name="product_details"
                                              id="product_details">{{ old('product_details') ?? $product->product_details ?? '' }}</textarea>
                                    @error('product_details')
                                    {!! displayError($message) !!}
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Refundable {!! starSign() !!}</label>
                                            <select name="is_refundable"
                                                    class="form-select select2-search-disable">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Exchangeable {!! starSign() !!}</label>
                                            <select name="is_exchangeable"
                                                    class="form-select select2-search-disable">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status {!! starSign() !!}</label>
                                            <select name="status"
                                                    class="form-select select2-search-disable {{ hasError('status') }}">
                                                @foreach(getStatus() as $status)
                                                    <option
                                                        value="{{ $status->value }}" {{ isset($product) && $product->status === $status->value ? 'selected' : '' }}>{{ $status->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Product Thumbnail (Type:jpg,jpeg,png, Max:
                                            1MB) {!! starSign() !!}</label>
                                        <input type="file" name="icon" class="form-control {{ hasError('icon') }}"
                                               accept=".jpg,jpeg,.png">
                                        @error('icon')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <table class="table w-100" id="image_table">
                                            <thead>
                                            <tr class="form-label">
                                                <th>Product Images (Type:jpg,jpeg,png, Max: 1MB) {!! starSign() !!}</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-md btn-success" id="add_image">Add Image
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <x-submit-button></x-submit-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="brand-add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="brand-add-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mb-3">
                            <label class="col-form-label">Name {!! starSign() !!}</label>
                            <input type="text" name="name" placeholder="Name"
                                   class="form-control brand-form-control brand-name-input">
                            <span id="brand_name_error"
                                  class="text-danger font-weight-bold brand-error-message"></span>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Logo (Type:jpg,jpeg,png, Max: 1MB)</label>
                            <input type="file" name="logo" class="form-control brand-form-control brand-logo-input"
                                   accept=".jpg,jpeg,.png">
                            <span id="brand_logo_error"
                                  class="text-danger font-weight-bold brand-error-message"></span>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Status {!! starSign() !!}</label>
                            <select name="status" class="form-select brand-form-control brand-status-input">
                                @foreach(getStatus() as $status)
                                    <option
                                        value="{{ $status->value }}">{{ $status->title }}</option>
                                @endforeach
                            </select>
                            <span id="brand_status_error"
                                  class="text-danger font-weight-bold brand-error-message"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary brand-add-button">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unit-add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="unit-add-form" method="POST">
                        @csrf
                        <div class="col-12 mb-3">
                            <label class="col-form-label">Name {!! starSign() !!}</label>
                            <input type="text" name="name" placeholder="Name" class="form-control unit-form-input">
                            <span id="unit_name_error"
                                  class="text-danger font-weight-bold"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary unit-add-button">Submit</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="size-add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Size</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="size-add-form" method="POST">
                        @csrf
                        <div class="col-12 mb-3">
                            <label class="col-form-label">Name {!! starSign() !!}</label>
                            <input type="text" name="name" placeholder="Name" class="form-control size-form-input">
                            <span id="size_name_error"
                                  class="text-danger font-weight-bold"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary size-add-button">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="color-add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Color</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="color-add-form" method="POST">
                        @csrf
                        <div class="col-12 mb-3">
                            <label class="col-form-label">Name {!! starSign() !!}</label>
                            <input type="text" name="name" placeholder="Name" class="form-control color-form-input">
                            <span id="color_name_error"
                                  class="text-danger font-weight-bold"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary color-add-button">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/admin/js/custom/product_add_edit.js') }}"></script>
@endpush
