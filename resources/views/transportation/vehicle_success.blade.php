@extends('index')
@section('content')
<div class="pd-ltr-20 xs-pd-20-10 bg-white">
    <div class="min-height-200px pb-4">

     
        <table class="table table-bordered mb-4 borderless">
            <tbody>
                <tr>
                    <td colspan="6" colspan="text-center"><h1 class="text-success text-center">Success: Trip Booked!</h1></td>
                </tr>
            </tbody>
        </table>
        <div id="toprint" >
            <table class="table table-sm mb-4 mt-2 table-bordered borderless">
                <tbody>
                    <tr>
                        <td class="p-3"><img style="max-height:70px" src="{{ asset('/images/logo.png') }}" alt=""></td>
                        <td></td>
                        <td></td>
                        <td class="text-right align-middle p-3">Transportation Booking</td>
                    </tr>
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
                        <td>{{ $booking_data['firstname'] }} {{ $booking_data['middlename'] }} {{ $booking_data['lastname'] }}</td>
                        <td><span>Address: </span> {{ $booking_data['address'] }} </td>
                        <td><span>D.O.B: </span> {{ $booking_data['date_of_birthday'] }} </td>
                        <td><span>Sex: </span> {{ $booking_data['sex'] }} </td>
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
                    </tbody>
                </table>
            @endif

            <table class="table table-sm  table-bordered ">
                <tbody>
                    <tr>
                        <td class="text-center align-middle" colspan="4"><strong>Trip Vehicle</strong></td>
                    </tr>
                    <tr>
                        <td>Vehicle:</td>
                        <td>{{ $one_way_vehicle }}</td>
                        <td>Price:</td>
                        <td>{{ $one_way_vehicle_price }}$</td>
                    </tr>
                
                </tbody>
            </table>

            @if($booking_data['trip_type'] != 'one_way')
                <table class="table table-sm  table-bordered ">
                    <tbody>
                        <tr>
                            <td class="text-center align-middle" colspan="4"><strong>Return Trip Vehicle</strong></td>
                        </tr>
                        <tr>
                            <td>Vehicle:</td>
                            <td>{{ $round_vehicle }}</td>
                            <td>Price:</td>
                            <td>{{ $round_vehicle_price }}$</td>
                        </tr>
                    
                    </tbody>
                </table>
            @endif
            <table class="table table-sm  table-bordered ">
                <tbody>
                    <tr>
                        <td class="text-center align-middle" colspan="10"><strong>Pessengers</strong></td>
                    </tr>
                    @foreach ($pessengers as $pessenger)
                        <tr>
                            <td>First Name:</td>
                            <td>{{ $pessenger['firstname'] }}</td>
                            <td>Middle Name:</td>
                            <td>{{ $pessenger['middlename'] }}</td>
                            <td>Last Name:</td>
                            <td>{{ $pessenger['lastname'] }}</td>
                            <td>Sex:</td>
                            <td>{{ $pessenger['sex'] }}</td>
                            <td>Nationality:</td>
                            <td>{{ $pessenger['nationality'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="text-center align-middle"><h2>Amount To Paid: {{ $total }}$</h2></td>
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