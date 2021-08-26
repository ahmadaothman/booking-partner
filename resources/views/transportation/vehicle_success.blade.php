@extends('index')
@section('content')
<div class="pd-ltr-20 xs-pd-20-10 bg-white">
    <div class="min-height-200px pb-4">

     
        <table class="table table-bordered mb-4">
            <tbody>
                <tr>
                    <td colspan="6" colspan="text-center"><h1 class="text-success text-center">Success: Trip Booked!</h1></td>
                </tr>
                <tr>
                    <td colspan="1" class="font-weight-bold">From:</td>
                    <td colspan="5">{{ $from }}</td>
                </tr>
                <tr>
                    <td colspan="1" class="font-weight-bold">To:</td>
                    <td colspan="5">{{ $to }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Type:</td>
                    <td class="">{{ $type }}</td>
                    <td class="font-weight-bold">Pickup Date:</td>
                    <td>{{ $pickup_date }}</td>
                    <td class="font-weight-bold"> Return Date:</td>
                    <td>{{ $return_date }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">First Name:</td>
                    <td>{{ $firstname }}</td>
                    <td class="font-weight-bold">Middle Name:</td>
                    <td>{{ $middlename }}</td>
                    <td class="font-weight-bold">Middle Name:</td>
                    <td>{{ $lastname }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Date Of Birthday:</td>
                    <td>{{ $date_of_birthday }}</td>
                    <td class="font-weight-bold">Sex:</td>
                    <td>{{ $sex }}</td>
                    <td class="font-weight-bold">Nationality:</td>
                    <td>{{ $nationality }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Address:</td>
                    <td>{{ $address }}</td>
                    <td class="font-weight-bold">Telephone:</td>
                    <td>{{ $telephone }}</td>
                    <td class="font-weight-bold">Passport Number:</td>
                    <td>{{ $passport_number }}</td>
                </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td  class="font-weight-bold">
                            Total:
                        </td>
                        <td>{{ $total }}$</td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection