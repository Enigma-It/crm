@extends('layouts.layout')
@section('title', "Order Details of $orderDetails->patient_name")
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    $view = pmscommon::userWiseAccessSelection('view');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-user"></i>Order Details of {{$orderDetails->patient_name}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Order Details</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                
                <a href="#" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Order List</b></a>
            </div>

            <div class="box-body">
               
                <div class="table-responsive">
                    
                    <table class="table table-bordered table-striped table-responsive">
                        
                        <tr>
                            <td>Patiant Name</td>
                            <td><label>{{$orderDetails->patient_name}}</label></td>
                            <td>Patiant Mobile</td>
                            <td><label>{{$orderDetails->phone_no}}</label></td>
                        </tr>
                        <tr>
                            <td>Patiant ID</td>
                            <td><label>{{ $orderDetails->patient_id }}</label></td>
                            <td>Patiant Email</td>
                            <td><label>{{$orderDetails->email}}</label></td>
                        </tr>
                        <tr>
                            <td>Order ID</td>
                            <td><label>
                                {{$orderDetails->order_id}}
                            </label></td>
                            <td>Order Date</td>
                            <td><label>{{ $orderDetails->order_date }}</label></td>
                                
                        </tr>

                        <tr>
                            <td>Test/Package Name</td>
                            <td><label>
                                @if($orderDetails->item_type == 'package')
                                {{$orderListData->name}}
                                @else
                                {{$orderListData->test_name}}
                                @endif
                            </label></td>

                            <td>Per Price</td>
                            <td><label>
                                {{$orderDetails->total}}
                            </label></td>
                        </tr>

                        <tr>
                            <td>Total</td>
                            <td><label>
                                {{ $orderDetails->total}}
                            </label></td>
                            <td>Pay Type</td>
                                <td>
                                    @if($orderDetails->pay_type == 0)
                                        <label class="control-label label-warning" style="padding: 0px 15px; border-radius: 3px;">CASH</label>
                                    @elseif($data-> order_status==1)
                                        <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">BANK</label>
                                    @else
                                        <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">Cancelled</label>
                                    @endif
                                </td>
                                
                        </tr>
                
                        
                    </table>
                   
                   
                    <div align="center">
                      
                        {{Form::open(array('route'=>['order-approve.update',$orderDetails->order_id],'method'=>'PUT','files'=>true))}}

                        @if($orderDetails->order_status == 1 || $orderDetails->order_status == 3)
                           <button class="btn btn-default confirm" style="background: #057522;border: none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="2" confirm="Are you want to approve this franchise?">Approve This Order</button> 
                        @endif
                         @if($orderDetails->order_status == 1 || $orderDetails->order_status == 2)  
                           <button class="btn btn-default confirm" style="background: #e22020;border: none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="3" confirm="Are you want to cancel this franchise?">Cancel This Order</button> 
                           @endif
                        
                        
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"> </div>
            <!-- /.box-footer-->
        </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection