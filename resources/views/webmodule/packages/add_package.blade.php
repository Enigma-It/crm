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
                            <a href="{{ route('all_package') }}" class="btn btn-primary">ALL PACKAGE</a>
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
                                    <h3 class="panel-title">Add Packages</h3>
                                </div>
                                <div class="panel-body">
                                    <form  action="{{ url('/insert-package') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Package Name</label>
                                                <input type="text" class="form-control" name="name"  placeholder="Enter Package name"  required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Package Description</label>
                                                <input type="text" class="form-control" name="description"  placeholder="Package description"  required>
                                            </div>
                                            <div  class="col-md-6">
                                                <img id="image" src="#" />
                                                <label for="exampleInputPassword11">Images</label>
                                                <input type="file"  name="photo" accept="image/*"  required onchange="readURL(this);">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Package Price</label>
                                                <input type="text" class="form-control" name="price"  placeholder="services price" required>
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

