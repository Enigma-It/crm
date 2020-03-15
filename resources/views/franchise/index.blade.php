@extends('layouts.layout')
@section('title', 'Franchise List')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    $view = pmscommon::userWiseAccessSelection('view');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i> Franchise List</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('franchise-list')}}">Franchise</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                @if($add_edit==true)
                    <a href="{{  route('agent-franchise.create')  }}" class="btn btn-success"><i class="fa fa-plus"></i> <b>Add New</b></a>
                @endif
                <a href="{{ url('franchise-list') }}" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Refresh</b></a>
            </div>

            <div class="box-body">
               {{-- <div class="form-group">
                    <div class="row col-md-3 pull-right">
                        {!! Form::open(array('url' => 'search-employee','class'=>'form-horizontal','method' =>'POST','files'=>true)) !!}
                        @if(isset($autocomplete))
                            <input name="user_search" value="{{$autocomplete}}" id="searchEmployee" class="form-control filter_wow" placeholder="Search by User Name . . ." type="text" selected style="border-radius: 25px;font-style: italic;">
                        @else
                            <input name="user_search" value="" id="searchEmployee" class="form-control filter_wow" placeholder="Search by Employee Name . . ." type="text" selected style="border-radius: 25px;font-style: italic;">
                        @endif
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                </div>--}}
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-responsive">

                        <th>S/L</th>
                        <th>Franchise Name</th>
                        <th>Add By</th>
                        <th>Phone Number</th>
                        <th>Org Type</th>
                        <th>Org Name</th>
                        <th>Status</th>
                        <th>Action</th>

                        <?php
                            $number = 1;
                            $numElementsPerPage = 10; // How many elements per page
                            $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>

                        <tbody id="mainList">

                        @foreach($allFranchise as $data)

                            <tr>
                                <td><label class="label label-warning">{{$currentNumber++}}</label></td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    @if(!empty($data->agent_id))
                                    <strong>{{ $data->agent_name }}</strong>
                                    @else
                                    <strong>Franchise Self</strong>
                                    @endif
                                </td>
                                <td>{{$data->mobile}}</td>
                                <td>
                                    @if($data->organization_type ==1)
                                        <b>Hospital</b>
                                    @elseif($data->organization_type ==2)
                                     <b>Clinic</b>
                                    @elseif($data->organization_type ==3)
                                     <b>Diagnostic Center</b>
                                    @elseif($data->organization_type ==4)
                                    <b>Nursing Home</b>
                                    @elseif($data->organization_type ==5)
                                    <b>Doctor Chamber</b>
                                    @elseif($data->organization_type ==6)
                                    <b>Pharmacy</b>
                                    @elseif($data->organization_type ==7)
                                    <b>Others</b>
                                    @endif
                                    
                                </td>
                                <td>{{$data->organizationData['org_name']}}</td>
                                <!-- <td title="{{$data->organizationData['org_address']}}" data-toggle="tooltip">{{substr($data->organizationData['org_address'],0,25)}}</td> -->
                                <td>
                                    @if($data->status ==1)
                                        <label class="control-label label-warning" style="padding: 0px 15px; border-radius: 3px;">Proposed</label>
                                    @elseif($data->status==2)
                                        <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">Approved</label>
                                    @else
                                        <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">Cancelled</label>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-inline">
                                        @if($view==true)
                                            <div class="input-group">
                                                <a href="{{route('agent-franchise.show',$data->id)}}" class="btn btn-info btn-xs" style="padding: 1px 15px;">View</a>
                                            </div>
                                        @endif
                                        @if($delete==true)
                                            <div class="input-group">
                                                {{Form::open(array('route'=>['agent-franchise.destroy',$data->id],'method'=>'DELETE'))}}
                                                <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This Franchise?" style="padding: 1px 9px;">Delete</button>
                                                {!! Form::close() !!}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>


                    </table>

                        <div align="center">{{ $allFranchise->render() }}</div>

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