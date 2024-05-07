@extends('admin.layouts.app')
@section('title','Brand List')
@push('css') @endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Brand List</h4>

                <div class="page-title-right">
                    <a href="{{ route('admin.brands.create') }}" class="btn btn-sm btn-primary">
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
                                <th>Icon</th>
                                <th>Product Count</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($brands as $brand)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $brand->name ?? '' }}</td>
                                    <td>
                                        @if($brand->logo != Null && file_exists($brand->logo))
                                            <img src="{{ asset($brand->logo) }}"
                                                 class="avatar-sm rounded-3 d-block ">
                                        @else
                                            <img src="{{ asset('assets/common/images/ecommerce.png') }}"
                                                 class="avatar-sm rounded-3 d-block">
                                        @endif
                                    </td>
                                    <td>{{ $brand?->products?->count() ?? 0 }}</td>
                                    <td>
                                        <span>{{ $brand->status === 'active' ? 'Active' : 'In Active' }}</span>
                                    </td>
                                    <td>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                           href="{{ route('admin.brands.edit',$brand->slug) }}"
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
                        {{ $brands->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js') @endpush
