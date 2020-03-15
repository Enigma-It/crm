@extends('layouts.layout')
@section('title', 'Employee Salary List')
@section('content')
<?php 
  use App\Library\memberShipLib;
  use App\Library\pmscommon;
  $add_edit = pmscommon::userWiseAccessSelection('add_edit');
  $delete = pmscommon::userWiseAccessSelection('delete');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-list"></i> Employee Salary List</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{URL::to('employee-salary-list')}}">Employee Salary</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  @include('common.message')
  @include('common.commonFunction')
  <?php $getMonthFromArr = months();?>
  <div class="box box-success">
    <div class="box-header with-border" align="right">
      @if($add_edit==true)
        <a href="{{url('employee-salary-list/create')}}" class="btn btn-success"><i class="fa fa-plus"></i> <b>Add New</b></a> 
      @endif
        <a href="{{ url('employee-salary-list') }}" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Refresh</b></a> 
    </div>

    <div class="box-body">
     
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-responsive">
              <th>S/L</th>
              <th>Image</th>
              <th>Employee Name</th>
              <th>Month</th>
              <th>Year</th>
              <th>Salary</th>
              <th>Action</th>
              <?php                           
                $number = 1;
                $numElementsPerPage = 10; // How many elements per page
                $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
              ?>
          <tbody id="mainList">
            @if(!empty($salaryList))
            @foreach($salaryList as $data)
              <tr>
                <td><label class="label label-success">{{$currentNumber++}}</label></td>
                <td>
                  @if($data->image)
                 <img src='{{asset("storage/app/public/uploads/employee/$data->image")}}' class="img-circle" style="height: 35px;width: 35px;">
                 @else
                 <img src='{{asset("storage/app/public/uploads/default.png")}}' class="img-circle" style="height: 35px;width: 35px;">
                 @endif
                </td>
                <td>{{ $data->employee_name }}</td>
                <td>{{$getMonthFromArr[$data->month]}}</td>
                <td>{{$data->year}}</td>
                <td>{{memberShipLib::getNumberFormat($data->salary)}}</td>
                <td>
                  <div class="form-inline">
                    @if($add_edit==true)
                    <div class="input-group">
                      <a href="{{ route('employee-salary-list.edit', $data->id) }}" class="btn btn-primary btn-xs" style="padding: 1px 15px;">Edit</a>
                    </div>
                    @endif
                    @if($delete==true)
                    <div class="input-group">
                      {{Form::open(array('route'=>['employee-salary-list.destroy',$data->id],'method'=>'DELETE'))}}
                        <button type="submit" class="btn btn-danger btn-xs confirm" confirm="Are You Sure You Want to Delete this salary information ?"  title="Delete" style="padding: 1px 9px;">Delete</button>
                      {!! Form::close() !!}
                    </div>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
            @else
            <tr><td colspan="7" align="center">No Data Found . . .</td></tr>
            @endif
          </tbody>
      
        </table>
        <div>{{ $salaryList->render() }}</div>
      </div>
    </div>

    <!-- /.box-body -->
    <div class="box-footer"> </div>
    <!-- /.box-footer-->
  </div>
</section>

<!-- /.content -->
@endsection 