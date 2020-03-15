@extends('webmodule.layouts.web-layouts')
@section('content')
<div role="main" class="main">
    <section class="page-header page-header-modern bg-color-dark page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 class=" common-fornt">Shopping Cart<strong></strong></h1>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                       <li><a href="{{url('/')}}">Home</a></li>
                       <li class="active">Shopping Cart</li>
                    </ul>
                 </div>
            </div>
         </div>
    </section>
<div class="container py-4">
    <div class="row mb-5">
    	<div class="col-lg-8 card_view">
	       <div class="table cart_info">
				<?php
					$contents=Cart::getContent();
					$jsonContent = json_decode($contents);
				?>
			@if(isset($jsonContent) && !empty($jsonContent))
		    <table class="table table-condensed">
			    <thead>
					<tr class="cart_menu">
						<td class="description common-fornt">Name</td>
						<td class="price common-fornt">Price</td>
						<td class="quantity common-fornt">Quantity</td>
						<td class="total common-fornt">Total</td>
						<td class="common-fornt">Action</td>
					</tr>
			     </thead>
			     <tbody>
				 @foreach($contents as $v_content)
					<tr>
						<td class="cart_description common-fornt">
							<h4 class="common-fornt"><a href="">{{$v_content->name}}</a></h4>
						</td>
						<td class="cart_price common-fornt">
							<p class="common-fornt">{{$v_content->price}}</p>
						</td>

<!-- 						<td class="cart_quantity common-fornt">
							<div class="cart_quantity_button">
								<a class="increment" href='{{ url("increase-cart/$v_content->id/1")}}'> <i class="fa fa-plus-o"></i> </a>
								<input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->quantity}}" autocomplete="off" size="2" style="text-align: center;">
								<a class="decrease" href='{{ url("decrease-cart/$v_content->id/1")}}'> - </a>
							</div>
						</td> -->

						    <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                     <a class="decrease" href='{{ url("show-decrease-cart/$v_content->id/1")}}'><i class="fa fa-minus-circle"></i> </a>
                                      <input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->quantity}}" autocomplete="off" size="2" style="text-align: center;">
                                     <a class="increment" href='{{ url("show-increase-cart/$v_content->id/1")}}'> <i class="fa fa-plus-circle"></i> </a>
                                  </div>
                            </td>

						<td class="cart_total common-fornt">
							<p class="cart_total_price common-fornt">{{$v_content->quantity * $v_content->price}}</p>
						</td>
						<td class="cart_delete common-fornt">
							<a class="cart_quantity_delete" 
							href="{{ url('delete-cart',$v_content->id)}}">
							<i class="fa fa-times"></i></a>
						</td>
					</tr>
		     	@endforeach	
		      </tbody>
	       </table>
	       @else
	       	<h1 style="color: #FF0000;text-align: center;">No Item Found In Your Cart</h1>
	       @endif
        </div>
      </div>

      <div class="col-lg-4">
         <div class="price_card text-center">     
            <div class="pricing-footer">
            	<p style="font-size: 19px;" class="common-fornt"> Quantity: {{count(Cart::getContent())}}</p>
                <p style="font-size: 19px;" class="common-fornt"> Sub Total: {{ Cart::getSubTotal() }}</p>
            	<p style="font-size: 19px;" class="common-fornt"> vat:0%</p>
            	<hr>
               <b>
               	 <h2 >Total:</h2>
               	 <h1 >{{ Cart::getTotal() }}TK.</h1>
               	</b>
                <?php
                   $userData = Session::get('user_data');
                 ?>
	                <div>  
	                   <a href="{{!empty(Auth::User()->id) ? url('order-page') : url('login-form') }} " class="btn btn btn-danger waves-effect waves-ligh add-confirm-button" style="margin-bottom: 5px;">Process to Checkout</a>
	                </div>
               	</div>
            </div>
         </div>
    </div>
</div>
@endsection