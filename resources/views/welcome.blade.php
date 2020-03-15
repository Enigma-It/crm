@extends('webmodule.layouts.web-layouts')
@section('content')
<?php
    use App\Library\pmscommon;    
?>  
@include('common.commonFunction')
    <div role="main" class="main">
        <div class="home-banner" style="max-height:450px;">
            <img src="public/frontend/img/photo1-26.jpg" width="100%" height="100%">
        </div>
        <div class="home-intro home-intro-quaternary" id="home-intro">
            <div class="container">

                <div class="row text-center">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="desktop-box ">

                            <div class="icon_maindiv">
                                <div class="icon1_maindiv">
                                    <div class="icon1"></div>
                                </div>
                            </div>
                            <div class="icon_heading">DOWNLOAD REPORT</div>

                            <div class="icon_subheading1" style="margin-bottom:12px; font-size:14px;">Click here to
                                download report online
                            </div>
                            <a href="#" target="_blank">
                                <div class="download_report_div">Download Report</div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="desktop-box ">

                            <form>
                                <div class="icon_maindiv">
                                    <div class="icon1_maindiv">
                                        <div class="icon2"></div>
                                    </div>
                                </div>

                                <div class="icon_heading">FIND A LAB</div>
                                <div class="icon_subheading">Find your nearest center</div>
                                <div class="icon_subheading">
                                    <select data-placeholder="Search By Location..." class="download_report_div "
                                            name="center_id" id="center_id"
                                            style="width:100%; border:0px; background-color:#FFF;" required="">
                                        <option value="" selected="selected">Country</option>
                                        <option value="1">Bangladesh</option>
                                        <option value="2">India</option>
                                        <option value="3">Nepal</option>
                                        <option value="4">Bhutan</option>
                                        <option value="5">Srilanka</option>
                                        <option value="42">Singapore</option>
                                    </select>
                                </div>
                                <div class="icon_subheading">
                                    <select data-placeholder="Search By Location..." class="download_report_div "
                                            name="city_id" id="city_id"
                                            style="width:100%; border:0px; background-color:#FFF;" required="">

                                        <option value="" selected="selected">Select City</option>
                                        <option value="1">Dhaka</option>
                                        <option value="2">Delli</option>
                                        <option value="3">Katmundo</option>
                                        <option value="4">Thimbu</option>
                                        <option value="5">Colombo</option>
                                        <option value="42">Singapore</option>
                                    </select>
                                </div>
                                <div class="icon_subheading">
                                    <input name="search" type="button" onclick="get_center()" value="Search"
                                           class="nearestlab_btn" style="width:100%;">
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="desktop-box">
                            <div class="icon_maindiv">
                                <div class="icon1_maindiv">
                                    <div class="icon3"></div>
                                </div>
                            </div>
                            <div class="icon_heading">HELPLINE NO</div>
                            <div class="icon_subheading2" style="margin-bottom:15px;">BANGLADESH : <span style="text-align:right; float:right; font-weight:bold;"><i class="fa fa-phone" style="margin-right:10px; font-size:16px;"></i>+8801942559895 </span></div>
                            <div class="icon_subheading2" style="margin-bottom:15px;">INDIA: <span style="text-align:right; float:right; font-weight:bold;"><i class="fa fa-phone" style="margin-right:10px; font-size:16px;"></i>+918976453298 </span></div>

                        </div>
                    </div>

                </div>

            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col text-center appear-animation" data-appear-animation="fadeInUpShorter"
                     data-appear-animation-delay="200">
                    <h2 class="font-weight-normal text-6 mb-5 common-text">Our <strong
                                class="font-weight-extra-bold">Services</strong></h2>
                </div>
            </div>
            <div class="row">
                @if(isset($serviceList))
                @foreach($serviceList as $service)
                   <div class="col-lg-3 mb-3 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">
                        <div class="feature-box feature-box-secondary feature-box-style-4">
                            <div class="feature-box-icon">
                                <img src='{{asset("$service->photo")}}' style="height: 100px; width: 100px; padding-bottom:30px">
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-2 font-weight-bold">{{$service->name}}</h4>
                                <p class="common-fornt"> 
                                    {{strip_tags(substr($service->description,0,200))}}
                                </p>
                                 <a class="btn btn-info booking" href='{{URL::to("service-details/$service->id")}}'>Details</a>
                            </div>
                        </div>

                    </div>
                @endforeach
                @endif
            </div>


        </div>
        <section class="section bg-color-grey-scale-1 section-height-3 section-no-border appear-animation"
                 data-appear-animation="fadeIn">
            <div class="container">
                <h2 class="font-weight-normal package_header common-text" align="center" >Our <strong
                            class="font-weight-extra-bold">Packages</strong></h2>
                <div class="row">
                    @if(isset($packageList))
                    @foreach($packageList as $package)
                    <div class="col-lg-4 text-center col-sm-6">
                        <div class="single_department">
                            <div class="dpmt-thumb">
                               <img src='{{asset("$package->photo")}}' height="150px" width="150px" alt="">
                            </div>
                            <br>
                            <h5>{{$package->price}}tk</h5>
                            <h4>{{$package->name}}</h4>
                            <p class="common-fornt">{{strip_tags(substr($package->description,0,100))}}</p>
                        </div>
                         <a class="btn btn-info booking" style="width: 225px;" href='{{URL::to("package-details/$package->id")}}'>Details</a>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>

        </section>
    </div>
    <section class="container-fluid find-test">
        <h2 class="common-text" align="center" style="color: #fff">Find a Test</h2>
        <div class="container">
            <div class="row">
                <div class="newsletter_mainBG cre-animate" data-animation="fade-in" data-speed="1000" data-delay="0"
                     data-offset="70%" data-easing="ease">

                    <form action="{{ url('search-test')}}" method="get" name="fm_search" id="fm_search">
                        @csrf
                        <select id="position" name="test_id" class="" style="width: 450px;">
                            <option value="0">--Select Test--</option>
                          @if(isset($testLists))
                              @foreach($testLists as $testList)
                                 <option value="{{ $testList->id }}">{{  $testList->test_name }}</option>
                              @endforeach
                            @endif
                        </select>
                        <!-- <input name="search-box" id="search-box1" type="text" class="newslettertxtbox" autocomplete="off" placeholder="Enter Test Name" style="padding:0px 2%;"> -->
                        <button type="submit" class="newsletterbtn">Search</button>
                        <div id="suggesstion-box"></div>
                    </form>

                </div>
            </div>
        </div>
    </section>


    <section class="section_gap team_area lite_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2 class="common-text" align="center" style="margin-top: 30px;">OUR POPULAR DEPARTMENT</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- single-team-member -->
                @if(isset($doctorList))
                    @foreach($doctorList as $doctor)
                    <div class="col-lg-3 col-sm-6 single_doctor">
                        <div class="single_member">
                            <div class="author">
                                @if($doctor->image !=null)
                                <img src='{{asset("storage/app/public/uploads/doctor/$doctor->image")}}' class="img-responsive" alt="" width="100%" height="150px">
                                @else
                                <img src='{{asset("storage/app/public/uploads/default.png")}}' alt="" class="img-responsive" width="100%" height="150px">
                                @endif
                            </div>
                            <div class="author_decs ">
                                <div class="social_icons text-center">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                                <div class="doctor-info">
                                    <h4 >{{$doctor->first_name}} {{$doctor->last_name}}</h4>
                                    <b>Department:</b>&nbsp;<span>{{$doctor->specialist}}</span><br>
                                    <b>Degree:</b>&nbsp;<span>{{$doctor->educational_qualification}}</span>
                                </div>
                                 
                            </div>
                            <a class="btn btn-default apt-btn" href="#aptModal{{$doctor->id}}" data-toggle="modal">Appointment</a>


                        </div>

                    </div>
                        <div class="modal fade" id="aptModal{{$doctor->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$doctor->first_name}} {{$doctor->last_name}}  
                                    </h5>
                                    <br>

                                    <?php
                                        $docAptArr = json_decode($doctor->appointment_details);  
                                    ?>

                                    <b></b>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>

                                  {{Form::open(array('url'=>['get-appoinment'],'method'=>'POST','files'=>true))}}
                                         <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Appointment Day</h5>
                                                    <div class="form-group doctorDay">

                                                        <span>@foreach($docAptArr as $key => $doctData)
                                                            @foreach(weeks() as $keyId => $day_name)
                                                                @if($doctData->day_id == $keyId)
                                                                {{$day_name}} @ {{date('h:i a',strtotime($doctData->start_time))}}- {{date('h:i a',strtotime($doctData->end_time))}}
                                                                @endif
                                                            @endforeach
                                                        @endforeach</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group doctor-apt-fld">
                                                      <label class="col-form-label label-name">Center Name:</label>
                                                      <input type="text" class="form-control" value="Probe Bangladesh">
                                                      <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                                                    </div>
                                                </div>  
                                             <div class="col-md-6"> 
                                               <div class="form-group doctor-apt-fld">
                                                 <label class="col-form-label label-name">Date:</label>
                                                <input type="date" value="" maxlength="100" class="form-control" name="apt_date">
                                              </div>
                                            </div>

                                            <div class="col-md-6"> 
                                              <div class="form-group doctor-apt-fld">
                                                 <label class="col-form-label label-name">Time:</label>
                                                 <input type="time" class="form-control" name=" apt_time">
                                              </div>
                                            </div>
                                          <div class="col-md-6"> 
                                           <div class="form-group doctor-apt-fld">
                                             <label class="col-form-label label-name">Name:</label>
                                             <input type="text" class="form-control" name="patient_name" required>
                                          </div>
                                        </div>

                                       <div class="col-md-6"> 
                                           <div class="form-group doctor-apt-fld">
                                             <label class="col-form-label label-name">Phone:</label>
                                             <input type="text" class="form-control" name="phone" required>
                                          </div>
                                        </div>

                                         <div class="col-md-6"> 
                                           <div class="form-group doctor-apt-fld">
                                             <label class="col-form-label label-name">Email:</label>
                                             <input type="email" class="form-control" name="email">
                                          </div>
                                         </div>

                                        <div class="col-md-6"> 
                                         <div class="form-group doctor-apt-fld">
                                           <label class="required font-weight-bold text-dark text-2">Sex</label>
                                            <select class="form-control" name="sex">
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                         </div>
                                     </div>

                                  </div>
                                  <div class="modal-footer" style="border-top: 0px;">
                                    <button type="submit" class="btn btn-default apt-btn">Book An Appointment</button>
                                  </div>
                              </div>
                            {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                    <!-- Modal -->
                    @endforeach
                @endif
                <!-- single-team-member -->     
            </div>
        </div>

    </section>


    <!--event-->
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="main_title text-center">
                <h2 class="common-text">OUR POPULAR EVENT</h2>
            </div>
        </div>
    </div>
    <div id="carouselEventControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @if(isset($events))
                @foreach($events as $event)
                  <div class="carousel-item {{ !empty($event->status) ? 'active' : '' }}">
                       <img class="d-block"  src="{{ asset($event->photo) }}" alt="First Health Tips"  width="500px" height="400px">
                  </div>
               @endforeach   
            @endif 
        </div>
        <a class="carousel-control-prev" href="#carouselEventControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselEventControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!--End event-->

    <!-- start event-->
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="main_title text-center">
                <h2 class="common-text">OUR HEALTH TIPS</h2>
            </div>
        </div>
    </div>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @if(isset($healthTip))
                @foreach($healthTip as $health)
                  <div class="carousel-item {{ !empty($health->status) ? 'active' : '' }}">
                       <img class="d-block w-100" src='{{asset("storage/app/public/uploads/healthtips/$health->photo")}}' alt="First Health Tips"  width="100%" height="400px">
                  </div>
               @endforeach   
            @endif
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!--event-->
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="main_title text-center">
                <h2 class="common-text">OUR SUCCESS STORY</h2>
            </div>
        </div>
    </div>
 <!--event-->
    <div id="carouselSuccessControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @if(isset($storyList))
                @foreach($storyList as $story)
                       <div class="carousel-item {{ !empty($story->status) ? 'active' : '' }}">
                           <div class="container">
                               <div class="row">
                               
                                   <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12">
                                     <div class="success-img">
                                          <img class="d-block w-100" src="{{ asset($story->photo) }}" alt="First Health Tips" class="img-responsive" >
                                     </div>
                                  </div> 
                                  <div class="col-md-7 col-lg-7 col-sm-7 col-xs-12">
                                     <div class="success-msg">
                                         <i class="fa fa-quote-left"></i> &nbsp;{!! $story->description  !!} &nbsp;<i class="fa fa-quote-right"></i>
                                     </div>
                                   </div> 
                                </div>
                           </div>
                       </div>
                 @endforeach   
            @endif
        </div>
        <a class="carousel-control-prev" href="#carouselSuccessControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselSuccessControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<!-- blog start -->
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 text-center appear-animation" data-appear-animation="fadeInUpShorter"
                 data-appear-animation-delay="400">
                <h2 class="font-weight-normal text-6 mt-3 mb-5 common-text">Latest <strong
                            class="font-weight-extra-bold">Blog</strong></h2>
            </div>
        </div>
        <div class="row recent-posts pb-4 mb-5 appear-animation" data-appear-animation="fadeInRightShorter"
             data-appear-animation-delay="200">
             @if(isset($blogList))
             @foreach($blogList as $blog)
                 <?php
                                        
                 ?>
                @if($blog->vedio_url ==null || $blog->vedio_url =='')
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <article class="blog-post">
                        <div class="row">
                            <div class="col-auto blog-img">
                                <img class="img-responsive" src='{{asset("$blog->photo")}}' style="width: 100%;height:150px">
                            </div>
                            <div class="col-auto pr-0">
                                <div class="date">
                                    <span class="day text-color-dark font-weight-extra-bold">{{date('d',strtotime($blog->date))}}</span>

                                    <span class="month bg-color-primary font-weight-semibold text-color-light text-1">{{date('M ',strtotime($blog->date))}}</span>
                                </div>
                            </div>
                            <div class="col pl-1">
                                <h4 class="line-height-3 text-4"><a href="#" class="text-dark">{{$blog->blog_title}}</a></h4>
                                <p class="line-height-5 pr-3 mb-1 common-fornt">{{strip_tags(substr($blog->blog_details,0,150))}}</p>
                                <a class="btn btn-light text-uppercase text-primary text-1 py-2 px-3 mb-1 mt-2"
                                   href="#"><strong>VIEW MORE</strong><i
                                            class="fas fa-chevron-right text-2 pl-2"></i></a>
                            </div>
                        </div>
                    </article>
                </div>
                @else
                <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
                    <article class="blog-post">
                        <div class="row">
                            <div class="col-auto blog-img">
                                <iframe style="height: 150px;width: 350px" src="{{$blog->vedio_url}}">
                                </iframe>
                            </div>
                            <div class="col-auto pr-0">
                                <div class="date">
                                    <span class="day text-color-dark font-weight-extra-bold">{{date('d',strtotime($blog->date))}}</span>
                                    <span class="month bg-color-primary font-weight-semibold text-color-light text-1">{{date('M ',strtotime($blog->date))}}</span>
                                </div>
                            </div>
                             <div class="col pl-1">
                                <h4 class="line-height-3 text-4"><a href="#" class="text-dark">{{$blog->blog_title}}</a></h4>
                                <p class="line-height-5 pr-3 mb-1">{{strip_tags(substr($blog->blog_details,0,150))}}</p>
                                <a class="btn btn-light text-uppercase text-primary text-1 py-2 px-3 mb-1 mt-2"
                                   href="#"><strong>VIEW MORE</strong><i
                                            class="fas fa-chevron-right text-2 pl-2"></i></a>
                            </div>
                        </div>
                    </article>
                </div>
                @endif
            @endforeach
            @endif
            
        </div>
    </div>
<!-- End blog start -->
@endsection
@section('scripts')
<script type="text/javascript">
   $("#position").select2({
        allowClear:true,
        placeholder: 'Test'
      });    
</script>
@endsection
