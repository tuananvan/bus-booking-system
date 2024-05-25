@extends('adminlte::page')

@section('title', 'Route details')

@section('content_header')
    <h1>Rides</h1>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card card-outline card-primary elevation-2">
                    <div class="card-header">
                        <h4>Chi tiết chuyến đi</h4>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row">Id</th>
                                <td>{{ $ride->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tuyến đường</th>
                                <td>
                                    <a href="{{ route('admin.routes.show', $ride->route) }}">
                                        {{ "{$ride->route->id}. {$ride->route->name}" }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Xe bus</th>
                                <td>{{ "{$ride->bus->name} ({$ride->bus->seats} seats)" }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Thời gian khởi hành</th>
                                <td>{{ $ride->departure_time->format('H:i') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Thời gian đến</th>
                                <td>{{ $ride->getArrivalTimeToLocation() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kiểu chuyến</th>
                                <td>{{ $ride->ride_date ? 'Single' : 'Cyclic' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Hiệu lực</th>
                                <td>{{ $ride->isActive() ? 'Yes' : 'No' }}</td>
                            </tr>
                            @if($ride->ride_date)
                                <tr>
                                    <th scope="row">Ngày đi</th>
                                    <td>{{ $ride->ride_date->format('d.m.Y') }}</td>
                                </tr>
                            @else
                                <tr class="bg-light text-center text-uppercase">
                                    <th scope="row" colspan="2">Lịch trình</th>
                                </tr>
                                <tr>
                                    <th scope="row">Ngày bắt đầu</th>
                                    <td>{{ $ride->schedule->start_date->format('d.m.Y') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Ngày kết thúc</th>
                                    <td>
                                        {{ $ride->schedule->end_date
                                            ? $ride->schedule->end_date->format('d.m.Y')
                                            : 'Endless'
                                        }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Ngày chạy</th>
                                    <td>
                                        <ul class="pl-3">
                                            @forelse($ride->running_days as $day)
                                                <li>{{ $day }}</li>
                                            @empty
                                                No running days
                                            @endforelse
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
