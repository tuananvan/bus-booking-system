@extends('adminlte::page')

@section('title', 'Add user')

@section('content_header')
    <h1>Người dùng</h1>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-outline card-primary elevation-2">
                    <div class="card-header">
                        <h4>Tạo người dùng mới</h4>
                    </div>

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        <div class="card-body">
                            @csrf

                            <div class="form-group">
                                <label for="first-name">Họ</label>
                                <input type="text" name="first_name" id="first-name"
                                       class="form-control @error('first_name') is-invalid @enderror"
                                       value="{{ old('first_name') }}" required autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="last-name">Tên</label>
                                <input type="text" name="last_name" id="last-name"
                                       class="form-control @error('last_name') is-invalid @enderror"
                                       value="{{ old('last_name') }}" required>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       value="{{ old('password') }}" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Roles</label>
                                @foreach($roles as $role)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                               id="{{ "$role->name-role" }}"
                                               class="custom-control-input @error('roles') is-invalid @enderror">
                                        <label class="custom-control-label" for="{{ "$role->name-role" }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('roles')
                                    <span class="invalid-feedback" style="display: block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer row justify-content-center">
                            <div class="col-5">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
