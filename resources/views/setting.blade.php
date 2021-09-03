@extends('index')
@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                  
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Setting</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <button type="submit" class="btn btn-primary " onclick="event.preventDefault();
                    document.getElementById('vehicle-form').submit();"><i class="icon-copy fi-save"></i> Save</button>

                </div>
            </div>
        </div>
       
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h5 class="text-blue">Setting</h5>
                </div>
            </div>
            <div class="container">
               
                <form id="vehicle-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Logo:</label>
                        <div class="col-sm-12 col-md-10">
                            <img id="user_logo"  src="{{ isset($user->logo) ? asset($user->logo)  : '/no_image.jpeg' }}" onclick="selectimage(0)">

                            <input type="file" class="form-control" name="image" id="image"  accept="image/*" onchange="readURL(this,0);">
                        </div>
                    </div>
                  
                   
                   
                   
                  
                </form>
							
            </div>
        </div>
        <!-- Export Datatable End -->
    </div>
</div>

<script type="text/javascript">
    function selectimage(row_index){
        $('#image').trigger('click');   
    }
    function readURL(input,target_index) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#user_logo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<style>
    img{
        max-height: 75px;
        cursor: pointer;
    }
</style>
@endsection
