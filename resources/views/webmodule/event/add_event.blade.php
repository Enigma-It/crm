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
                            <a href="{{ route('all_event') }}" class="btn btn-primary">ALL Event</a>
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
                                    <h3 class="panel-title">ALL Event</h3>
                                </div>
                                <div class="panel-body">
                                    <form  action="{{ url('/insert-event') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Event Description</label>
                                                <input type="text" class="form-control" name="description"  placeholder="services description"  required>
                                            </div>
                                            <div  class="col-md-6">
                                                <img id="image" src="#" />
                                                <label for="exampleInputPassword11">Images</label>
                                                <input type="file"  name="photo" accept="image/*"  required onchange="readURL(this);">
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
@endsection

