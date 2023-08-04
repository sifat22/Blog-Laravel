@extends('admins.admin_master')
@section('index')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    } 
</style>

<div class="page-content">
<div class="container-fluid">

<div class="row">
    <div class="col-2"></div>
<div class="col-10">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title"> Edit Blog Page </h4>

            <form method="post" action="{{route('update_blog.section')}}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{$edit_blog->id}}">

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                <div class="col-sm-10">
            <select name="blog_category_id" class="form-select" aria-label="Default select example">
            <option selected="">Open this select menu</option>
            @foreach ($get_cat as $cat)
                
           
            <option value="{{$cat->id}}" {{$cat->id == $edit_blog->blog_category_id ?'selected' : ''}}>{{$cat->category_name}}</option>
            @endforeach
            
            </select>
               </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title </label>
                <div class="col-sm-10">
                    <input name="blog_title" class="form-control" type="text" id="example-text-input" value="{{$edit_blog->blog_title}}">

                    @error('blog_title')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <!-- end row -->


            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags </label>
                <div class="col-sm-10">
                    <input name="tags" class="form-control" type="text" id="example-text-input" value="{{$edit_blog->tags}}">

                    @error('tags')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>



            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Description </label>
                <div class="col-sm-10">
      <textarea id="elm1" name="blog_desc">
        {{$edit_blog->blog_desc}}

      </textarea>
                </div>
            </div>
            <!-- end row -->

             <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image </label>
                <div class="col-sm-10">
           <input name="blog_image" class="form-control" type="file" id="image">
                </div>
            </div>
            <!-- end row -->


              <div class="row mb-3">
                 <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10">
            <img id="showImage" class="rounded avatar-lg" src="{{ url($edit_blog->blog_image) }}" alt="Card image cap">
                </div>
            </div>
            <!-- end row -->
<input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog Data">
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