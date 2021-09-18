@extends('index')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('/src/plugins/jquery-steps/build/jquery.steps.css') }}">
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Book a trip</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Book a trip</li>
                        </ol>
                    </nav>
                </div>
             
            </div>
        </div>

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix">
                <h4 class="text-blue">Booking Data</h4>
                <p class="mb-30 font-14">Enter all required infomation</p>
            </div>
            <div class="wizard-content">
                @if($user->balance <= 0)
                <div class="alert alert-danger" role="alert">
                    <strong>Warning:</strong> You Don't have balance please contact admin to add balance!
                  </div>
                <style>
                    #main_form {
                        pointer-events: none;
                        opacity: 0.4;
                    }
                </style>
                @endif

                <form action="{{ $action }}" id="main_form" method="POST" enctype="multipart/form-data" class="tab-wizard wizard-circle wizard">
                    
                    @csrf
                    <h5>Location Info</h5>
                    <section>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="radio"  id="one_way"  name="trip_type" checked value="one_way" />
                                    <label for="one_way">ONE WAY</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <input type="radio"  name="trip_type"  id="round" value="round"/>
                                    <label for="round">ROUND TRIP</label>
                                </div>
                            </div>
                        </div>
                        <h3 >Trip Details</h3>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Pickup Location :</label>
                                    <input type="text" name="pickup_location" id="pickup_location" class="form-control" autocomplete="off" required value="{{ isset($booking_trip->pickup_location) ? $booking_trip->pickup_location :  old('pickup_location') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Drop Off Location :</label>
                                    <input type="text" name="destination_location" id="destination_location"  class="form-control" autocomplete="off" required value="{{ isset($booking_trip->destination_location) ? $booking_trip->destination_location :  old('destination_location') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="one_way_pickup_note">Pickup Location Address :</label>
                                    <!--<input type="text" name="one_way_note" id="one_way_note"  class="form-control" autocomplete="off" required value="{{ isset($booking_trip->one_way_note) ? $booking_trip->one_way_note :  old('one_way_note') }}">-->
                                    <input type="text" name="one_way_pickup_note" id="one_way_pickup_note"  class="form-control" autocomplete="off" required value="{{ isset($booking_trip->one_way_pickup_note) ? $booking_trip->one_way_pickup_note :  old('one_way_pickup_note') }}">

                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="one_way_dropoff_note">Drop Off Location Address :</label>
                                    <input type="text" name="one_way_dropoff_note" id="one_way_dropoff_note"  class="form-control" autocomplete="off" required value="{{ isset($booking_trip->one_way_dropoff_note) ? $booking_trip->one_way_dropoff_note :  old('one_way_dropoff_note') }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Pickup Date :</label>
                                    <input type="date" name="pickup_date" id="pickup_date" class="form-control " placeholder="Select Date" value="{{ isset($booking_trip->pickup_date) ? $booking_trip->pickup_date :  old('pickup_date') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Pickup Time :</label>
                                    <input type="text" name="one_way_time" id="pickup_time" class="form-control time-picker-default" placeholder="Select Time" value="{{ isset($booking_trip->one_way_time) ? $booking_trip->one_way_time :  old('one_way_time') }}">
                                </div>
                            </div>
                        </div>
                        <h3 class="round-trip">Return Details</h3>
                        <hr class="round-trip"/>

                        <div class="row" id="round_trip_locations"   class="d-none" hidden>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Pickup Location :</label>
                                    <input type="text" name="round_pickup_location" id="round_pickup_location" class="form-control round-trip" autocomplete="off" required value="{{ isset($booking_trip->round_pickup_location) ? $booking_trip->round_pickup_location :  old('round_pickup_location') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Drop Off Location :</label>
                                    <input type="text" name="round_destination_location" id="round_destination_location"  class="form-control round-trip" autocomplete="off" required value="{{ isset($booking_trip->round_destination_location) ? $booking_trip->round_destination_location :  old('round_destination_location') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row  d-none" hidden>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Pickup Location Address :</label>
                                    <input type="text" name="return_pickup_note" id="return_pickup_note"  class="form-control" autocomplete="off" required value="{{ isset($booking_trip->return_pickup_note) ? $booking_trip->return_pickup_note :  old('return_pickup_note') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Drop Off Location Address :</label>
                                    <input type="text" name="return_dropoff_note" id="return_dropoff_note"  class="form-control" autocomplete="off" required value="{{ isset($booking_trip->return_dropoff_note) ? $booking_trip->return_dropoff_note :  old('return_dropoff_note') }}">
                                </div>
                            </div>
                        </div>
                      
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group round-trip">
                                    <label for="return_date">Return Date :</label>
                                    <input type="date" name="return_date" id="return_date" class="form-control round-trip" placeholder="Select Date" value="{{ isset($booking_trip->return_date) ? $booking_trip->return_date :  old('return_date') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group round-trip">
                                    <label for="return_date">Return Time :</label>
                                    <input type="text" name="return_time" id="return_time" class="form-control time-picker-default round-trip" placeholder="Select Time" value="{{ isset($booking_trip->return_time) ? $booking_trip->return_time :  old('return_time') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="perssengers" class="form-label">PASSENGERS</label>
                                    <select class="form-control rounded-0" name="perssengers" id="perssengers">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                        <option>21</option>
                                        <option>22</option>
                                        <option>23</option>
                                        <option>24</option>
                                        <option>25</option>
                                        <option>26</option>
                                        <option>27</option>
                                        <option>28</option>
                                        <option>29</option>
                                        <option>30</option>
                                        <option>31</option>
                                        <option>32</option>
                                        <option>33</option>
                                        <option>34</option>
                                        <option>35</option>
                                        <option>36</option>
                                        <option>37</option>
                                        <option>38</option>
                                        <option>39</option>
                                        <option>40</option>
                                        <option>41</option>
                                        <option>42</option>
                                        <option>43</option>
                                        <option>44</option>
                                        <option>45</option>
                    
                                    </select>
                                    <span class="select-arrow"></span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                        
                          
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h5>Vehicles</h5>
                    <section>
                        <div  id="available_vehicles_loader" class="mb-4">
                            <h4>Loading Data...</h4>
                            <div class="progress">
								<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
                       </div>
                       <input type="hidden" name="trip_id" id="trip_id" />
                       <input type="hidden" name="round_trip_id" id="round_trip_id" class="round-trip"/>
                        <table class="table table-hover table-bordered table-triped" id="available_vehicles">
                            <thead>
                                <tr>
                                    <th >Image</th>
                                    <th>Vehicle</th>
                                    <th>Description</th>
                                    <th class="text-center">Max People</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Select Vehicle</th>
                                </tr>
                            </thead>
                            <tbody id="available_vehicles_tbody">

                            </tbody>
                        </table>
                    </section>
                      <!-- Step 3 -->
                      <!--h5 >Round Trip Vehicles</h5>
                      <section >
                   
                         <input type="hidden" name="round_trip_id" id="round_trip_id" class="round-trip"/>
                          <table class="table table-hover table-bordered table-triped round-trip" id="available_round_trip_vehicles">
                              <thead>
                                  <tr>
                                      <th >Image</th>
                                      <th>Vehicle</th>
                                      <th>Description</th>
                                      <th class="text-center">Max People</th>
                                      <th class="text-center">Price</th>
                                      <th class="text-center">Select Vehicle</th>
                                  </tr>
                              </thead>
                              <tbody id="available_round_trip_vehicles_tbody">
  
                              </tbody>
                          </table>
                      </section>-->
                    <!-- Step 4 -->
                    <h5>Pessengers</h5>
                    <section>
                      
                        <h4>PASSENGERS INFO:</h4>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Nationality</th>
                                    <td>Admin</td>
                                </tr>
                            </thead>
                            <tbody id="pessengers_tbody">
                            </tbody>
                        </table>
                    </section>
                    <h5>Contact Info</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Full Name:</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control personal-info" value="{{ isset($booking->firstname) ? $booking->firstname :  old('firstname') }}"/>
                                </div>
                            </div>

                            <div class="col-md-3 d-none">
                                <div class="form-group">
                                    <label>Middle Name:</label>
                                    <input type="text" name="middlename" name="middlename"  class="form-control " value="{{ isset($booking->middlename) ? $booking->middlename :  old('middlename') }}">
                                </div>
                            </div>

                            <div class="col-md-3 d-none">
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input type="text" name="lastname" name="lastname"  class="form-control "  value="{{ isset($booking->lastname) ? $booking->lastname :  old('lastname') }}">
                                </div>
                            </div>

                            <div class="col-md-3 d-none">
                                <div class="form-group">
                                    <label>Date Of Birthday:</label>
                                    <input type="date" name="date_of_birthday" name="date_of_birthday"  class="form-control " >
                                </div>
                            </div>
                          
                        </div>
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nationality:</label>
                                    <select class="form-control selectpicker" name="nationality" name="nationality" data-live-search="true">
                                        <div class="d-none">
                                            {{ isset($booking->country) ? $country = $booking->country :  $country = old('country') }}
                                    
                                        </div>
                                        @foreach ($countries as $key => $value)
                                            @if ((isset($value['name_en']) && !empty($value['name_en'])) && (isset($value['cca2']) && !empty($value['cca2'])))
                                                @if ($value['cca2'] == $country)
                                                    <option value="{{ $value['cca2'] }}" selected="selected">{{ $value['name_en'] }}</option>
                                                @else
                                                    <option value="{{ $value['cca2'] }}">{{ $value['name_en'] }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 d-none">
                                <div class="form-group">
                                    <label>Address:</label>
                                    <input type="text" name="address" name="address"  class="form-control" value="none">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Telephone:</label>
                                    <input type="text" name="telephone" id="telephone"  class="form-control personal-info" value="{{ isset($booking->telephone) ? $booking->telephone :  old('telephone') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="text" name="email" id="email"  class="form-control personal-info" value="{{ isset($booking->email) ? $booking->email :  old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row d-none">
                            <div class="col-md-6 d-none">
                                <div class="form-group">
                                    <label>Passport Number:</label>
                                    <input type="text" name="passport_number" id="passport_number"  class="form-control personal-info" value="000000">
                                </div>
                            </div>
                        </div>

                       <div class="row is_airport" id="block_trip_number">
                        <div class="col-md-6 ">
                            <div class="form-group"  >
                                <label>Fly Number:</label>
                                <input type="text" name="trip_number" id="trip_number"  class="form-control" value="{{ isset($booking->trip_number) ? $booking->trip_number :  old('trip_number') }}">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group"  >
                                <label>Arrival Time:</label>
                                <input type="text" name="arrival_time" id="arrival_time"  class="form-control time-picker-default" value="{{ isset($booking->arrival_time) ? $booking->arrival_time :  old('arrival_time') }}">
                            </div>
                        </div>
                       </div>
                    </section>
                    <!-- Step 6 -->
                    <h5>Confirm</h5>
                    <section>
                        <table class="table table-bordered table-hover table-striped d-none">
                            <tbody>
                                <tr>
                                    <td>One Way Total:</td>
                                    <td id="one_way_total"></td>
                                </tr>
                                <tr>
                                    <td>Round Trip Total:</td>
                                    <td id="round_trip_total"></td>
                                </tr>
                                <tr>
                                    <td>Total:</td>
                                    <td id="total"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!--Contact Info -->
                        <table class="table table-sm table-hover table-bordered" id="table_contact_info">
                            <tbody>
                                <tr>
                                    <td colspan="4" id="table_contact_info" class="text-center"><strong>Contact Info</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td id="table_first_name"></td>
                                    <td><strong>Nationality:</strong></td>
                                    <td id="table_nationality"></td>
                                </tr>
                            
                              
                                <tr>
                                    <td><strong>Telephone:</strong></td>
                                    <td id="table_telephone"></td>
                                    <td><strong>Email:</strong></td>
                                    <td id="table_email"></td>
                                </tr>
                                <tr id="table_airport_trip_info">
                                    <td><strong>Fly Number:</strong></td>
                                    <td id="table_trip_number"></td>
                                    <td><strong>Fly Arrival Time:</strong></td>
                                    <td id="table_arrival_time"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!--Vehicles And Locations-->
                        <table class="table table-sm table-hover table-bordered" id="table_locations_and_vehicles">
                            <tbody>
                                <tr>
                                    <td colspan="4" id="Trip_type" class="text-center"></td>
                                </tr>
                                <tr>
                                    <td><strong>From:</strong></td>
                                    <td id="table_one_way_from"></td>
                                    <td><strong>To:</strong></td>
                                    <td id="table_one_way_to"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" id="table_pickup_location_address"></td>
                                    <td colspan="2" id="table_dropoff_location_address"></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center"><strong>Date-Time</strong></td>
                                </tr>

                                <tr>
                                    <td><strong>Pickup Date:</strong></td>
                                    <td id="table_pickup_date"></td>
                                    <td><strong>Pickup Time:</strong></td>
                                    <td id="table_pickup_time"></td>
                                </tr>

                                <tr class="table_return_trip_location">
                                    <td colspan="4" class="text-center"><strong>Return</strong></td>
                                </tr>
                                <tr class="table_return_trip_location">
                                    <td><strong>From:</strong></td>
                                    <td id="table_return_from"></td>
                                    <td><strong>To:</strong></td>
                                    <td id="table_return_to"></td>
                                </tr>
                               

                                <tr class="table_return_trip_vehicle_row ">
                                    <td colspan="4" class="text-center"><strong>Date-Time</strong></td>
                                </tr>
                                <tr class="table_return_trip_vehicle_row ">
                                    <td><strong>Return Date:</strong></td>
                                    <td id="table_return_date"></td>
                                    <td><strong>Return Time:</strong></td>
                                    <td id="table_return_time"></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong>Trip Vehicle:</strong></td>
                                    <td id="table_trip_vehicle"></td>
                                    <td><strong>Price:</strong></td>
                                    <td id="table_vehicle_price"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!--Pesengers-->
                        <table class="table table-sm table-hover table-bordered" id="table_pessengers">
                            <thead>
                                <tr>
                                    <td>Full Name</td>
                                    <td>Nationality</td>
                                    
                                </tr>
                            </thead>
                            <tbody id="table_pessengers_tbody">
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered" id="table_airport_note">
                            <tr>
                                <td><strong>Note: </strong></td>
                                <td class="text-center" id="table_airport_text"></td>
                            </tr>
                        </table>

                        <table class="table table-sm">
                            <tbody>
                                <tr hidden>
                                    <td colspan="3"></td>
                                    <td><strong>One Way Price:</strong></td>
                                    <td id="table_one_way_price" class="text-right"></td>
                                </tr>
                                <tr hidden>
                                    <td colspan="3"></td>
                                    <td><strong>Return Trip Price:</strong></td>
                                    <td id="table_return_trip_price" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td><strong>Total:</strong></td>
                                    <td id="table_total" class="text-right"></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </form>
            </div>
        </div>

       
        <!-- success Popup html Start -->
        <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center font-18">
                        <h3 class="mb-20">All steps completed</h3>
                        <div class="mb-30 text-center">
                        Are you sure want to submit this from?
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" onclick="$('#main_form').submit()" data-dismiss="modal">Done</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- success Popup html End -->
    </div>

</div>

<script src="{{ asset('/src/plugins/jquery-steps/build/jquery.steps.js') }}"></script>
<script>
    var is_airport = false
    var final_total = 0;
    var trip_type = "one_way";

    $(".tab-wizard").steps({
        headerTag: "h5",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit"
        },
        onStepChanging:function(event, currentIndex, priorIndex){

            if(currentIndex == 0){
                trip_type = $('input[type=radio][name=trip_type]:checked','#main_form').val();
           
                $('#round_pickup_location').val($('#destination_location').val())
                $('#round_destination_location').val($('#pickup_location').val())
                if($('#pickup_location').val() == "" || $('#destination_location').val() == "" || $('#pickup_date').val() == ""){

                    $('#pickup_location').addClass('is-invalid')
                    $('#destination_location').addClass('is-invalid')
                    $('#pickup_date').addClass('is-invalid')

                    return false;
                }else if($('input[type=radio][name=trip_type]:checked','#main_form').val() == "round" && ( $('#return_date').val() == "" || $('#round_pickup_location').val() == "" || $('#round_destination_location').val() == "" )){

                    $('.round-trip').addClass('is-invalid')
                    return false;
                }else{
                    $('input').removeClass('is-invalid')
                    $('#available_vehicles_loader').show()
                    $('#available_vehicles_tbody').empty()
                    $('#available_round_trip_vehicles_tbody').empty()
                    
                    $.ajax({
                        url:"{{ route('getVehicle') }}",
                        type:"GET",
                        data:{
                            from_location: $('#pickup_location').val(),
                            to_location:$('#destination_location').val(),
                            round_from_location: $('#round_pickup_location').val(),
                            round_to_location:$('#round_destination_location').val(),
                            perssengers:$('#perssengers').val()
                        },
                        success:function(data){
                            $('#available_vehicles_tbody').empty()
                            $('#trip_id').val(data.trip_id)
                            $('#round_trip_id').val(data.return_trip_id)
                            if(data.is_airport){
                                is_airport = true
                            }
                          
                            if(data.vehicles.length > 0){
                                var html = ''
                                $.each(data.vehicles,function(key,value){

                                   if(value.selected){
                                    html += '<tr>'
                                   }else{
                                    html += '<tr class="bg-light">'
                                   }
                                    html += '<td>'
                                    html += '<img class="vehicle-img" src="{{ $image_server }}/'+value.image+'"/>'
                                    html += '</td>'

                                    html += '<td class="align-middle">'
                                    html += value.name
                                    html += '</td>'

                                    html += '<td class="align-middle">'
                                    html += value.description
                                    html += '</td>'

                                    html += '<td class="text-center align-middle">'
                                    html += value.max_people
                                    html += '</td>'

                                    html += '<td class="text-center align-middle">'
                                    if(trip_type == "round"){
                                        html += value.private_price*2 + "$"
                                    }else{
                                        html += value.private_price + "$"
                                    }
                                    html += '<input type="hidden" name="vehivles_price['+value.vehicle_id+'][price]" value="'+value.private_price+'" />'
                                    html += '</td>'

                                    html += '<td class="text-center align-middle">'
                                    
                                    if(value.selected){
                                        html += '<input type="radio" style="width: 9vw;height: 9vh;" class="vehicle-check" name="selected_vehicles[]" value="'+value.vehicle_id+'"/>'
                                    }

                                    html += '</td>'

                                    html += '</tr>'

                                  
                                })
                                $('#available_vehicles_tbody').append(html)
                                $('#available_vehicles_loader').hide()
                            }else{
                                html = '<tr><td colspan="5"><strong>No vehicles available for selected locations!</strong></td></tr>'
                                $('#available_vehicles_tbody').append(html)
                                $('#available_vehicles_loader').hide()
                            }

                            if(is_airport){
                                $('.is_airport').show()
                            }else{
                                $('.is_airport').hide()
                            }
                        }
                    })
                    return true
                }
            }else if(currentIndex == 1 && priorIndex == 2){
                var selected_vehicles_count = $('#available_vehicles_tbody input:radio:checked').length;
                if(selected_vehicles_count <= 0){
                    alert('Please select one vehicle at least!')
                    return false
                }else{
                    $('#pessengers_tbody').empty()
                    var pessensgers_number = parseInt($('#perssengers').val())
                    var html = '';
                    for (let i = 0; i < pessensgers_number; i++) {
                        html += '<tr>'
                        html += '<td>'
                        html += '<input type="text" name="pessenger['+i+'][firstname]" class="form-control pessengers-info" />'
                        html += '</td>'
                
                  
                        html += '<td>'
                        html += '<select class="form-control " name="pessenger['+i+'][nationality]">'
                        '@foreach ($countries as $key => $value)'

                            "@if ((isset($value['name_en']) && !empty($value['name_en'])) && (isset($value['cca2']) && !empty($value['cca2'])))"
                                    html += '<option value="{{ $value['cca2'] }}" >{{ $value['name_en'] }}</option>'
                            "@endif"
                        
                        '@endforeach'
                        html += '</select>'
                        html += '</td>'
                        html += '<td>'
                        html += '<input type="radio" name="pessenger_admin" id="pessenger_admin_'+i+'" value="'+i+'"/><label for="pessenger_admin_'+i+'"></label>'
                        html += '</td>'
                       
                      
                        html += '</tr>'
                    }
                    $('#pessengers_tbody').append(html)
                    if(is_airport){
                        $('#block_trip_number').show()
                        $('#trip_number').addClass('personal-info')
                    }else{
                        $('#block_trip_number').hide()
                        $('#trip_number').removeClass('personal-info')
                    }
                    $('#main_form .personal-info').each(function(){
                        $(this).removeClass('is-invalid')
                       
                    })
                    return true
                }
            }else if(currentIndex == 2 && priorIndex == 3){
                var completed_fields = true

                $('#main_form .pessengers-info').each(function(){
                        $(this).removeClass('is-invalid')
                       
                })

                $('#main_form .pessengers-info').each(function(){
                    if($(this).val() == ""){
                        $(this).addClass('is-invalid')
                        completed_fields = false
                    }
                })
                
                var pessenger_id = $('input[name="pessenger_admin"]:checked','#main_form').val()
                if(pessenger_id == "" || pessenger_id == null){
                    pessenger_id = 0;
                }
                var pessenger_name = $('input[name="pessenger['+pessenger_id+'][firstname]"]').val();
                var pessenger_country = $('select[name="pessenger['+pessenger_id+'][nationality]"]').val();


                $('#firstname').val(pessenger_name)
                $('select[name="nationality"]').val(pessenger_country).change()
                return completed_fields
            }else if(currentIndex == 3 && priorIndex == 4){
                var completed_fields = true

                $('#main_form .personal-info').each(function(){
                        $(this).removeClass('is-invalid')
                    
                })

                $('#main_form .personal-info').each(function(){
                    if($(this).val() == ""){
                        $(this).addClass('is-invalid')
                        completed_fields = false
                    }
                })
                $('#table_first_name').html($('#firstname').val());
                $('#table_date_of_birthday').html($('input[name="date_of_birthday"]').val());
                $('#table_nationality').html($('select[name="nationality"]').val());
                $('#table_address').html($('input[name="address"]').val());
                $('#table_telephone').html($('#telephone').val());
                $('#table_email').html($('#email').val());
             
                if(!is_airport){
                    $('#table_airport_trip_info').hide()
                }

                $('#table_trip_number').html($('#trip_number').val());
                $('#table_arrival_time').html($('#arrival_time').val());
                if($('input[type=radio][name=trip_type]:checked','#main_form').val() == "round"){
                    $('#Trip_type').html('<strong>Round Trip</strong>')
                    $('.table_return_trip_location').show();
                    $('.table_return_trip_vehicle_row').show();
                }else{
                    $('#Trip_type').html('<strong>Trip Details</strong>')
                    $('.table_return_trip_location').hide();
                    $('.table_return_trip_vehicle_row').hide();
                }

                $('#table_one_way_from').html($('#pickup_location').val());
                $('#table_one_way_to').html($('#destination_location').val());

                $('#table_pickup_location_address').html($('#one_way_pickup_note').val());
                $('#table_dropoff_location_address').html($('#one_way_dropoff_note').val());

                $('#table_pickup_date').html($('#pickup_date').val());
                $('#table_pickup_time').html($('#pickup_time').val());

                $('#table_return_from').html($('#round_pickup_location').val());
                $('#table_return_to').html($('#round_destination_location').val());

                $('#table_return_date').html($('#return_date').val());
                $('#table_return_time').html($('#return_time').val());

                // calculate total
                $.ajax({
                    type:"POST",
                    url:"{{ route('calculateTripTotal') }}",
                    data:$('#main_form').serialize(),
                    success:function(results){
                        $('#table_trip_vehicle').html(results.one_way_vehicle.name + "-" + results.one_way_vehicle.description)
                        if(trip_type == "round"){
                            $('#table_vehicle_price').html(results.one_way_vehicle_price.private_price*2 + "$" )
                        }else{
                            $('#table_vehicle_price').html(results.one_way_vehicle_price.private_price + "$" )
                        }

                        if(results.return_trip_vehicle){
                            $('#table_return_trip_vehicle').html(results.return_trip_vehicle.name + "-" + results.return_trip_vehicle.description)
                            $('#table_return_vehicle_price').html(results.return_trip_vehicle_price.private_price + "$" )
                        }
                        $('#table_pessengers_tbody').empty()
                        $.each(results.pessengers,function(k,v){
                            var html = '<tr>'
                                html += '<td>'+v.firstname+'</td>'
                          
                                html += '<td>'+v.nationality+'</td>'
                                html += '</tr>'
                                $('#table_pessengers_tbody').append(html)
                        });

                        if(results.airport_note != "" && results.airport_note != null){
                            $('#table_airport_note').show();
                            $('#table_airport_text').html(results.airport_note);
                        }else{
                            $('#table_airport_note').hide();
                            $('#table_airport_text').html("");
                        }

                        $('#table_one_way_price').html(results.one_way_price + "$")
                        $('#table_return_trip_price').html(results.one_way_price + "$")
                        $('#table_total').html(results.total + "$")
                        final_total = results.total
                    }
                })
                return completed_fields
            }else{
                return true
            }
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
          
           
           
        },
        onFinished: function (event, currentIndex) {
            var balance = {{ $user->balance }}

            if(final_total > balance){
                alert("Warning: you don't have balance please contact admin!")
            }else{
                $('#success-modal').modal('show');
            }
            
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">

    $('#pickup_location').typeahead({

        source: function (query, process) {
            return $.getJSON(
                "{{ route('search_pickup') }}",
                {
                    query: query,
                    to_location:  $('#destination_location').val()
                },
                function (data) {
                    var newData = [];

                    $.each(data, function(){

                        newData.push(this.from_location);

                    });

                    return process(newData);
                });
        }

    });

    $('#destination_location').typeahead({

        source: function (query, process) {
            return $.getJSON(
                "{{ route('searh_destination') }}",
                {
                    query: query,
                    from_location: $('#pickup_location').val()
                },
                function (data) {
                    var newData = [];

                    $.each(data, function(){

                        newData.push(this.to_location);

                    });

                    return process(newData);
                });
        }

    });

    $('#round_pickup_location').typeahead({

        source: function (query, process) {
            return $.getJSON(
                "{{ route('search_pickup') }}",
                {
                    query: query,
                    to_location:  $('#round_destination_location').val()
                },
                function (data) {
                    var newData = [];

                    $.each(data, function(){

                        newData.push(this.from_location);

                    });

                    return process(newData);
                });
        }

    });

    $('#round_destination_location').typeahead({

        source: function (query, process) {
            return $.getJSON(
                "{{ route('searh_destination') }}",
                {
                    query: query,
                    from_location: $('#round_pickup_location').val()
                },
                function (data) {
                    var newData = [];

                    $.each(data, function(){

                        newData.push(this.to_location);

                    });

                    return process(newData);
                });
        }

    });


	$('.round-trip').hide()
    $('#round_trip_locations').hide()

	$('input[type=radio][name=trip_type]').change(function() {
		if (this.value == 'round') {
			$('.round-trip').show()
            $('#round_trip_locations').show()
			$(".round-trip").prop('required',true);

		}
		else if (this.value == 'one_way') {
			$('.round-trip').hide()
            $('#round_trip_locations').hide()
			$(".round-trip").prop('required',false);
		}
	});
    $('.date-picker').datepicker({
        dateFormat: 'dd-mm-yyyy'
            });
</script>
<script type="text/javascript">
$("#pickup_location").change(function() {
    if($(this).val().toLowerCase().indexOf("airport") != -1){
        $('#one_way_pickup_note').prop("readonly",true);
    }else{
        $('#one_way_pickup_note').prop("readonly",false);
    }
})


$("#destination_location").change( function() {
    if($(this).val().toLowerCase().indexOf("airport") != -1){
        $('#one_way_dropoff_note').prop("readonly",true);
    }else{
        $('#one_way_dropoff_note').prop("readonly",false);
    }
})
</script>
<style>
	
	.ui-autocomplete {
		position: absolute;
		top: 100%;
		left: 0;
		z-index: 1000;
		display: none;
		float: left;
		min-width: 160px;
		padding: 5px 0;
		margin: 2px 0 0;
		list-style: none;
		font-size: 14px;
		text-align: left;
		background-color: #ffffff;
		border: 1px solid #cccccc;
		border: 1px solid rgba(0, 0, 0, 0.15);
		border-radius: 4px;
		-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
		box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
		background-clip: padding-box;
		}

		.ui-autocomplete > li > div {
		display: block;
		padding: 3px 20px;
		clear: both;
		font-weight: normal;
		line-height: 1.42857143;
		color: #333333;
		white-space: nowrap;
		}

		.ui-state-hover,
		.ui-state-active,
		.ui-state-focus {
		text-decoration: none;
		color: #262626;
		background-color: #f5f5f5;
		cursor: pointer;
		}

		.ui-helper-hidden-accessible {
		border: 0;
		clip: rect(0 0 0 0);
		height: 1px;
		margin: -1px;
		overflow: hidden;
		padding: 0;
		position: absolute;
		width: 1px;
		}

</style>
@endsection