@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card bg-dark-lighter text-white mt-3">
                    <div class="card-header bg-dark-lightest d-flex">
                        <h4 class="m-0">
                            Đặt chỗ của tôi
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-white">
                                <thead>
                                <tr>
                                    <th scope="col">Tuyến đường</th>
                                    <th scope="col">Ngày đi</th>
                                    <th scope="col">Chỗ ngồi</th>
                                    <th scope="col">Ngày đặt</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>
                                            {{ $booking->startLocation->name }}
                                            <i class="fas fa-arrow-right mx-2"></i>
                                            {{ $booking->endLocation->name }}
                                        </td>
                                        <td>{{ $booking->travel_date->format('d M Y') }}</td>
                                        <td>{{ $booking->seats }}</td>
                                        <td>{{ $booking->created_at->format('d m Y H:i') }}</td>
                                        <td>{{ ucwords($booking->status) }}</td>
                                        <td>
                                            <a href="{{ route('bookings.show', $booking) }}" class="btn btn-primary">
                                                Hiện thị chi tiết
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div>
                                {{ $bookings->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
