@extends('layouts.layouts')
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
                        <!-- Basic example -->
                        <div class="col-md-2"></div>
                        <div class="col-md-8 ">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">View Event</h3></div>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <p>{{ $single->description }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword19">Photo</label>
                                        <img style="height: 80px; width: 80px;" src="{{ URL::to($single->photo) }}" />
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