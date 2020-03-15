@extends('webmodule.layouts.web-layouts')
@section('content')
<style type="text/css">
  .singleViewDetails{
    font-size: 18px;
    font-weight: 400;
   font-family:'Arimo', sans-serif;
  }
</style>
    <div role="main" class="main">
          <section class="page-header page-header-modern bg-color-dark page-header-md">
                  <div class="container">
                       <div class="row">
                            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                                <h1 class="">Package Details<strong></strong></h1>
                            </div>
                            <div class="col-md-4 order-1 order-md-2 align-self-center">
                                <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li class="active">Package Details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container">
                   <div class="text-center"><img src="{{ asset("$packageDetail->photo") }}" style="height: 100px; width: 100px;">
                   </div>

                    <div class="text-center" style="margin-top: 25px;">
                      <h3>Total:{{ $packageDetail->price }}TK</h3>
                   </div>

                   <div class="text-center" style="margin-top: 25px;">
                   	  <h3>{{ $packageDetail->name }}</h3>
                   </div>

                   <div class="text-center singleViewDetails">
                    {!! str_replace('.','<br>',$packageDetail->description) !!}
                   	     <!-- {!! wordwrap($packageDetail->description, 15,"<br>\n") !!} -->
                   </div>

                   <form action="{{ url('add-to-cart') }}" method="post">
                     @csrf
                     <input type="hidden" name="qty" value="1"/>
                     <input type="hidden" name="package_id" value={{$packageDetail->id}} />

                     <button type="submit" class="text-center btn btn-fefault cart btn btn-danger booking" style="margin-top: 10px; margin-bottom: 10px; margin-left: 492px;">
                        <i class="fa fa-shopping-cart"></i>
                          Add to cart
                     </button>

                      <!-- <div  class="text-center" style="margin-top: 10px; margin-bottom: 10px;">
                          <a class="btn btn-danger booking" type="submit">ADD TO CARD</a>
                     </div> -->  

                   </form>
                </div>   
            </div>
@endsection
@section('scripts')
<script src="{{asset('public/js/carousel-slider.js')}}"></script>
@endsection
