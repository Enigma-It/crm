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
                        <div class="col-md-12">
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
                                    <form role="form" action="{{ url('/update_story/'.$story->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf 

                                <div class="row">  

                                 <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">      
                                   <div class="select_image" style="width: 100%; height: 300px; border:1px solid #ddd;">
                                      @if(!empty($story))
                                          <img src='{{asset("$story->photo")}}'id="health-image" style="width: 100%;height: 100%">
                                      @else
                                          <img src='{{asset("storage/app/public/uploads/upload-doc.png")}}' id="health-image" style="width: 100%;height: 100%">
                                      @endif
                                   </div>
                                       <label class="btn btn-success" style="width: 100%;margin-top: 5px;">
                                            Upload Successful Story<input type="file" name="photo" class="form-control" id="health-image-select"  style="display: none;" />
                                       </label>
                                   </div>
                                   <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12"> 
                                        <label>Success Story Description</label>
                                               <textarea id="successStory" class="ckeditor" name="description" >{!! $story->description !!}</textarea>

                                   </div>
                                  </div>
                                </div> 

                                   <button type="submit" class="btn btn-success" style="width: 150px;margin-bottom:5px; margin-left: 374px;"> Submit </button>

                                
                                    </form>
                                </div><!-- panel-body -->
                            </div> <!-- panel -->
                        </div> <!-- col-->

                    </div>
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
   <script type="text/javascript">
        $(document).ready(function(){
         $("#health-image-select").change(function(){

            console.log("click");
            readURL1(this);
        });
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#health-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
    </script>
    </section>
@endsection