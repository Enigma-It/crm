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
                                    <h3 class="panel-title common-fornt">Orders List</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="profile-detiels">
                                        <div class="table-responsive cart_info">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="cart_menu">
                                            <td class="image common-fornt">Test/Package Name</td>
                                            <td class="total common-fornt" style="text-align: right">price</td>
                                            <!-- <td>Action</td> -->
                                        </tr>
                                     </thead>
                                     <tbody> 
                         @foreach($items as $item)  
                            <?php
                              if($item->item_type == "package"){
                               $orderListData =  DB::table('packages')->where('packages.id',$item->item_id)->first();
                                  }
                               if($item->item_type == "test"){
                                  $orderListData =  DB::table('pathology_test')->where('pathology_test.id',$item->item_id)->first();
                                }
                                ?> 
                                <tr>
                                  <td class="common-fornt">{{  $orderListData->test_name }}</td>
                                   <td style="text-align: right" class="common-fornt">{{  $orderListData->total_price }}</td>
                                </tr>
                             @endforeach            
                                      </tbody>
                                      <tfoot style="text-align: right">
                           <tr>
                             <td colspan="1" class="common-fornt">Report Delivery</td>
                             <td>300</td>
                           </tr>
                           <tr>
                             <td colspan="1" class="common-fornt"><b>Total</b></td>
                              <td class="common-fornt">{{  $orderDetails->total + 300}} </td>
                            </tr>
                            <tr>
                              <td colspan="1" class="common-fornt"><b>Paid Amount</b></td>
                              <td>00</td>
                            </tr>
                              <tr>
                                <td colspan="1" class="common-fornt"><b>Payable Total Amount</b></td>
                                  <td class="common-fornt">{{  $orderDetails->total + 300}}</td>
                              </tr>
                          </tfoot>
                                    </table>
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
                            <h4 class="common-fornt">User Profile</h4>
                            <ul style="padding-left: 0px;">
                                <li><a href="{{url('patient-profile')}}" class="common-fornt">Your Profile</a></li>
                                <?php $userId = Auth::User()->id ?>
                                <li><a href='{{ url("update-profile/$userId") }}' class="common-fornt">Change Password</a></li>
                                <li><a href="{{url('patient-order')}}" class="common-fornt">Order History</a></li>
                                <li><a href="{{url('patient-logout')}}" class="common-fornt">Log
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

</section>
@endsection
@section('scripts')
<script src="{{asset('public/js/carousel-slider.js')}}"></script>
@endsection




      
