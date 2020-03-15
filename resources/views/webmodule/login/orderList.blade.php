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
                                    <h3 class="panel-title common-fornt common-fornt">Orders List</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="profile-detiels">
                                    	<div class="table-responsive cart_info">
							    <table class="table table-condensed">
								    <thead>
										<tr class="cart_menu">
											<td class="image common-fornt">Order ID</td>
											<td class="description common-fornt">Date</td>
											<td class="price common-fornt">Order Status</td>
											<td class="quantity common-fornt">Report</td>
											<td class="total common-fornt">Action</td>
											<!-- <td>Action</td> -->
										</tr>
								     </thead>
								     <tbody>
									 @foreach($orderDetailsData as $v_content)
										<tr>
											<td class="cart_product">
												<p class="common-fornt">{{$v_content->order_id}}</p>
											</td>
											<td class="cart_description">
												<p class="common-fornt">{{$v_content->order_date}}</p>
											</td>
												
											<td>
			                                    @if($v_content->order_status == 1)
			                                        <label class="control-label label-warning" style="padding: 0px 15px; border-radius: 3px;">Processing</label>
			                                    @elseif($v_content->order_status == 2)
			                                        <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">Approved</label>
			                                    @else
			                                        <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">Cancelled</label>
			                                    @endif
			                                </td>


											<td class="cart_product">
												<p class="common-fornt">Not Aviable</p>
											</td>


											 <td>
                                               <a class="btn btn-app common-fornt"
                                                href="{{ URL::to('orderReport-details/'.$v_content->order_id) }}"><i class="fa fa-edit"></i>
                                                  Details
                                               </a>
                                             </td>

											
							
										
											<!-- <td class="cart_delete">
												<a class="cart_quantity_delete" 
												href="#}">
												<i class="fa fa-times"></i></a>
											</td> -->
										</tr>
							     	@endforeach	

							      </tbody>
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
                                <li><a href="{{ url('update-profile/'.Auth::User()->id) }}" class="common-fornt">Change Password</a></li>
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




      
