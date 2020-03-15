@extends('webmodule.layouts.web-layouts')
@section('content')
<div role="main" class="main">
    <section class="page-header page-header-modern bg-color-dark page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 class="">Book Doctor Appointment<strong></strong></h1>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                       <li><a href="{{url('/')}}">Home</a></li>
                       <li class="active">Doctor Details</li>
                    </ul>
                </div>
            </div>
         </div>
    </section>

    <section class="service-postsec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="health-post-wapper">
                        <div class="main-content">
                            <div class="panel panel-default user-panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Doctor Profile</h3>
                                    <h3 class="panel-title edit-profile-url">
                                        
                                    </h3>
                                </div>

                                

                                <div class="panel-body">
                                    <div class="profile-detiels">
                                       
                                        <div class="attrebut">
                                            <div class="property">
                                                <h6>Name</h6>
                                            </div>
                                            <div class="value5">
                                                <p>{{ $doctorData->name }}</p>
                                            </div>
                                        </div>
                                        <div class="attrebut">
                                            <div class="property">
                                                <h6>Email</h6>
                                            </div>
                                            <div class="value5">
                                                <p>{{ $doctorData->Email }}</p>
                                            </div>
                                        </div>
                                        <div class="attrebut">
                                            <div class="property">
                                                <h6>Your Phone</h6>
                                            </div>
                                            <div class="value5">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="attrebut">
                                            <div class="property">
                                                <h6>Your Address</h6>
                                            </div>
                                            <div class="value5">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
<!--customer add modal-->
@endsection