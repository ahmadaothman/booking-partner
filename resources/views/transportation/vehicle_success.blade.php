@extends('index')
@section('content')
<div class="pd-ltr-20 xs-pd-20-10 bg-white">
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
                        <td colspan="4"><strong>Contact:Info</strong></td>
                    </tr>
                    <tr>
                        <td>{{ $booking_data['firstname'] }} </td>
                        <td><span>Address: </span> {{ $booking_data['address'] }} </td>
                        <td><span>D.O.B: </span> {{ $booking_data['date_of_birthday'] }} </td>
                    </tr>
                    <tr>
                        <td>{{ $booking_data['nationality'] }} -  {{ $booking_data['telephone'] }} </td>
                        <td>{{ $booking_data['email'] }} </td>
                        <td><span>Passport No: </span>{{ $booking_data['passport_number'] }} </td>
                        <td></td>
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
                            Pickup Note:
                        </td>
                        <td colspan="3">
                            {{ $booking_data['one_way_pickup_note'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Dropoff Note:
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
                                Pickup Note:
                            </td>
                            <td colspan="3">
                                {{ $booking_data['return_pickup_note'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Dropoff Note:
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
                        <td>Price:</td>
                        <td>{{ $one_way_vehicle_price }}$</td>
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
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="text-center align-middle"><h2>Amount : {{ $total }}$</h2></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .borderless td, .borderless th {
    border: none;
}
</style>
@endsection