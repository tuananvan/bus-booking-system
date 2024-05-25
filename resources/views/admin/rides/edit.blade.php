@extends('adminlte::page')

@section('title', 'Edit ride')

@section('content_header')
    <h1>Chuyến đi</h1>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-outline card-primary elevation-2">
                    <div class="card-header">
                        <h4>Chỉnh sửa chuyến</h4>
                    </div>

                    <form action="{{ route('admin.rides.update', $ride) }}" method="POST">
                        <div class="card-body">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="route">Tuyến đường</label>
                                <select name="route_id" id="route" required
                                        class="custom-select @error('route_id') is-invalid @enderror">
                                    <option value="" hidden>Chọn tuyến đường</option>
                                    @foreach($routes as $route)
                                        <option
                                            value="{{ $route->id }}" {{ old('route_id', $ride->route->id) == $route->id ? "selected" : ""}}>
                                            {{ $route->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('route_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="bus">Xe buýt</label>
                                <select name="bus_id" id="bus" required
                                        class="custom-select @error('bus_id') is-invalid @enderror">
                                    <option value="" hidden>Chọn xe buýt</option>
                                    @foreach($buses as $bus)
                                        <option
                                            value="{{ $bus->id }}" {{ old('bus_id', $ride->bus->id) == $bus->id ? "selected" : ""}}>
                                            {{ $bus->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('bus_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="departure-time">Giờ khởi hành</label>
                                <input type="time" class="form-control @error('bus_id') is-invalid @enderror" required
                                       name="departure_time" id="departure-time"
                                       value="{{ old('departure_time', $ride->departure_time->format('H:i')) }}">

                                @error('departure_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox"
                                           name="auto_confirm" value="1" id="auto-confirm"
                                        {{ old('auto_confirm', $ride->auto_confirm) ? "checked" : "" }}>

                                    <label class="custom-control-label" for="auto-confirm">
                                        Xác nhận tự động
                                    </label>
                                </div>

                                @error('auto_confirm')
                                    <span class="invalid-feedback" style="display: block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group text-center mt-4">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="ride_type"
                                           id="ride-type-single"
                                           value="single" {{ (! $ride->isCyclic() && ! old('ride_type'))
                                                                || old('ride_type') == 'single' ? "checked" : "" }}>
                                    <label class="custom-control-label" for="ride-type-single">
                                        Chuyến 1 chiều
                                    </label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="ride_type"
                                           id="ride-type-cyclic"
                                           value="cyclic" {{ ($ride->isCyclic() && ! old('ride_type'))
                                                                || old('ride_type') == 'cyclic' ? "checked" : "" }}>
                                    <label class="custom-control-label" for="ride-type-cyclic">
                                        Chuyến khứ hồi
                                    </label>
                                </div>

                                @error('ride_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div id="singleRideInputsWrapper"
                                 style="display: {{ ($ride->isCyclic() && ! old('ride_type'))
                                                    || old('ride_type') == 'cyclic' ? "none" : "block" }}">
                                <div class="form-group">
                                    <label for="ride-date">Ride date</label>
                                    <input type="date" name="ride_date" id="ride-date" required
                                           class="form-control @error('ride_date') is-invalid @enderror datepicker"
                                           value="{{ old('ride_date', $ride->ride_date ? $ride->ride_date->format('Y-m-d') : '') }}"
                                        {{ ($ride->isCyclic() && ! old('ride_type'))
                                            || old('ride_type') == 'cyclic' ? "disabled" : "" }}>

                                    @error('ride_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="cyclicRideInputsWrapper"
                                 style="display: {{ (! $ride->isCyclic() && ! old('ride_type'))
                                                    || old('ride_type') == 'single' ? "none" : "block" }}">
                                <div class="form-group">
                                    @foreach($days as $day)
                                        <div class="custom-control custom-switch">
                                            <input class="custom-control-input day-checkbox" type="checkbox"
                                                   name="days[{{ $day }}]" value="1" id="{{ $day }}"
                                                {{ (! $ride->isCyclic() && ! old('ride_type'))
                                                    || old('ride_type') == 'single' ? "disabled" : "" }}
                                                {{  ($ride->schedule && $ride->schedule->$day && ! old('ride_type'))
                                                    || isset(old('days')[$day]) ? "checked" : "" }}>

                                            <label class="custom-control-label" for="{{ $day }}">
                                                {{ ucfirst($day) }}
                                            </label>
                                        </div>
                                    @endforeach

                                    @error('days')
                                        <span class="invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="start-date">Ngày bắt đầu</label>
                                    <input type="date" name="start_date" id="start-date" required
                                           class="form-control @error('start_date') is-invalid @enderror datepicker"
                                           value="{{ old('start_date',
                                                        isset($ride->schedule->start_date) ? $ride->schedule->start_date->format('Y-m-d') : '') }}"
                                        {{ (! $ride->isCyclic() && ! old('ride_type'))
                                            || old('ride_type') == 'single' ? "disabled" : "" }}>

                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="end-date">Ngày cuối</label>
                                    <input type="date" name="end_date" id="end-date"
                                           class="form-control @error('end_date') is-invalid @enderror datepicker"
                                           value="{{ old('end_date', isset($ride->schedule->end_date) ? $ride->schedule->end_date->format('Y-m-d') : '') }}"
                                        {{ (! $ride->isCyclic() && ! old('ride_type'))
                                            || old('ride_type') == 'single' ? "disabled" : "" }}>
                                    <small class="form-text text-muted">
                                        Leave blank to make the ride cycle endless
                                    </small>

                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer row justify-content-center">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Lưu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('adminlte_js')
    @include('admin.rides.scripts.scripts')
@endpush
