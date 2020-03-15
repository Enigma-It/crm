@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
<?php use App\Library\memberShipLib;?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 style="font-family: 'Libre Baskerville', serif;font-size: 2.5em;color: #e22020;font-weight: bold"> {{$franchiseOrg->org_name}} </h1>
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
              <td><strong>Franchise Name</strong> &nbsp;</td><td>: &nbsp;</td>
              <td><strong id="company_name"> {{ucwords($franchiseInfo->name)}}</strong></td>

            </tr>
            <tr>
              <td style="font-weight: bold">Organization Name &nbsp;</td><td>: &nbsp;</td>
              <td id="company_number"> {{$franchiseOrg->org_name}}</td>
            </tr>
            <tr>
              <td style="font-weight: bold">Email &nbsp;</td><td>: &nbsp;</td>
              <td id="company_mail"> {{$franchiseInfo->email}} </td>
            </tr>
            <tr>
              <td style="font-weight: bold">Address &nbsp;</td><td>: &nbsp;</td>
              <td id="company_address"> {{$franchiseInfo->address}} </td>
            </tr>
          </table>
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Total Sale</span> <span class="info-box-number">{{memberShipLib::getNumberFormat($total_sale)}}</span> </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="fa fa-credit-card"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Account Balance</span> <span class="info-box-number">
          @if(isset($total_amount))
            {{memberShipLib::getNumberFormat($total_amount->total_wallet)}}
          @else
            {{memberShipLib::getNumberFormat(0.00)}}
          @endif

        </span> 
      </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
   
   </div>
   <div class="row" style="margin-top: 20px;">
   		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >
          <!-- small box -->
          <div class="wallet-history">
          	<h4>Wallet History:</h4>
	          <div class="table-responsive">
	          	<table class="table table-bordered table-stripped">
	          		<th>Date</th>
	          		<th>Purpose</th>
                <th>Status</th>
	          		<th>Amount</th>
	          		<tbody>
	          			@if(isset($wallet_history))
		          			@foreach($wallet_history as $wallet)
		          			<tr>
		          				<td>{{date('d/m/Y',strtotime($wallet->date))}}</td>
		          				<td>{{$wallet->deposit_purpose}}</td>
                      <td>
                        @if($wallet->status ==1)
                        <strong>Deposit</strong>
                        @else
                        <strong>Reduction</strong>
                        @endif
                      </td>
		          				<td>{{memberShipLib::getNumberFormat($wallet->deposit_amount)}}</td>
		          			</tr>
		          			@endforeach
	          			@endif
	          		</tbody>
	          	</table>
	          </div>
          </div>
          
     </div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >
          <!-- small box -->
          <div class="wallet-history">
          	<h4>Latest Order:</h4>
	          <div class="table-responsive">
	          	<table class="table table-bordered table-stripped">
	          		<th>Date</th>
	          		<th>Patient ID</th>
	          		<th>Total Amount</th>
	          		<th style="background: green">Paid Amount</th>
	          		<th style="background: red">Due Amount</th>
	          		<tbody>
	          			@if(isset($latest_sample_order))
		          			@foreach($latest_sample_order as $order)
		          			<tr>
		          				<td>{{date('d/m/Y',strtotime($order->date))}}</td>
		          				<td><strong>{{$order->patient_id}}</strong></td>
		          				<td>{{memberShipLib::getNumberFormat($order->total_amount)}}</td>
		          				<td>{{memberShipLib::getNumberFormat($order->receive_amount)}}</td>
		          				<td>{{memberShipLib::getNumberFormat($order->due_amount)}}</td>
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