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
                        <!-- Basic example -->
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">View Story</h3></div>
                                <div class="row">  
                                  
                                 <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12"> 
                                  <label>Successful Story Image</label>    
                                   <div class="select_image" style="width: 100%; height: 300px; border:1px solid #ddd;">
                                          <img src='{{asset("$single->photo")}}'id="health-image" style="width: 100%;height: 100%">
                                   </div>
                                   </div>
                                   <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12"> 
                                      <label>Success Story Description</label>
                                               <textarea id="successStory" class="ckeditor" name="description" >{!! $single->description !!}</textarea>

                                   </div>
                                  </div>


                                <!-- panel-body -->
                            </div> <!-- panel -->
                        </div> <!-- col-->
                    </div>
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
    </section>
@endsection