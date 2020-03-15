@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
<?php use App\Library\memberShipLib;?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 style="font-family: 'Libre Baskerville', serif;font-size: 2.5em;color: #e22020;font-weight: bold"> {{$curierInfo->name}} </h1>
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
              <td><strong>Courier Name</strong> &nbsp;</td><td>: &nbsp;</td>
              <td><strong id="company_name"> {{ucwords($curierInfo->name)}}</strong></td>

            </tr>
            
            <tr>
              <td style="font-weight: bold">Email &nbsp;</td><td>: &nbsp;</td>
              <td id="company_mail"> {{$curierInfo->email}} </td>
            </tr>
            <tr>
              <td style="font-weight: bold">Branch &nbsp;</td><td>: &nbsp;</td>
              <td id="company_address"> {{$curierInfo->branch_name}} </td>
            </tr>
            <tr>
              <td style="font-weight: bold">Phone &nbsp;</td><td>: &nbsp;</td>
              <td id="company_address"> {{$curierInfo->phone}} </td>
            </tr>
          </table>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-hospital-o"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Total Courier</span> <span class="info-box-number">{{$total_courier}}</span> </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-hospital-o"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Total Collected Box </span> <span class="info-box-number">{{$totalCourierQty}}</span> </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  
   </div>


   <div class="row" style="margin-top: 20px;">

   		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <!-- small box -->
          <div class="wallet-history">
          	<h4>Courier Sample Collection Information:</h4>
	          <div class="table-responsive">
	          	<table class="table table-bordered table-stripped">
	          		<th>Courier Name</th>
	          		<th>Collected Date</th>
                    <th>Box QTY</th>
                    <th>Bus Number</th>
                    <th>Supervisor Name</th>
	          		<th>Phone</th>
	          		<tbody>
	          		@if(isset($courierSampleCollection))
		          	   @foreach($courierSampleCollection as $data)
		          	   <tr>
		          	   	 <td>{{$data->name}}</td>
		          	     <td>{{date('d/m/Y',strtotime($data->collected_date))}}</td>
		          		
	                      <td>{{$data->box_qty}}</td>
		          	     <td>{{$data->bus_number}}</td>
		          	     <td>{{$data->supervisor_name}}</td>
		          	     <td>{{$data->supervisor_contact_number}}</td>
		          	  </tr>
		          	 @endforeach
	          		@endif
	          		</tbody>
	          	</table>
	          </div>
          </div>   
     </div>


     <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
       
          <div class="wallet-history">
          	<h4>Courier Details:</h4>
	          <div class="table-responsive">
	          	<table class="table table-bordered table-stripped">
	          		<th>S/L</th>
	          		<th>Courier Type</th>
	          		<th>Courier Name</th>
                    <th>Branch</th>
	          		<th>Phone</th>
	          		<?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
	          		<tbody>
	          		@if(isset($courierData))
		          	 @foreach($courierData as $courier)
		          	   <tr>
		          	   	 <td><label class="label label-success">{{$currentNumber++}}</label></td>
		          		 <td>
		          		 	 @if($courier->courier_type == 1)
		          		 	 <strong>BUS</strong>
		          		 	 @else
		          		 	 <strong>COURIER</strong>
		          		 	 @endif
		          		 </td>
		          		 <td>{{$courier->name}}</td>
	                     <td>{{$courier->branch_name}}</td>
		          	     <td>{{$courier->phone}}</td>
		          	</tr>
		          	  @endforeach
	          		@endif
	          		</tbody>
	          	</table>
	          </div>
          </div>   
     </div> -->


   </div>
  </div>
</section>
@endsection 