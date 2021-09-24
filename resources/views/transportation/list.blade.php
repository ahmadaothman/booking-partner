@extends('index')
@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4><i class="icon-copy fa fa-map-pin" aria-hidden="true"></i> Transportation</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Transportation</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a type="button" class="btn btn-primary " href="{{ route('addtransportationBooking') }}"><i class="icon-copy fi-plus"></i> Book Trips</a>
                </div>
            </div>
        </div>
        @if(session()->has('status'))
                
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session()->get('status') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <form id="from" action="" method="POST" class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <p class="text-right">
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="icon-copy fa fa-filter" aria-hidden="true"></i> Filters
                </a>
            
            </p>

            @if (app('request')->input('filter_name') || app('request')->input('filter_description') || app('request')->input('filter_max_people') || app('request')->input('filter_price') )
                <div class="collapse mb-20 show" id="collapseExample">
            @else
                <div class="collapse mb-20 " id="collapseExample">
            @endif
          
                <div class="card card-body">
                    <div class="row mb-20">
                        <!--Trip Type-->

                        <div class="col-sm-3">
                            <label for="filter_name">Trip Type:</label>
                            <select class="form-control form-control-sm" id="filter_trip_type">
                                <option value="-1">--none--</option>
                                @if(app('request')->input('filter_trip_type') == 'one_way')
                                 <option value="one_way" selected="selected">One Way</option>
                                @else 
                                <option value="one_way" ">One Way</option>
                                @endif
                                @if(app('request')->input('filter_trip_type') == 'round')
                                 <option value="round" selected="selected">Round Trip</option>
                                @else 
                                <option value="round" ">Round Trip</option>
                                @endif
                            </select>
                        </div>
          
                         <!--Filter Desc -->
                         <div class="col-sm-3">
                            <label for="filter_city">Filter Description:</label>
                            <input type="text" id="filter_description" class="form-control form-control-sm" placeholder="Filter Description" value="{{ app('request')->input('filter_description') }}"/>
                        </div>
                         <!--Filter Max -->
                         <div class="col-sm-3">
                            <label for="filter_city">Filter Max Peape:</label>
                            <input type="text" id="filter_max_people" class="form-control form-control-sm" placeholder="Filter Max Peape" value="{{ app('request')->input('filter_max_people') }}"/>
                        </div>
                        <!--Filter Price -->
                        <div class="col-sm-3">
                            <label for="filter_telephone">Filter Price:</label>
                            <input type="text" id="filter_price" class="form-control form-control-sm" placeholder="Filter Price" value="{{ app('request')->input('filter_price') }}"/>
                        </div>
                        
                        
                    </div>
                    <div class="row mb-20">
                        <!--Filter Name-->

                        <div class="col-sm-3">
                            <label for="filter_name">Filter Name:</label>
                            <input type="text" id="filter_name" class="form-control form-control-sm" placeholder="Filter Name" value="{{ app('request')->input('filter_name') }}"/>
                        </div>
          
                         <!--Filter Desc -->
                         <div class="col-sm-3">
                            <label for="filter_city">Filter Description:</label>
                            <input type="text" id="filter_description" class="form-control form-control-sm" placeholder="Filter Description" value="{{ app('request')->input('filter_description') }}"/>
                        </div>
                         <!--Filter Max -->
                         <div class="col-sm-3">
                            <label for="filter_city">Filter Max Peape:</label>
                            <input type="text" id="filter_max_people" class="form-control form-control-sm" placeholder="Filter Max Peape" value="{{ app('request')->input('filter_max_people') }}"/>
                        </div>
                        <!--Filter Price -->
                        <div class="col-sm-3">
                            <label for="filter_telephone">Filter Price:</label>
                            <input type="text" id="filter_price" class="form-control form-control-sm" placeholder="Filter Price" value="{{ app('request')->input('filter_price') }}"/>
                        </div>
                        
                        
                    </div>
                    <div class="w-100 text-right ">
                        <button  type="button" id="btn_filter" class="btn btn-info btn-sm" onclick="filter()"> 
                            <i class="icon-copy fa fa-filter" aria-hidden="true"></i> Filters
                        </button>
                    </div>
                </div>
            </div>
           @csrf
           <div class="row">
            <table class="table table-striped  table-hover  data-table-export table-sm " style="font-size:14px">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">ID</th>
                            <th class="table-plus datatable-nosort">From</th>
                            <th class="table-plus datatable-nosort">To</th>
                            <th class="table-plus datatable-nosort">Trip</th>
                            <th class="table-plus datatable-nosort">Name</th>
                            <th class="table-plus datatable-nosort">Telephone</th>
                            <th class="table-plus datatable-nosort">Booking Date</th>
                            <th class="table-plus datatable-nosort">Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                <tbody>
                  @foreach ($bookings as $booking)
                      <tr>
                          <td class="align-middle">{{ $booking->id }}</td>
                          <td class="align-middle">{{ $booking->Trip->from_location }}</td>
                          <td class="align-middle">{{ $booking->Trip->to_location }}</td>
                          <td class="align-middle">{{ $booking->trip_type }}</td>
                          <td class="align-middle">{{ $booking->firstname }}</td>
           
                          <td class="align-middle">{{ $booking->telephone }}</td>
                          <td class="align-middle">{{ $booking->booking_date }}</td>
                          <td class="py-3 px-2 text-center align-midlle" style="font-size: 14px !important;">
                   
                          <span class="bg-success p-2 text-white rounded">Approved</span>
               

                          </td>
                          <td class="align-middle" >
                            <a href="{{ route('ViewTripBooking',['id' => $booking['id']]) }}" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                          </td>
                      </tr>
                  @endforeach
                </tbody>
             
            </table>
            <div class="w-100" >
               
                {{ $bookings->appends($_GET)->links('vendor.pagination.default') }}
                <div class="float-right h-100" style="padding-top: 25px">
                    <strong>
                        Showing {{ $bookings->count() }} From {{ $bookings->total() }} Trips
                    </strong>
                </div>

            </div>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
  function filter(){
    var url = '';
    if($('#filter_trip_type').val() != "-1"){
        url += '&filter_trip_type=' + $('#filter_trip_type').val();
    }
    location.href = "{{ route('transportation_booking',) }}/?" + url

  }
</script>
@endsection