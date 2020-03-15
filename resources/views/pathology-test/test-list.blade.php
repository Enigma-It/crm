@extends('layouts.layout')
@section('title', 'Pathologoy Test')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i>Pathologoy Test</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('pathology-test')}}">Test List</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('sweet::alert')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                <div class="box-header with-border" align="right">
                    <a href="{{route('pathology-test.create')}}" class="btn btn-success">
                      <i class="fa fa-plus"></i> <b>Add New</b>
                    </a>
                    <a href="{{  url('pathology-test')  }}" class="btn btn-warning">
                      <i class="fa fa-refresh"></i> <b>Refresh</b>
                    </a>
                </div>
            </div>

            <div class="box-body">
    
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-responsive">
                        <th>S/L</th>
                        <th>Test Name</th>
                        <th>Short Name</th>
                        <th>Department Name</th>
                        <th>Probe Price</th>
                        <th>Franchise Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                        <?php
	                        $number = 1;
	                        $numElementsPerPage = 30; // How many elements per page
	                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
                        <tbody id="mainList">
                        @foreach($testList as $data)
                            <tr>
                                <td><label class="label label-success">{{$currentNumber++}}</label></td>
                                <td>{{ $data->test_name }}</td>
                                <td>{{ $data->short_name }}</td>
                                <td><strong>{{ $data->getTestDept->name }}</strong></td>
                                <td>{{ $data->pr_price }}</td>
                                <td>{{ $data->fr_price }}</td>
                                <td>{{ $data->total_price }}</td>
                                <td>
                                	@if($data->status == 1)
                                		<label class="label label-success">Enable</label>
                                	@else
                                		<label class="label label-danger">Disable</label>
                                	@endif
                                </td>
                                <td>
                                    <div class="form-inline">
                                        <div class = "input-group">
                                            <a href="{{route('pathology-test.edit',$data->id)}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                                        </div>
                                        <div class="input-group">
                                            {{Form::open(array('route'=>['pathology-test.destroy',$data->id],'method'=>'DELETE'))}}
                                            <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This Test?" style="padding: 1px 9px;">Delete</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>

                    </table>
                    <div align="center">{{$testList->render()}}</div>
                </div>
            </div>
    <!-- /.box-body -->
            <div class="box-footer"> </div>
            <!-- /.box-footer-->
        </div>
    </section>

    <!-- /.content -->
@endsection