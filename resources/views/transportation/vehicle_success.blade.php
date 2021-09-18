@extends('index')
@section('content')
<div class="pd-ltr-20 xs-pd-20-10 bg-white">
    @if (isset($trip_not_found) && $trip_not_found)
        <h3 class="text-danger text-center">Warning: Trip not found!</h3>
    @else
    <div class="min-height-200px pb-4" style="background-color: white !important">

        @if (isset($view) && !$view)
        <table class="table table-bordered mb-4 borderless">
            <tbody>
                <tr>
                    <td colspan="6" colspan="text-center"><h1 class="text-success text-center">Success: Trip Booked!</h1></td>
                </tr>
            </tbody>
        </table>
        @endif
        <script type="text/javascript" src="{{ asset('/src/scripts/printThis.js') }}"></script>
       <div class="row">
           <div  class="col-md-12 text-right">
            <button type="button" class="btn btn-primary" onclick="$('#toprint').printThis();"><i class="icon-copy fa fa-print" aria-hidden="true"></i> Print</button>
           </div>
       </div>
        <div id="toprint" style="background-color: white !important">
            <table class="table table-sm mb-4 mt-2 table-bordered borderless">
                <tbody>
                    @if($user->logo)
                   <tr class="text-right">
                       <img src="{{ asset($user->logo) }}" style="max-height: 70px"/>
                   </tr>
                   @endif
                    <tr>
                        <td class="text-center align-middle" colspan="4"><strong>
                            
                            @if ($booking_data['trip_type'] == 'one_way')
                            One Way Trip
                            @else
                            Round Trip
                            @endif
                            </strong>
                            <br>
                            <strong># {{ $booking_number }}</strong>
                        </td>
                            
                    </tr>
                </tbody>
            </table>

            <table class="table table-sm  table-bordered borderless">
                <tbody>
                    <tr>
                        <td colspan="2"><strong>Contact:Info</strong></td>
                    </tr>
                    <tr>
                        <td>{{ $booking_data['firstname'] }} </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>{{ $booking_data['nationality'] }} -  {{ $booking_data['telephone'] }} </td>
                        <td>{{ $booking_data['email'] }} </td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-sm  table-bordered ">
                <tbody>
                    <tr>
                        <td class="text-center align-middle" colspan="4"><strong>Trip Location</strong></td>
                    </tr>
                    <tr>
                        <td>From:</td>
                        <td>{{ $from }}</td>
                        <td>To:</td>
                        <td>{{ $to }}</td>
                    </tr>
                    <tr>
                        <td>Date:</td>
                        <td>{{ $pickup_date }}</td>
                        <td>Time:</td>
                        <td>{{ $pickup_time }}</td>
                    </tr>
                    <tr>
                        <td>
                            Pickup Location Address:
                        </td>
                        <td colspan="3">
                            {{ $booking_data['one_way_pickup_note'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Dropoff Location Address:
                        </td>
                        <td colspan="3">
                            {{ $booking_data['one_way_dropoff_note'] }}
                        </td>
                    </tr>
                </tbody>
            </table>
            @if($booking_data['trip_type'] != 'one_way')
                <table class="table table-sm  table-bordered ">
                    <tbody>
                        <tr>
                            <td class="text-center align-middle" colspan="4"><strong>Return Trip Location</strong></td>
                        </tr>
                        <tr>
                            <td>From:</td>
                            <td>{{ $return_from }}</td>
                            <td>To:</td>
                            <td>{{ $return_to }}</td>
                        </tr>
                        <tr>
                            <td>Date:</td>
                            <td>{{ $return_date }}</td>
                            <td>Time:</td>
                            <td>{{ $return_time }}</td>
                        </tr>
                        <tr>
                            <td>
                                Pickup Location Address:
                            </td>
                            <td colspan="3">
                                {{ $booking_data['return_pickup_note'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Dropoff Location Address:
                            </td>
                            <td colspan="3">
                                {{ $booking_data['return_dropoff_note'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <table class="table table-sm  table-bordered ">
                <tbody>
                    <tr>
                        <td class="text-center align-middle" colspan="4"><strong>Vehicle</strong></td>
                    </tr>
                    <tr>
                        <td>Vehicle:</td>
                        <td>{{ $one_way_vehicle }}</td>
                      
                    </tr>
                
                </tbody>
            </table>

            
            <table class="table table-sm  table-bordered ">
                <tbody>
                    <tr>
                        <td class="text-center align-middle" colspan="10"><strong>Pessengers</strong></td>
                    </tr>
                    @foreach ($pessengers as $pessenger)
                        <tr>
                            <td>Name:</td>
                            <td>{{ $pessenger->firstname }}</td>
                            <td>Nationality:</td>
                            <td>{{ $pessenger->nationality }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(isset($booking_trip->airport_note) && !empty($booking_trip->airport_note))
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-center align-middle"><h5>{{ $booking_trip->airport_note }} </h5></td>
                        </tr>
                    </tbody>
                </table>
            @elseif(isset($booking_return_trip->airport_note) && !empty($booking_return_trip->airport_note) && $booking_data['trip_type'] != 'one_way')
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="text-center align-middle"><h5>{{ $booking_return_trip->airport_note }} </h5></td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
<style>
    .borderless td, .borderless th {
    border: none;
}
</style>
@endif
@endsection