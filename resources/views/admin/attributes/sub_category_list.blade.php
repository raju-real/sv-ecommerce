@extends('admin.layouts.app')
@section('title','Sub Category List')
@push('css') @endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Sub Category List</h4>

                <div class="page-title-right">
                    <a href="{{ route('admin.subcategories.create') }}" class="btn btn-sm btn-primary">
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
                                <th>Icon</th>
                                <th>Product Count</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($subcategories as $subcategory)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $subcategory->name ?? '' }}</td>
                                    <td>{{ $subcategory?->category?->name ?? '' }}</td>
                                    <td>
                                        @if($subcategory->icon != Null && file_exists($subcategory->icon))
                                            <img src="{{ asset($subcategory->icon) }}"
                                                 class="avatar-sm rounded-3 d-block ">
                                        @else
                                            <img src="{{ asset('assets/common/images/ecommerce.png') }}"
                                                 class="avatar-sm rounded-3 d-block">
                                        @endif
                                    </td>
                                    <td>{{ $subcategory?->products?->count() ?? 0 }}</td>
                                    <td>
                                        <span>{{ $subcategory->status === 'active' ? 'Active' : 'In Active' }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.subcategories.edit',$subcategory->slug) }}"
                                           class="btn btn-sm btn-success" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger delete-data"
                                           data-id="{{ 'delete-sub-category-'.$subcategory->id }}"
                                           href="javascript:void(0);">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form id="delete-sub-category-{{ $subcategory->id }}"
                                              action="{{ route('admin.subcategories.destroy',$subcategory->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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
                        {{ $subcategories->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js') @endpush
