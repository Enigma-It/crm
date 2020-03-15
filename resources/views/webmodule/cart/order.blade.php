@extends('webmodule.layouts.web-layouts')
@section('content') 
<section class="service-postsec">
    <div class="container">
       <div class="row">
          <div class="col-lg-4">
             <div class="col-lg-12 tests-marz-top">
                <div class="checkout-user-info checkout-index">
                     <h3 class="c-head alignleft">User Information</h3>
                 </div>
                  <div class="c-box">
                    <div class="form-group">
                        <label class="common-fornt">Name:</label><span class="common-fornt">{{ Auth::User()->name }}</span>
                    </div>
                    <div class="form-group">
                        <label class="common-fornt">Email:</label><span class="common-fornt">{{ Auth::User()->email }}</span>
                    </div>
                    <div class="form-group">
                        <label class="common-fornt">Phone:</label>
                        <span class="common-fornt">{{ Auth::User()->phone_number }}</span>
                    </div>
                    <div class="form-group">
                        <label class="common-fornt">Address:</label>
                        <span class="common-fornt">{{ Auth::User()->present_address }}</span>
                    </div>
                <!--     <div class="checkout_margin">
                        <input type="checkbox" id="shipping_address" class="shipping_address" style="display: none">
                        <span class="color">Sample collection from different location<i style="font-size: 10px;"> (Opt.)</i> </span>
                    </div> -->
                  </div>
               </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                       <div class="col-md-12">
                           <div class="main-content">
                               <div class="product-table-warp checkout-index">
                                   <h3 class="c-head alignleft">Order Review</h3>
                                </div>
                             <div class="c-box">
                                <div class="table-responsive cart_info">  
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
                                            <td class="cart_description">
                                                <h4 class="common-fornt"><a href="">{{$v_content->name}}</a></h4>
                                            </td>
                                            <td class="cart_price">
                                                <p class="common-fornt">{{$v_content->price}}</p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    <a class="decrease" href='{{ url("decrease-cart/$v_content->id/1")}}'><i class="fa fa-minus-circle"></i> </a>
                                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->quantity}}" autocomplete="off" size="2" style="text-align: center;">
                                                    <a class="increment" href='{{ url("increase-cart/$v_content->id/1")}}'> <i class="fa fa-plus-circle"></i> </a>
                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price common-fornt">{{$v_content->quantity * $v_content->price}}</p>
                                            </td>
                                            <td class="cart_delete">
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
                    <div class="col-md-4 add-more-test" style="float: right;">
                        <a href="{{URL::to('service-details/1')}}" class="btn btn-default add-more-button">Add More Test</a>
                    </div>
                  </div>
                </div>
             </div>
           </div>
        </div>
      <div class="row">
         <div class="col-md-6">
            <form action="{{ route('order.store') }}" method="POST" enctype="form-data">
            @csrf
             <div class="row  tests-marz-top">
              <div class="col-lg-12">
                <div class="checkout-index">
                    <h3 class="c-head common-fornt">Collection Process</h3>
                </div>

                <div class="c-box">
                 <div class="home-service-parent"
                    id="home-service-parent"data-cart-add-home-service="#"
                      data-cart-remove-home-service="#">
                        <p class="common-fornt"> Select Method</p>
                        <div class="checkout_shipping">
                            <div  class="radio">
                               <label class="common-fornt"><input id="auth_address"  type="radio" name="is_home_collection" value="0" require>Patiend Address</label>
                            </div> 
                            <div  class="radio">
                               <label class="common-fornt"><input id="custom_address" type="radio" name="is_home_collection" value="1">Home Collection Address</label>
                            </div> 
                         </div>
                       </div>
                   </div>
                </div>
              </div>
           </div>

        <!--    <div class="col-md-4"></div> -->
          <div class="col-md-6">
              <div class="col-md-12">
                   <div class="payment-option-wrapper">
                            <div class="how_to_pay checkout-index">
                                <h3 class="common-fornt">Payment Method</h3>
                            </div>
                          <div class="ssl" id="ssl_div" style=""> 
                              <div class="panel" id="view_ssl">
                                 <div id="test-payment" class="margin flex_center">
                                    <div class="col-md-6">
                                        <!-- <input id="rad_cod" type="radio"
                                          style="margin-right: 20px;">Pay On Card -->
                                          <div  class="radio">
                                            <label class="common-fornt"><input id="cash" type="radio" name="pay_type_value" value="0" required>CASH</label>
                                          </div>
                                          <div  class="radio">
                                            <label class="common-fornt"><input id="bank" type="radio" name="pay_type_value" value="1">BANK</label>
                                          </div>
                                    </div>
                                 </div>
                               </div>
                           </div>
                        </div>
                    </div>
               </div> 
           </div>

        <div class="row home-coll">
           <div class="col-md-12">
              <div id="shipping_address_des" style="display:none;">
                   <div class="checkout-user-info checkout-index">
                      <h3 class="c-head common-fornt">Home Collection Information</h3>
                    </div>
                    <div class="c-box">
                      <div class="form-group">
                         <label class="common-fornt">Name</label>
                         <input name="p_name" class="form-control" type="text" value="">
                      </div>
                      <div class="form-group">
                          <label class="common-fornt">Phone</label>
                          <input name="p_phone" class="form-control" type="text" value="">
                       </div>
                       
                       <div class="form-group">
                           <label class="common-fornt">Address</label>
                          <textarea name="p_address" class="form-control"></textarea>
                       </div>

                      <div class="form-group ">
                        <label class="common-fornt">Date</label>
                         <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                              </div>
                          </div>
                        </div>
                     </div>

                    <div class="form-group">
                      <label class="common-fornt">Appointment In Time</label>
                      <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3"/>
                        <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                          <div class="input-group-text">
                            <i class="fa fa-clock-o"></i>
                          </div>
                         </div>
                        </div>
                     </div>

                    <div class="form-group">
                      <label class="common-fornt">Appointment Out Time</label>
                       <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3"/>
                          <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
         </div>
       </div>  
    <div class="col-md-12 footer-payment-logos" id="bank_icon" style="margin-top: 15px;">
       <span><img src="https://www.thyrocarebd.com/public/assets/images/paywith_web.png" alt="SSL Commerzzz" style="margin-left: 150px;"></span>
    </div> 
      <div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-xs-12 col-lg-12 col-md-12 col-sm-12" align="center">
              <input type="submit" value="ORDER" class="btn btn-default register-btn btn-lg" style="margin-top: 25px;background-color: #ec2328;color: #ffffff;">
             </div>
         </div>   
      </di+v>
     </form>
      </div>
    </div>
</section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#custom_address').on('change', function() {
          if(this.value == 1) {
            $('#shipping_address_des').show();
           }else {
             $('#shipping_address_des').hide();
          }
        });
        $('#auth_address').on('change', function(){
          if(this.value == 0) {
            $('#shipping_address_des').hide();
          }else {
            $('#shipping_address_des').show();
          }
        });
        $(function () {
                $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
            });
         $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
    </script>
@endsection
