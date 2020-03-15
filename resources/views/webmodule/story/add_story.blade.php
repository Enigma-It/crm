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
                            <a href="{{ route('all_story') }}" class="btn btn-primary">ALL STORY</a>
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
                                    <h3 class="panel-title">Add Success Story</h3>
                                </div>
                                <div class="panel-body">
                                    <form  action="{{ url('/insert-story') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-lg-6" align="center">
                                              <label>Success Story Image</label>
                                              <div class="select_image" style="width: 100%; height: 300px; border:1px solid #ddd;">
                                              <img src='{{asset("storage/app/public/uploads/upload-doc.png")}}' id="story-image" style="width: 100%;height: 100%">
                                            </div>
                                           <label class="btn btn-success" style="width: 100%;margin-top: 5px;">
                                              Upload Success Story Image<input type="file" name="photo" class="form-control" id="story-image-select" style="display: none;">
                                          </label>
                                           <label style="color: #ff0000">N.B- Image sige should be (400X300)</label>

                                          </div>
                                          <div class="col-md-6">
                                             <label>Success Story Description</label>
                                               <textarea id="successStory" class="ckeditor" name="description"></textarea>
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
       
         $("#story-image-select").change(function(){
                readURL(this);
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#story-image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }   
    </script>
@endsection






