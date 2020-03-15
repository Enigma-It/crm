@extends('layouts.layout')
@section('title','News Add/Edit')
@section('content')
    <section class="content">
        @include('common.message')
        <div class="content-page">
            <div class="content">
                <div class="">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="{{ url('all-news') }}" class="btn btn-primary">ALL News List</a>
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
                                    <h3 class="panel-title">Add News</h3>
                                </div>
                                <div class="panel-body">
                                  @if( !empty($news) )
                                        {{Form::open(array('route'=>['news.update',$news->id],'method'=>'PUT','files'=>true))}}    
                                    @else
                                      {!! Form::open(array('route' => ['news.store'],'class'=>'form-horizontal','method'=>'POST','files'=>true)) !!}
                                     @endif &nbsp;&nbsp;


                                   
                                        <div class="row">
                                            <div class="form-group col-lg-6" align="center">
                                              <label>News Image</label>

                                              <div class="select_image" style="width: 100%; height: 300px; border:1px solid #ddd;">
                                             @if(!empty($news))
                                                <img src='{{asset("$news->photo")}}'id="health-image" style="width: 100%;height: 100%">

                                             @else
                                               <img src='{{asset("storage/app/public/uploads/upload-doc.png")}}' id="news-image" style="width: 100%;height: 100%">
                                              @endif
                                              </div>

                                           <label class="btn btn-success" style="width: 100%;margin-top: 5px;">
                                              Upload News Image<input type="file" name="photo" class="form-control" id="news-image-select" style="display: none;">
                                          </label>
                                           <label style="color: #ff0000">N.B- Image sige should be (400X300)</label>

                                          </div>
                                          <div class="col-md-6">
                                             <label>News Description</label>
                                               <textarea id="successStory" class="ckeditor" name="description">{{ !empty($news) ? $news->description : '' }}</textarea>
                                          </div>
                                        </div>
                                        <br>
                                         <button class="btn btn-primary btn-lg health_button"  type="submit" style="width: 100%;color: #fff;">
                                            {{ !empty($news) ? 'UPDATE' : 'ADD' }}
                                        </button>
                                   {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
    </section>
<script type="text/javascript">
         $("#news-image-select").change(function(){
                readURL(this);
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#news-image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }   
    </script>
@endsection






