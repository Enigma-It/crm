@extends('backend.admin')
@section('content')
 <section class="content">
     @include('backend.message')
    <div class="content-page">
        <div class="content">
            <div class="">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">Welcome !</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">prolay</a></li>
                            <li class="active">IT</li>
                        </ol>
                    </div>
                </div>
                <!-- Start Widget -->
                <div class="row">
                    <!-- Basic example -->
                    <div class="col-md-2"></div>
                    <div class="col-md-8 ">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title">View Agent</h3></div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <p>{{ $single->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword20">Email</label>
                                    <p>{{ $single->email }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword21">Phone</label>
                                    <p>{{ $single->phone }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword19">Locality</label>
                                    <p>{{ $single->locality }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword18">Property</label>
                                        <p>{{ $single->property }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword17">Age.</label>
                                    <p>{{ $single->age }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword41">Orgranization Name</label>
                                    <p>{{ $single->org_name }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword13">Orgranization Type</label>
                                    <p>{{ $single->org_type }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword12">Bed</label>
                                    <p>{{ $single->bed }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword12">In Patient</label>
                                    <p>{{ $single->in_patient }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword12">Out Patient</label>
                                    <p>{{ $single->out_patient }}</p>
                                </div>
                            </div><!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col-->
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
 </section>
@endsection