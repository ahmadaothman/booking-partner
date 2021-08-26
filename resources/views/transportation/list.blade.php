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
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Transportation</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a type="button" class="btn btn-primary " href="{{ route('addtransportationBooking') }}"><i class="icon-copy fi-plus"></i> Book Trips</a>
                    <button id="sa-warning" type="button" class="btn btn-danger" onclick="remove();"><i class="icon-copy fi-trash"></i> Remove</button>
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
                        <button  type="button" id="btn_filter" class="btn btn-info btn-sm"> 
                            <i class="icon-copy fa fa-filter" aria-hidden="true"></i> Filters
                        </button>
                    </div>
                </div>
            </div>
           @csrf
           <div class="row">
           
            <div class="w-100" >
                   
               

            </div>
           </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#select-all').click(function(event) {   
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;                        
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;                       
            });
        }
    });

    function remove(){
    
        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover deleted trips!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            closeOnConfirm: false
        },
        function(confirn){
            
        }).then(function (isConfirm) {
            if(isConfirm.value){
                document.getElementById('from').submit();
            }
            //success method
            },function(){
        });
    }
</script>
@endsection