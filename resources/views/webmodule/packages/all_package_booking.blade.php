@extends('layouts.layout')
@section('content')
    <section class="content">
        @include('common.message')
        <div class="content-page">
            <div class="content">
                <div class="">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pull-left page-title">Welcome !</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">Probe</a></li>
                                <li class="active">IT</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Start Widget -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">All Package Booking List</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <table id="datatable" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>


                                                   <tbody>
                                                   @foreach($package_booking as $row)
                                                       <tr>
                                                           <td>{{ $row->name }}</td>
                                                           <td>{{ $row->phone }}</td>
                                                           <td>{{ $row->email }}</td>
                                                           <td>{{ $row->address }}</td>
                                                           <td>
                                                               <a href="" class="btn btn-sm btn-info">Edit</a>
                                                               <a href="" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                                               <a href="" class="btn btn-sm btn-primary">View</a>
                                                           </td>
                                                       </tr>
                                                   @endforeach
                                                   </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
    </section>
@endsection

