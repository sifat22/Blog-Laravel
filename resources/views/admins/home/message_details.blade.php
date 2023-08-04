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

            <h4 class="card-title">Message Details </h4>

           

               

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Edit Category</label>
                <div class="col-sm-10">
                    <textarea name="message" id="message" >{{$get_details_message->message}}</textarea>
                   
                   
                    
                </div>
            </div>
            <!-- end row -->

              


           


           
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