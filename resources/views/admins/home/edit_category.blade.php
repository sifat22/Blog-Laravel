@extends('admins.admin_master')
@section('index')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
    <div class="col-2"></div>
<div class="col-10">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Protfolio Page </h4>

            <form method="post" action="{{ route('update.category') }}">
                @csrf

                <input type="hidden" type="text" name="id" value="{{$edit_cate->id}}">

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Edit Category</label>
                <div class="col-sm-10">
                    <input name="category_name" class="form-control" type="text" id="example-text-input" value="{{$edit_cate->category_name}}">
                    @error('category_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <!-- end row -->

              


           


            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Category Data">
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