@extends('webmodule.layouts.web-layouts')
@section('content')
    <div role="main" class="main">
                <section class="page-header page-header-modern bg-color-dark page-header-md">
                    <div class="container">
                        <div class="row">


                            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                                <h1 class="">Contact Us <strong></strong></h1>

                            </div>


                            <div class="col-md-4 order-1 order-md-2 align-self-center">
                                <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li class="active">Contact Us</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container py-4">
                    <div class="row mb-5">
                        <div class="col">
                            <form id="contactForm" class="contact-form-recaptcha-v3" action="" method="POST">
                                <div class="contact-form-success alert alert-success d-none mt-4" id="contactSuccess">
                                    <strong>Success!</strong> Your message has been sent to us.
                                </div>
                            
                                <div class="contact-form-error alert alert-danger d-none mt-4" id="contactError">
                                    <strong>Error!</strong> There was an error sending your message.
                                    <span class="mail-error-message text-1 d-block" id="mailErrorMessage"></span>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label class="required font-weight-bold text-dark text-2">Full Name</label>
                                        <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="required font-weight-bold text-dark text-2">Email Address</label>
                                        <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="font-weight-bold text-dark text-2">Subject</label>
                                        <input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="required font-weight-bold text-dark text-2">Message</label>
                                        <textarea maxlength="5000" data-msg-required="Please enter your message." rows="5" class="form-control" name="message" id="message" required></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <input type="submit" value="Send Message" class="btn btn-primary btn-modern" data-loading-text="Loading...">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                   

                </div>

                <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
                <div id="googlemaps" class="google-map m-0 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="300" style="height:450px;"></div>

            </div>
@endsection
