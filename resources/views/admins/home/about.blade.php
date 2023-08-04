@extends('admins.admin_master')
@section('index')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12"></div>
<div class="col-10">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">About Page</h4>
            
            <form method="post" action="{{route('update.aboout')}}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{$about->id}}">

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input name="title" class="form-control" type="text" value="{{ $about->title }}"  id="example-text-input">
                </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                <div class="col-sm-10">
                    <input name="short_title" class="form-control" type="text" value="{{ $about->short_title }}"  id="example-text-input">
                </div>
            </div>

            <!-- end row -->


              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                <div class="col-sm-10">
                   
                        <textarea required="" name="short_desc" class="form-control" rows="5">{{ $about->short_desc }}</textarea>
                    
                </div>
            </div>

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                <div class="col-sm-10">
                    <textarea id="elm1" name="long_desc">{{ $about->long_desc }}</textarea>
                </div>
            </div>
            <!-- end row -->


            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">About Image </label>
                <div class="col-sm-10">
           <input name="about_image" class="form-control" type="file" id="image">
                </div>
            </div>
            <!-- end row -->


              <div class="row mb-3">
                 <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10">
                    <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($about->about_image))? url( $about->about_image):url('upload_image/admin_image/no_image.jpg') }}" alt="Card image cap">
            <div class="row mb-3">
                <input  type="submit" class="btn btn-info waves-effect waves-light" value="Update">
           </div>
        </div>
    </div>
           
            </form>
             
           
           
        </div>
    </div>
</div> <!-- end col -->
</div>
 


</div>
</div>


<script type="text/javascript">
    
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>