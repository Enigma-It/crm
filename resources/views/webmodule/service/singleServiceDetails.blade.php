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
                                <h1 class="">Service Details<strong></strong></h1>
                            </div>
                            <div class="col-md-4 order-1 order-md-2 align-self-center">
                                <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li class="active">Service Details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container">
                  <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 home-collection">
                         <div class="text-center" style="margin-top: 10px; margin-bottom: 10px;"><img 
                          src="{{ asset("$serviceDetail->photo") }}" style="height: 100px; width: 100px;">
                         </div>
                         <div class="text-center" style="margin-top: 25px;">
                            <h3>{{ $serviceDetail->name }}</h3>
                         </div>
                        <div class="singleViewDetails">
                             <p>{{ $serviceDetail->description }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 test-collection">


                      <table id="example" class="table table-striped table-bordered" style="width:100%;margin-bottom: 10px; margin-top: 10px; ">
                            <thead>
                                <tr>
                                    <th>Test Name</th>
                                    <th>Test Departmet</th>
                                    <th>Test Price</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                          @foreach($testDetails as $testDetail)
                                <tr>
                                    <td>{{ $testDetail->test_name }}</td>
                                    <td>{{ substr($testDetail->specimen,0,50) }}</td>
                                    <td>{{ $testDetail->total_price }}</td>
                               <form action="{{ url('add-to-cart') }}" method="post">
                                   @csrf
                                   <input type="hidden" name="quantity" value="1"/>
                                    <input type="hidden" name="test_id" value={{$testDetail->id}} />
                                    <td><button class="cart-buuton" type="submit"><i class="fa fa-shopping-cart shopping_cart_icon" aria-hidden="true"></i></button></td>
                               </form> 
                                </tr>
                           @endforeach     

                            </tbody>
                    </table>
                    </div>
                  </div>
              <!--     <div  class="text-center">
                     	<a class="btn btn-danger booking" href="{{url('add-to-cart')}}" style=" margin-bottom: 10px;">ADD TO CARD</a>
                  </div> -->
                </div>   
            </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection
