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
                            <a href="{{ route('health.index') }}" class="btn btn-primary">ALL HEALTH TIPS</a>
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
                                    <h3 class="panel-title">ALL HEALTH TIPS</h3>
                                </div>
                                <div class="panel-body">
                                    @if( !empty($healthtipData) )
                                        {{Form::open(array('route'=>['health.update',$healthtipData->id],'method'=>'PUT','files'=>true))}}    
                                    @else
                                      {{Form::open(array('route'=>['health.store'],'method'=>'POST','files'=>true))}}
                                     @endif &nbsp;&nbsp;       
                                      <div class="form-row">
                                            <div class="form-group col-lg-12" align="center">
                                                <div class="select_image" style="width: 100%; height: 300px; border:1px solid #ddd;">
                                                    @if(!empty($healthtipData))
                                                        <img src='{{asset("storage/app/public/uploads/healthtips/$healthtipData->photo")}}'id="health-image" style="width: 100%;height: 100%">
                                                    @else
                                                    <img src='{{asset("storage/app/public/uploads/upload-doc.png")}}' id="health-image" style="width: 100%;height: 100%">
                                                    @endif

                                                </div>
                                                <label class="btn btn-success" style="width: 100%;margin-top: 5px;">
                                                    Upload Health Tips <input type="file" name="photo" class="form-control" id="health-image-select"  style="display: none;" />
                                                </label>
                                            </div>
                                        </div>
                                        <br>
                                        <button class="btn btn-primary btn-lg health_button"  type="submit">
                                            {{ !empty($healthtipData) ? 'UPDATE' : 'ADD' }}
                                        </button>
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
@endsection

