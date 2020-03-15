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
                                <div class="panel-heading"><h3 class="panel-title">View Blog</h3></div>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Blog Title</label>
                                        <p>{{ $single->blog_title }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword20">Blog Details</label>
                                        <p>{{ $single->blog_details }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword19">Photo</label>
                                        <img style="height: 80px; width: 80px;" src="{{ URL::to($single->photo) }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword20">Vedio Link</label>
                                        <p>{{ $single->vedio_url }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword20">Date</label>
                                        <p>{{ $single->date }}</p>
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