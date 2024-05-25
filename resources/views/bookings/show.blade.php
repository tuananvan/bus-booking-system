@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-9 col-lg-8 col-xl-6">
                <div class="card bg-dark-lighter text-white mt-3">
                    <div class="card-header bg-dark-lightest d-flex">
                        <h4 class="m-0">
                            Chi tiết đặt chỗ
                        </h4>
                    </div>

                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Chuyến</dt>
                            <dd class="col-sm-8">
                                {{ $booking->startLocation->name }}
                                <i class="fas fa-arrow-right mx-2"></i>
                                {{ $booking->endLocation->name }}
                            </dd>
                            <dt class="col-sm-4">Khởi hành</dt>
                            <dd class="col-sm-8">
                                {{ $booking->travel_date
                                    ->setTimeFromTimeString($booking->ride->getArrivalTimeToLocation($booking->startLocation->id))
                                    ->format('d M Y, H:i')
                                }}
                            </dd>
                            <dt class="col-sm-4">Đến</dt>
                            <dd class="col-sm-8">
                                {{ $booking->travel_date
                                    ->setTimeFromTimeString($booking->ride->getArrivalTimeToLocation($booking->startLocation->id))
                                    ->addMinutes($booking->endLocation->getMinutesFromDepartureInRoute($booking->ride->route->id))
                                    ->format('d M Y, H:i')
                                }}
                            </dd>
                            <dt class="col-sm-4">Chỗ ngồi</dt>
                            <dd class="col-sm-8">{{ $booking->seats }}</dd>
                            <dt class="col-sm-4">Made at</dt>
                            <dd class="col-sm-8">{{ $booking->created_at->format('d M Y, H:i:s') }}</dd>
                            <dt class="col-sm-4">Trạng thái</dt>
                            <dd class="col-sm-8">{{ ucfirst($booking->status) }}</dd>
                            <dt class="col-sm-4">Cập nhật trạng thái cuối cùng</dt>
                            <dd class="col-sm-8">{{$booking->updated_at->format('d M Y, H:i:s') }}</dd>
                        </dl>
                    </div>

                    <div class="card-footer text-center">
                        <form action="{{ route('bookings.cancel', $booking) }}" id="cancelBooking" method="POST">
                            @csrf
                            @method('PATCH')

                            <button class="btn btn-sm btn-danger" {{ !$booking->canBeCancelled() ? 'disabled' : ''}}
                                    onclick="cancelBookingConfirm('cancelBooking')" type="button">
                                Huỷ đặt chỗ
                            </button>
                            <p class="mb-0">
                                <small>Bạn có thể huỷ đặt chỗ trước 2h trươcs khi khởi hành.ß</small>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
