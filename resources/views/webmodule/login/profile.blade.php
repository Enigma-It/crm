@extends('webmodule.layouts.web-layouts')
@section('content')
 
<!-- Content Wrapper. Contains page content -->

    <section class="service-postsec">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="health-post-wapper">
                        <div class="main-content">
                            <div class="panel panel-default user-panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Your Profile</h3>
                                    <h3 class="panel-title edit-profile-url">
                                        
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="profile-detiels">
                                       
                                        <div class="attrebut">
                                            <div class="property">
                                                <h6>Your Name</h6>
                                            </div>
                                            <div class="value5">
                                                <p>{{Auth::User()->name}}</p>
                                            </div>
                                        </div>
                                        <div class="attrebut">
                                            <div class="property">
                                                <h6>Your Email</h6>
                                            </div>
                                            <div class="value5">
                                                <p>{{Auth::User()->email}}</p>
                                            </div>
                                        </div>
                                        <div class="attrebut">
                                            <div class="property">
                                                <h6>Your Phone</h6>
                                            </div>
                                            <div class="value5">
                                                <p>{{Auth::User()->phone_number}}</p>
                                            </div>
                                        </div>
                                        <div class="attrebut">
                                            <div class="property">
                                                <h6>Your Address</h6>
                                            </div>
                                            <div class="value5">
                                                <p>{{Auth::User()->present_address}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <aside class="right-sidebar">
                        <div class="single-widget services-list sub-menu">
                            <h4>User Profile</h4>
                            <ul style="padding-left: 0px;">
                                <li><a href="{{url('patient-profile')}}">Your Profile</a></li>
                                <li><a href="{{ url('update-profile/'.Auth::User()->id) }}">Change Password</a></li>
                                <li><a href="{{url('patient-order')}}">Order History</a></li>
                                <li><a href="{{url('patient-logout')}}">Log
                                        Out</a></li>
                                <form id="logout-form" action="#" method="POST"
                                      style="display: none;">
                                    <input type="hidden" name="_token" value="j2yytbF6JrZxQv7e1wyGyhoX5hRvl9BT6SjLx0EE">
                                </form>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>



@endsection
@section('scripts')
<script src="{{asset('public/js/carousel-slider.js')}}"></script>
@endsection
