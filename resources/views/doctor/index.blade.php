@extends('layouts.layout')
@section('title', 'Doctor List')
@section('content')
<?php  
  use App\Library\pmscommon;
  $add_edit = pmscommon::userWiseAccessSelection('add_edit');
  $delete = pmscommon::userWiseAccessSelection('delete');
  $view = pmscommon::userWiseAccessSelection('view');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-list"></i> Doctor List</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{URL::to('doctor')}}">Doctor</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
    <div class="box-header with-border" align="right">
      @if($add_edit==true)
      <a href="{{  url('doctor/create')  }}" class="btn btn-success"><i class="fa fa-plus"></i> <b>Add New</b></a> 
      @endif
      <a href="{{ url('doctor') }}" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Refresh</b></a> 
    </div>

    <div class="box-body">
      <div class="form-group">
        <div class="row col-md-3 pull-right">
          {!! Form::open(array('url' => 'search-doctor','class'=>'form-horizontal','method' =>'GET','files'=>true)) !!}
          @if(isset($autocomplete))
          <input name="searching_name" value="{{$autocomplete}}" class="form-control" placeholder="Search by User Name . . ." type="text" selected style="border-radius: 25px;font-style: italic;">
          @else
          <input name="searching_name" value="" class="form-control" placeholder="Search by Doctor Name . . ." type="text" selected style="border-radius: 25px;font-style: italic;">
          @endif
         {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hovered table-responsive">
              <th>Image</th>
              <th>Doctor Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Department</th>
              <th>Joining Date</th>
              <th>Status</th>
              <th>Action</th>
              <tbody>
                @if(!empty(json_decode(json_encode($doctorList), true)))
                  @foreach($doctorList as $data)
                    <tr>
                      <td>
                        @if(!empty($data->image))
                        <img src="{{asset('storage/app/public/uploads/doctor')}}/{{$data->image}}" width="35">
                        @else
                        <img src="{{asset('storage/app/public/uploads/person.jpg')}}" width="35">
                        @endif
                      </td>
                      <td>{{$data->first_name.' '.$data->last_name}}</td>
                      <td>{{$data->email}}</td>
                      <td>{{$data->phone_no}}</td>
                      <td>{{$data->department_name}}</td>
                      <td>{{date('m/d/Y', strtotime($data->joining_date))}}</td>
                      <td>
                        @if($data->status==1)
                          <label class="label label-success">Active</label>
                        @else
                          <label class="label label-danger">Inactive</label>
                        @endif
                      </td>
                      <td>
                        <div class="form-inline">
                        @if($view==true)
                        <div class = "input-group">
                          <a href="{{route('doctor.show', $data->id)}}" data-toggle="modal" class="btn btn-info btn-xs" style="padding: 1px 7px" title="View Profile"><span class="fa fa-user"></span></a>     
                        </div>
                        @endif
                        @if($add_edit==true)
                        <div class = "input-group">
                          <a href="{{route('doctor.edit', $data->id)}}" data-toggle="modal" class="btn btn-primary btn-xs" style="padding: 1px 15px" title="Edit Profile">Edit</a>     
                        </div>
                        @endif
                        @if($delete==true)
                        <div class = "input-group"> 
                          {{Form::open(array('route'=>['doctor.destroy',$data->id],'method'=>'DELETE'))}}
                            <button type="submit" confirm="Are you sure you want to delete this information ?" class="btn btn-danger btn-xs confirm" title="Delete Profile" style="padding: 1px 9px;">Delete</button>
                          {!! Form::close() !!}
                        </div>
                        @endif
                      </div>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="8" style="text-align: center;"> No Information Found ...</td>
                  </tr>
                @endif
              </tbody>
        </table>
        <div align="center">{{ $doctorList->render() }}</div>
      </div>
    </div>
    <div class="box-footer"> </div>
  </div>
</section>
@endsection 