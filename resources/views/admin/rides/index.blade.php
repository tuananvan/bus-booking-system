@extends('adminlte::page')

@section('title', 'Rides')

@section('content_header')
    <h1>Chuyến đi</h1>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card card-outline card-indigo elevation-2">
                    <div class="card-header">
                        <h4>Quản lí chuyến đi</h4>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('admin.rides.create') }}" class="btn btn-dark mb-3">
                            <i class="fas fa-fw fa-plus"></i>
                            Thêm chuyến đi
                        </a>

                        <ul class="nav nav-tabs justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link {{ !in_array(request()->get('state'), ['active', 'inactive']) ? 'active' : ''}}"
                                   href="{{ route('admin.rides.index') }}">
                                    Tất cả
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->get('state') == 'active' ? 'active' : '' }}"
                                   href="{{ route('admin.rides.index', ['state' => 'active']) }}">
                                    Hoạt động
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->get('state') == 'inactive' ? 'active' : '' }}"
                                   href="{{ route('admin.rides.index', ['state' => 'inactive']) }}">
                                    Không hoạt động</a>
                            </li>
                        </ul>

                        <div class="table-responsive mt-2">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('adminlte_js')
    {{$dataTable->scripts()}}
@endpush
