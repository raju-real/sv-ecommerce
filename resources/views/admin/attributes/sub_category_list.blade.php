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
            <!-- Accordion for Search -->
            <div class="accordion mb-3" id="accordionSearch">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSearch">
                        <button class="accordion-button {{ request()->query() ? '' : 'collapsed' }}" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseSearch"
                                aria-expanded="{{ request()->query() ? 'true' : 'false' }}"
                                aria-controls="collapseSearch">
                            Search
                        </button>
                    </h2>
                    <div id="collapseSearch" class="accordion-collapse collapse {{ request()->query() ? 'show' : '' }}"
                         aria-labelledby="headingSearch"
                         data-bs-parent="#accordionSearch">
                        <div class="accordion-body">
                            <form method="GET" action="{{ route('admin.subcategories.index') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="category" class="form-select">
                                                <option value="" {{ !isset(request()->category) ? 'selected' : '' }}>Category</option>
                                                @foreach(activeCategories() as $category)
                                                    <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pb-4">
                                        <div class="form-group">
                                            <input type="search" name="name" class="form-control"
                                                   placeholder="Search by Name" value="{{ request('name') ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="status" class="form-select">
                                                <option value="" {{ !isset(request()->status) ? 'selected' : '' }}>Status</option>
                                                @foreach(getStatus() as $status)
                                                    <option
                                                        value="{{ $status->value }}" {{ request('status') === $status->value ? 'selected' : '' }}>{{ $status->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-0">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
                                            <img src="{{ asset($subcategory->icon) }}" class="avatar-sm rounded-3 d-block img-50">
                                        @else
                                            <img src="{{ asset('assets/common/images/ecommerce.png') }}" class="avatar-sm rounded-3 d-block img-50">
                                        @endif
                                    </td>
                                    <td>{{ $subcategory?->products?->count() ?? 0 }}</td>
                                    <td>
                                        <span>{{ $subcategory->status === 'active' ? 'Active' : 'In Active' }}</span>
                                    </td>
                                    <td>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href="{{ route('admin.subcategories.edit',$subcategory->slug) }}"
                                           class="btn btn-sm btn-soft-success"><i class="fa fa-edit"></i></a>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-sm btn-soft-danger delete-data"
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
                <div class="d-flex justify-content-center">
                    {!! $subcategories->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js') @endpush
