@extends('layouts.layout')
@section('title', 'Order List')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    $view = pmscommon::userWiseAccessSelection('view');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i>Order List</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('order-list')}}">Order List</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
    	@include('sweet::alert')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
              <a href="#" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Refresh</b>
              </a>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-responsive">

                        <th>S/L</th>
                        <th>Patiant Name</th>
                         <th>Patiant ID</th>
                        <th>Phone</th>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th>Total</th>
                        <th>Action</th>

                        <?php
                            $number = 1;
                            $numElementsPerPage = 25; // How many elements per page
                            $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>

                        <tbody id="mainList">

                        @foreach($adminOrderList as $data)

                            <tr>
                                <td><label class="label label-warning">{{$currentNumber++}}</label></td>
                                <td><b>{{ $data->patient_name }}</b></td>
                                <td><b>{{ $data->patient_id }}</b></td>
                                <td>{{ $data->phone_no }}</td>
                                <td>{{ $data->order_id }}</td>
                                <td>{{ $data->order_date }}</td>
                                <td>
                                    @if($data->	order_status ==1)
                                        <label class="control-label label-warning" style="padding: 0px 15px; border-radius: 3px;">Proposed</label>
                                    @elseif($data->	order_status==2)
                                        <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">Approved</label>
                                    @else
                                        <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">Cancelled</label>
                                    @endif
                                </td>

                                <td>{{$data->total}}</td>
                                <td>
                                    <div class="form-inline">
                                        <div class="input-group">
                                           <a href="{{route('order.show',$data->order_id)}}" class="btn btn-info btn-xs" style="padding: 1px 15px; margin:5px;">View</a>
                                           
											 <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This Appointment?" style="padding: 1px 9px;">Delete</button>
                                         </div>
                                    
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                
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