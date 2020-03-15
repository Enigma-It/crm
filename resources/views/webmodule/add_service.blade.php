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
                            <a href="{{ route('all_service') }}" class="btn btn-primary">ALL SERVICE</a>
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">Enigma</a></li>
                                <li class="active">IT</li>
                            </ol>
                        </div>
                    </div>
                    <!-- Start Widget -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Add Services</h3>
                                </div>
                                <div class="panel-body">
                                    <form  action="{{ url('/insert-service') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Services Name</label>
                                                <input type="text" class="form-control" name="name"  placeholder="Enter services name"  required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Services Description</label>
                                                <input type="text" class="form-control" name="description"  placeholder="services description"  required>
                                            </div>
                                            <div  class="col-md-6">
                                                <label for="exampleInputPassword11">Images</label>
                                                <input type="file" class="form-control" name="photo">
                                            </div>
                                        </div>

                                        <br>

                                        <button class="btn btn-primary" type="submit">ADD</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
    </section>
@endsection

