@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
<?php use App\Library\memberShipLib;?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 style="font-family: 'Libre Baskerville', serif;font-size: 2.5em;color: #e22020;font-weight: bold"> {{$deliveryInfo->name}} </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<!-- Main content -->
<style type="text/css">
	.wallet-history{
		padding: 10px;
		background: #fff;

	}
</style>
<section class="content">
  @include('common.message')
  
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <!-- small box -->
       <table id="dynamicTable" style="margin-top: 20px; margin-left: 15px; font-size: 16px; line-height: 2;">
            <tr style="font-size: 26px;">
              <td><strong>Delivery Man Name</strong> &nbsp;</td><td>: &nbsp;</td>
              <td><strong id="company_name"> {{ucwords($deliveryInfo->name)}}</strong></td>

            </tr>
            
            <tr>
              <td style="font-weight: bold">Email &nbsp;</td><td>: &nbsp;</td>
              <td id="company_mail"> {{$deliveryInfo->email}} </td>
            </tr>
            <tr>
              <td style="font-weight: bold">Address &nbsp;</td><td>: &nbsp;</td>
              <td id="company_address"> {{$deliveryInfo->present_address}} </td>
            </tr>
          </table>
    </div>
    
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-hospital-o"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Total Collected Sample</span> <span class="info-box-number">{{$sample_info}}</span> </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  
   </div>
   <div class="row" style="margin-top: 20px;">
   		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <!-- small box -->
          <div class="wallet-history">
          	<h4>Sample Collection History:</h4>
	          <div class="table-responsive">
	          	<table class="table table-bordered table-stripped">
	          		<th>S/L</th>
	          		<th>Date</th>
	          		<th>Franchise Name</th>
                    <th>Status</th>
	          		<th>Sample QTY</th>
	          		<?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
	          		<tbody>
	          		@if(isset($delivery_data))
		          	 @foreach($delivery_data as $data)
		          	   <tr>
		          	   	 <td><label class="label label-success">{{$currentNumber++}}</label></td>
		          		 <td>{{date('d/m/Y',strtotime($data->created_at))}}</td>
		          		 <td>{{$data->name}}</td>
	                      <td>
	                        @if($data->sample_status ==1)
	                        <strong>Collected</strong>
	                        @elseif($data->sample_status ==2)
	                        <strong>In Transit</strong>
	                        @else
	                        <strong>Cancle</strong>
	                        @endif
	                      </td>
		          	     <td>{{$data->sample_qty}}</td>
		          	</tr>
		          	  @endforeach
	          		@endif
	          		</tbody>
	          	</table>
	          </div>
          </div>   
     </div>
   </div>
  </div>
</section>
@endsection 