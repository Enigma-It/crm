@extends('webmodule.layouts.web-layouts')
@section('content')
    <div role="main" class="main">
            <section class="page-header page-header-modern bg-color-dark page-header-md">
                 <div class="container">
                        <div class="row">
                            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                                <h1 class="">TEST DETAILS <strong></strong></h1>
                            </div>
                            <div class="col-md-4 order-1 order-md-2 align-self-center">
                                <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li class="active">Test Details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="container py-4">
                    <div class="testmain_div">
                        <div class="testdetail_maindiv">
                             <div class="test_title">TEST DEPARTMENT : </div>
                             <div class="test_name">{{ $findTestData->name}}</div>
                        </div>

                        <div class="testdetail_maindiv">
                           <div class="test_title">TEST ID  : </div>
                           <div class="test_details_other">CARD0001</div>
                        </div>

                        <div class="testdetail_maindiv">
                           <div class="test_title">Department  : </div>
                           <div class="test_details_other">{{ $findTestData->dept_name }}.</div>
                        </div>


                         <div class="testdetail_maindiv">
                           <div class="test_title">Specimen  : </div>
                           <div class="test_details_other">{{ $findTestData->specimen }}.</div>
                        </div> 

                        <div class="testdetail_maindiv">
                           <div class="test_title">Price  : </div>
                           <div class="test_details_other">{{ $findTestData->total_price }}.</div>
                        </div>
                        <a class="various3" data-fancybox-type="iframe" href="#" style="text-decoration:none;"><button class="button" style="float:right;"><span>Enroll Test</span></button></a>
                        </div>
                </div>
         </div>             
@endsection
