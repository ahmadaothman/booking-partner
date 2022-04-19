<html>
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
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

                    @if ($booking_data->trip_number_main)
                    <tr class="table table-bordered">
                        <td>
                            Flight Number: 
                        </td>
                        <td colspan="3"> {{ $booking_data->trip_number_main  }}</td>
                    </tr>
                     @endif

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
                                {{ $booking_data['one_way_dropoff_note'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Dropoff Location Address:
                            </td>
                            <td colspan="3">
                                {{ $booking_data['one_way_pickup_note'] }}
                            </td>
                        </tr>
                        @if ($booking_data->return_trip_number_main)
                        <tr class="table table-bordered">
                            <td>
                                Return Flight Number: 
                            </td>
                            <td colspan="3"> {{ $booking_data->return_trip_number_main  }}</td>
                        </tr>
                         @endif
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
                            <td class="text-left align-middle"><h5>{!! nl2br(e($booking_trip->airport_note)) !!} </h5></td>
                        </tr>
                    </tbody>
                </table>
            @elseif(isset($booking_return_trip->airport_note) && !empty($booking_return_trip->airport_note) && $booking_data['trip_type'] != 'one_way')
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="text-left align-middle"><h5>{!! nl2br(e($booking_return_trip->airport_note)) !!}  </h5></td>
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
.header.clearfix, .left-side-bar{
    display: none !important;
}
.main-container{
    padding: 0px !important;
}
</style>
@endif
</html>