@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
<?php use App\Library\memberShipLib;?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Uddipan Health Care Dashboard<small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  @include('common.message')
  <div class="row">
 
  </div>
  <br>

  <div class="row">

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
        <div class="info-box-content"> <span class="info-box-text"></span>TOTAL FRANCHISE<span class="info-box-number">{{$total_franchise}}</span> </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-green"><i class="fa fa-stethoscope"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Total Diagnostic Patient</span> <span class="info-box-number">17</span></div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Total Staff</span> <span class="info-box-number">{{$total_staff}}</span> </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="fa fa-user-md"></i></span>
        <div class="info-box-content"> <span class="info-box-text"> Total Doctor</span> <span class="info-box-number">{{$total_doctor}}</span> </div>
      </div>
    </div>

   <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Total Courier</span> <span class="info-box-number">{{ $courier }}</span> </div>
      </div>
    </div> 
    
    
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-green"><i class="fa fa-product-hunt"></i></span>
        <div class="info-box-content"> <span class="info-box-text"></span>TOTAL PATIENT<span class="info-box-number">{{ $patient }}</span></div>
      </div>
    </div>

    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="fa fa-cart-plus"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Total Appointment</span> <span class="info-box-number">{{$appointment}}</span></div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-shopping-cart"></i></span>
        <div class="info-box-content"> 
          <span class="info-box-text">Total Order</span> <span class="info-box-number">{{  555 }}</span>
        </div>
      </div>
    </div>


    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-red"><i class="fa fa-user-o"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Today Sample Collection</span> <span class="info-box-number">{{ $sample_collection }}</span> </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-user-circle-o"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Empty Box Collection</span> <span class="info-box-number">{{ $empty_box_collection }}</span> </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="fa fa-hospital-o"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Organization</span> <span class="info-box-number">{{ $organization  }}</span></div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Total Sell Health Card</span> <span class="info-box-number">{{ $agent_package_sell }}</span></div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>


    
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>45600</h3>
          <p>Total Health Card Sell Amount</p>
        </div>
        <div class="icon">
          <i class="fa fa-shopping-cart"></i>
        </div>
      </div>
    </div>


    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>4300</h3>
          <p>Total Home Collection Amount</p>
        </div>
        <div class="icon">
          <i class="fa fa-cart-plus"></i>
        </div>
      </div>
    </div>


     <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>67</h3>
          <p>Today Sample Collected</p>
        </div>
        <div class="icon">
          <i class="fa fa-shopping-cart"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>54</h3>
          <p>Today Report Delivery</p>
        </div>
        <div class="icon">
          <i class="fa fa-bars"></i>
        </div>
      </div>
    </div>
    
    <!-- /.col -->
  </div>


  <div class="row">
        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Order Chart</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-10">
                  <p class="text-center">
                    <strong>Patient order list From January to December {{date('Y', strtotime(date('m/d/Y')))}}</strong>
                  </p>
                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="myChart" width="400" height="300"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Health Card Sale Chart</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-10">
                  <p class="text-center">
                    <strong>Health Sale Chart From January to December {{date('Y', strtotime(date('m/d/Y')))}}</strong>
                  </p>
                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="myChart2" width="400" height="300"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Order History</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="table_scroll" style="height: 260px;overflow: auto;">
                    <table class="table table-bordered table-striped table-hovered table-responsive">
                      <th>S/L</th>
                      <th>Oder ID</th>
                      <th>Patient ID</th>
                      <th>Patient Name</th>
                      <th>Total</th> 
                        <?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
                      <tbody>
                      @foreach($order_data as $order)
                          <tr>
                            <td><label class="label label-success">{{$currentNumber++}}</label></td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->patiant_id }}</td>
                            <td>{{ $order->patient_name }}</td>
                            <td>{{ $order->total }}</td>
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
        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Diagnostic Patient History</h3>  
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="table_scroll" style="height: 260px;overflow: auto;">
                    <table class="table table-bordered table-striped table-hovered table-responsive" s>
                      <th>S/L</th>
                      <th>Patient ID</th>
                      <th>Test Name</th>
                      <th>Amount</th>
                      <th>Delivery Date</th>

                      <?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>

                      @foreach($diagostic_list as $data)
                        <tbody>
                          <tr>
                            <td><label class="label label-success">{{$currentNumber++}}</label></td>

                            <td>{{  $data->patient_id }}</td>
                            <td>{{  $data->short_name }}</td>
                            <td>{{  $data->test_amount }}</td>
                            <td>{{  $data->test_delivery_date }}</td>
                          </tr>
                        </tbody>
                      @endforeach
                </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>

</section>
<!-- chart -->

<!-- /.content -->
@endsection 