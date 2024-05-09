@extends('admin.layouts.app')
@section('title','Product List')
@push('css') @endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Product List</h4>

                <div class="page-title-right">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus-circle"></i> Add New
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0 text-nowrap">
                            <thead>
                            <tr>
                                <th>Sl.no</th>
                                <th>Thumbnail</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Unit Price</th>
                                <th>Discount Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $product->name ?? '' }}</td>
                                    <td>
                                        @if($product->thumbnail_path != Null && file_exists($product->thumbnail_path))
                                            <img src="{{ asset($product->thumbnail_path) }}"
                                                 class="avatar-sm rounded-3 d-block ">
                                        @else
                                            <img src="{{ asset('assets/common/images/ecommerce.png') }}"
                                                 class="avatar-sm rounded-3 d-block">
                                        @endif
                                    </td>
                                    <td>{{ $product?->category?->name ?? '' }}</td>
                                    <td>{{ $product->unit_price ?? 0 }}</td>
                                    <td>{{ $product->discount_price ?? 0 }}</td>
                                    <td>
                                        <span>{{ $product->status === 'active' ? 'Active' : 'In Active' }}</span>
                                    </td>
                                    <td>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Show Details"
                                           href="{{ route('admin.products.show',$product->slug) }}"
                                           class="btn btn-sm btn-soft-info"><i class="fa fa-eye"></i>
                                        </a>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                           href="{{ route('admin.products.edit',$product->slug) }}"
                                           class="btn btn-sm btn-soft-success"><i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <x-no-data-found></x-no-data-found>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-lg-12">
                    <ul class="pagination pagination-rounded justify-content-center mt-3 mb-4 pb-1">
                        {{ $products->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js') @endpush
