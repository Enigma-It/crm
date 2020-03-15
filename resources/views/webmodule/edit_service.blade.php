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
                                <li><a href="#">probe</a></li>
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
                                <div class="panel-heading"><h3 class="panel-title">Update Package</h3></div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="panel-body">
                                    <form role="form" action="{{ url('/update_service/'.$service->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">service Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $service->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword20">service Description</label>
                                            <input type="text" class="form-control" name="description"  value="{{ $service->description }}" required>
                                        </div>

                                        <div class="form-group">
                                            <img id="image" src="#" />
                                            <label for="exampleInputPassword11">Photo</label>
                                            <input type="file"  name="photo" accept="image/*"   onchange="readURL(this);">
                                        </div>

                                        <div class="form-group">
                                            <img  src="{{ URL::to($service->photo) }}" style="height: 90px; width: 90px;" />
                                            <label for="exampleInputPassword11">OldPhoto</label>
                                            <input type="hidden"  name="old_photo" value="{{ $service->photo }}" >
                                        </div>

                                        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                                    </form>
                                </div><!-- panel-body -->
                            </div> <!-- panel -->
                        </div> <!-- col-->

                    </div>
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image')
                            .attr('src', e.target.result)
                            .width(80)
                            .height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </section>
@endsection