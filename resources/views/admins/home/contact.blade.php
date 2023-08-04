@extends('admins.admin_master')
@section('index')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">All Messages</h4>



                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row">
        <div class="col-2"></div>
        <div class="col-10">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Message List</h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Send At</th>
                            

                        </thead>


                        <tbody>
                        	@php($i = 1)
                        	@foreach($get_msg as $item)
                        <tr>
                            <td> {{ $i++}} </td>
                        <!--showing blog category name by relation with category and blog table-->
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->email }} </td>
                            <td> {{ $item->subject}} </td>
                            <td> {{ $item->phone}} </td>
                            <td> <a href="{{route('message_details', $item->id)}}">{{ Str::limit($item->message, 20)}}</a> </td>
                            <td> {{ ($item->created_at)->diffForHumans()	 }}  </td>
                            <td>
        

                            </td>

                        </tr>
                        @endforeach

                        </tbody>
                    </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                    </div> <!-- container-fluid -->
                </div>