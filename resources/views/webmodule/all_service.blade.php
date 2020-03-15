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
                            <a href="{{ route('service') }}" class="btn btn-primary">ADD SERVICE</a>
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
                                    <h3 class="panel-title">All Services</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <table id="datatable" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Service Name</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>


                                                <tbody>
                                                @foreach($services as $row)
                                                    <tr>
                                                        <td>{{ $row->name }}</td>
                                                        <td>{{ substr($row->description,0,50) }}....</td>
                                                        <td><img src="{{ $row->photo }}" style="height: 60px; width: 60px;"></td>
                                                        <td>
                                                            <a href="{{ URL::to('edit_service/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                            <a href="{{ URL::to('delete_service/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                                            <a href="{{ URL::to('view_service/'.$row->id) }}" class="btn btn-sm btn-primary">View</a>
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

