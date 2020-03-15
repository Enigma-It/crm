@extends('layouts.layout')
@section('title', 'Appointment List')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    $view = pmscommon::userWiseAccessSelection('view');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i>Appointment List</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('franchise-list')}}">Appointment</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
    	@include('sweet::alert')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                @if($add_edit==true)
                    <a href="#" class="btn btn-success"><i class="fa fa-plus"></i> <b>Add New</b></a>
                @endif
                <a href="#" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Refresh</b></a>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-responsive">

                        <th>S/L</th>
                        <th>Doctor Name</th>
                        <th>Speciality</th>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>

                        <?php
                            $number = 1;
                            $numElementsPerPage = 25; // How many elements per page
                            $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>

                        <tbody id="mainList">

                        @foreach($allPatientBookingList as $data)

                            <tr>
                                <td><label class="label label-warning">{{$currentNumber++}}</label></td>
                                <td><b>{{ $data->getDoctorName->first_name }} {{ $data->getDoctorName->last_name }}</b></td>
                                <td><b>{{ $data->getDoctorName->specialist }}</b></td>
                                <td>{{ $data->patient_name }}</td>
                                <td>{{date('d/m/Y',strtotime($data->apt_date))}}</td>
                                <td>{{ date('h:i a',strtotime($data->apt_time)) }}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->email}}</td>
                                <td>
                                    <div class="form-inline">
                                       
                                        @if($delete==true)
                                            <div class="input-group">
                                            	{{Form::open(array('route'=>['doctor-appoinment.destroy',$data->id],'method'=>'DELETE'))}}
                                                <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This Appointment?" style="padding: 1px 9px;">Delete</button>
                                                {!! Form::close() !!}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                     <div align="center">{{ $allPatientBookingList->render() }}</div>
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