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
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
                <form action="{{ $action }}" id="main_form" method="POST" enctype="multipart/form-data" class="tab-wizard wizard-circle wizard">
                    
                    @csrf
                    <h5>Location Info</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Pickup Location :</label>
                                    <input type="text" name="pickup_location" id="pickup_location" class="form-control" autocomplete="off" required value="{{ isset($booking_trip->pickup_location) ? $booking_trip->pickup_location :  old('pickup_location') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Destination Location :</label>
                                    <input type="text" name="destination_location" id="destination_location"  class="form-control" autocomplete="off" required value="{{ isset($booking_trip->destination_location) ? $booking_trip->destination_location :  old('destination_location') }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
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

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Pickup Date :</label>
                                    <input type="date" name="pickup_date" id="pickup_date" class="form-control " placeholder="Select Date" value="{{ isset($booking_trip->pickup_date) ? $booking_trip->pickup_date :  old('pickup_date') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group round-trip">
                                    <label for="return_date">Return Date :</label>
                                    <input type="date" name="return_date" id="return_date" class="form-control " placeholder="Select Date" value="{{ isset($booking_trip->return_date) ? $booking_trip->return_date :  old('return_date') }}">
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
                    </section>
                    <!-- Step 2 -->
                    <h5>Available Vehicles</h5>
                    <section>
                        <div  id="available_vehicles_loader" class="mb-4">
                            <h4>Loading Data...</h4>
                            <div class="progress">
								<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
                       </div>
                       <input type="hidden" name="trip_id" id="trip_id" />
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
                    <h5>Personal Info</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control personel-info" value="{{ isset($booking->firstname) ? $booking->firstname :  old('firstname') }}"/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Middle Name:</label>
                                    <input type="text" name="middlename" name="middlename"  class="form-control personel-info" value="{{ isset($booking->middlename) ? $booking->middlename :  old('middlename') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input type="text" name="lastname" name="lastname"  class="form-control personel-info"  value="{{ isset($booking->lastname) ? $booking->lastname :  old('lastname') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Of Birthday:</label>
                                    <input type="date" name="date_of_birthday" name="date_of_birthday"  class="form-control  personel-info" value="{{ isset($booking->date_of_birthday) ? $booking->date_of_birthday :  old('date_of_birthday') }}">
                                </div>
                            </div>
                          
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sex:</label>
                                    <select class="form-control" name="sex" name="sex" >
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Address:</label>
                                    <input type="text" name="address" name="address"  class="form-control" value="{{ isset($booking->address) ? $booking->address :  old('address') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Telephone:</label>
                                    <input type="text" name="telephone" id="telephone"  class="form-control personel-info" value="{{ isset($booking->telephone) ? $booking->telephone :  old('telephone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Passport Number:</label>
                                    <input type="text" name="passport_number" id="passport_number"  class="form-control personel-info" value="{{ isset($booking->passport_number) ? $booking->passport_number :  old('passport_number') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="block_trip_number" >
                                    <label>Trip Number:</label>
                                    <input type="text" name="trip_number" id="trip_number"  class="form-control" value="{{ isset($booking->trip_number) ? $booking->trip_number :  old('trip_number') }}">
                                </div>
                            </div>
                        </div>
                        <h4>PASSENGERS INFO:</h4>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Nationality</th>
                                    <th>Sex</th>
                                    <th>Passwoprt Number</th>
                                </tr>
                            </thead>
                            <tbody id="pessengers_tbody">
                            </tbody>
                        </table>
                    </section>
                    <!-- Step 4 -->
                    <h5>Confirm</h5>
                    <section>
                        <table class="table table-bordered table-hover table-striped">
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
                if($('#pickup_location').val() == "" || $('#destination_location').val() == "" || $('#pickup_date').val() == ""){

                    $('#pickup_location').addClass('is-invalid')
                    $('#destination_location').addClass('is-invalid')
                    $('#pickup_date').addClass('is-invalid')

                    return false;
                }else if($('input[name="trip_type"]').val() == "round" && $('#return_date').val() == ""){
                    $('#return_date').addClass('is-invalid')

                    return false;
                }else{
                    $('input').removeClass('is-invalid')
                    $('#available_vehicles_loader').show()
                    $('#available_vehicles_tbody').empty()
                    $.ajax({
                        url:"{{ route('getVehicle') }}",
                        type:"GET",
                        data:{
                            from_location: $('#pickup_location').val(),
                            to_location:$('#destination_location').val(),
                            perssengers:$('#perssengers').val()
                        },
                        success:function(data){
                            $('#available_vehicles_tbody').empty()
                            $('#trip_id').val(data.trip_id)
                            if(data.is_airport){
                                is_airport = true
                            }else{
                                is_airport = false
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
                                    html += value.private_price + "$"
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
                    for (let i = 1; i < pessensgers_number; i++) {
                        html += '<tr>'
                        html += '<td>'
                        html += '<input type="text" name="pessenger['+i+'][firstname]" class="form-control personel-info" />'
                        html += '</td>'
                        html += '<td>'
                        html += '<input type="text" name="pessenger['+i+'][middlename]" class="form-control personel-info" />'
                        html += '</td>'
                        html += '<td>'
                        html += '<input type="text" name="pessenger['+i+'][lastname]" class="form-control personel-info" />'
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
                        html += '<select class="form-control" name="pessenger['+i+'][sex]">'
                        html += '<option value="male">Male</option>'
                        html += '<option value="female">Female</option>'
                        html += '</select>'
                        html += '</td>'
                       
                        html += '<td>'
                        html += '<input type="text" name="pessenger['+i+'][passport_number]" class="form-control personel-info" />'
                        html += '</td>'
                        html += '</tr>'
                    }
                    $('#pessengers_tbody').append(html)
                    if(is_airport){
                        $('#block_trip_number').show()
                        $('#trip_number').addClass('personel-info')
                    }else{
                        $('#block_trip_number').hide()
                        $('#trip_number').removeClass('personel-info')
                    }
                    $('#main_form .personel-info').each(function(){
                        $(this).removeClass('is-invalid')
                       
                    })
                    return true
                }
            }else if(currentIndex == 2 && priorIndex == 3){
                var completed_fields = true

                $('#main_form .personel-info').each(function(){
                        $(this).removeClass('is-invalid')
                       
                })

                $('#main_form .personel-info').each(function(){
                    if($(this).val() == ""){
                        $(this).addClass('is-invalid')
                        completed_fields = false
                    }
                })
                // calculate total
                $.ajax({
                    type:"POST",
                    url:"{{ route('calculateTripTotal') }}",
                    data:$('#main_form').serialize(),
                    success:function(results){
                        $('#one_way_total').html(results.totals.one_way + '$')
                        if(results.totals.round_trip){
                            $('#round_trip_total').html(results.totals.round_trip + '$')
                        }else{
                            $('#round_trip_total').html('0$')
                        }
                        $('#total').html(results.totals.total + '$')
                    }
                })
                return completed_fields
            }else{
                return true
            }
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
          
            $('.steps .current').prevAll().addClass('disabled');
        },
        onFinished: function (event, currentIndex) {
            $('#success-modal').modal('show');
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


	$('.round-trip').hide()
	$('input[type=radio][name=trip_type]').change(function() {
		if (this.value == 'round') {
			$('.round-trip').show()
			$(".round-trip").prop('required',true);

		}
		else if (this.value == 'one_way') {
			$('.round-trip').hide()
			$(".round-trip").prop('required',false);
		}
	});
    $('.date-picker').datepicker({
        dateFormat: 'dd-mm-yyyy'
            });
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