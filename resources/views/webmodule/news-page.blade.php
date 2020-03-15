@extends('webmodule.layouts.web-layouts')
@section('content')

    <style>
        .news-img{
            padding-bottom: 15px;
        }
        p {
         color: #191818!important;
         line-height: 26px!important;
        margin: 0 0 20px;
        font-size: 16px!important;
        font-weight: 300px!important;
    }
        
    </style>


    <div role="main" class="main">
        <section class="page-header page-header-modern bg-color-dark page-header-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                         <h1 class="">News page <strong></strong></h1>
                     </div>
                     <div class="col-md-4 order-1 order-md-2 align-self-center">
                          <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                              <li><a href="{{url('/')}}">Home</a></li>
                              <li class="active">News</li>
                           </ul>
                         </div>
                      </div>
                    </div>
                </section>
               
                <div class="container">
                      <div class="row">
                        @foreach($news as $data)  
                          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                             <div class="news-img">
                               <img src="{{ $data->photo }}" style="height: 220px; width: 500px;">
                             </div>   
                          </div> 

                          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                            <p>{!! $data->description  !!}</p>
                          </div> 
                         @endforeach
                      </div>  
                </div>
            
            </div>
@endsection
