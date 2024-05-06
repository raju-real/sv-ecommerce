@extends('admin.layouts.app')
@section('title','Sub Subcategory List')
@push('css') @endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Sub Subcategory List</h4>

                <div class="page-title-right">
                    <a href="{{ route('admin.sub-subcategories.create') }}" class="btn btn-sm btn-primary">
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
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Icon</th>
                                <th>Product Count</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sub_subcategories as $sub_subcategory)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $sub_subcategory->name ?? '' }}</td>
                                    <td>{{ $sub_subcategory?->category?->name ?? '' }}</td>
                                    <td>{{ $sub_subcategory?->subcategory?->name ?? '' }}</td>
                                    <td>
                                        @if($sub_subcategory->icon != Null && file_exists($sub_subcategory->icon))
                                            <img src="{{ asset($sub_subcategory->icon) }}"
                                                 class="avatar-sm rounded-3 d-block ">
                                        @else
                                            <img src="{{ asset('assets/common/images/ecommerce.png') }}"
                                                 class="avatar-sm rounded-3 d-block">
                                        @endif
                                    </td>
                                    <td>{{ $sub_subcategory?->products?->count() ?? 0 }}</td>
                                    <td>
                                        <span>{{ $sub_subcategory->status === 'active' ? 'Active' : 'In Active' }}</span>
                                    </td>
                                    <td>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href="{{ route('admin.sub-subcategories.edit',$sub_subcategory->slug) }}"
                                           class="btn btn-sm btn-soft-success"><i class="fa fa-edit"></i></a>
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
                        {{ $sub_subcategories->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js') @endpush
