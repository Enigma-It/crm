@extends('layouts.layout')
@section('title', 'District List')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i> District List</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('district')}}">District</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                <div class="box-header with-border" align="right">
                    <a href="#addModal" class="btn btn-success" data-toggle="modal">
                        <i class="fa fa-plus"></i> <b>Add New</b>
                    </a>
                    <a href="{{  url('district')  }}" class="btn btn-warning">
                        <i class="fa fa-refresh"></i> <b>Refresh</b>
                    </a>
                </div>
            </div>

            <div class="box-body">
                {{--            <div class="form-group">
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
                        <th>Division Name</th>
                        <th>District Name</th>
                        <th>Action</th>
                        <?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
                        <tbody id="mainList">
                        @foreach($districts as $data)
                            <tr>
                                <td><label class="label label-success">{{$currentNumber++}}</label></td>
                                <td>{{ $data->division_name }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    <div class="form-inline">
                                        <div class = "input-group">
                                            <a href="#editModal{{$data->id}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                                        </div>
                                        <div class="input-group">
                                            {{Form::open(array('route'=>['district.destroy',$data->id],'method'=>'DELETE'))}}
                                            <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This District?" style="padding: 1px 9px;">Delete</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"><i class="fa fa-edit" style="color:#E08E0B"></i>Update District</h4>
                                                </div>
                                                {!! Form::open(array('route' => ['district.update', $data->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label class="required font-weight-bold text-dark text-2">Division</label>
                                                            <select name="division_id" class="form-control">
                                                                <option value="">Select Division</option>
                                                                @foreach($divisions as $division)
                                                                    <option value="{{  $division->id }}"{{($data->division_id==$division->id)?'selected':''}}>{{ $division->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label for="user_type">Name: </label>
                                                            <input type="text" class="form-control" value="{{  $data->name  }}" name="name" placeholder="Enter Division name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100%">
                                                            Close
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{Form::submit('Update',array('class'=>'btn btn-warning', 'style'=>'width:100%'))}}
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            {{--start model--}}

                            {{--End model--}}
                        @endforeach
                        </tbody>

                    </table>
                    @if(isset($districts))
                        <div align="center">{{ $districts->render() }}</div>
                    @endif
                </div>
            </div>
            {{--add model are here--}}
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content" style="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-plus-square" style="color: green"></i>Add New District</h4>
                        </div>
                        {!! Form::open(array('route' => ['district.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="required font-weight-bold text-dark text-2">Division</label>
                                    <select name="division_id" class="form-control">
                                        <option value="">Select Division</option>
                                        @foreach($divisions as $division)
                                            <option value="{{  $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label>Name:</label>
                                    <input type="text" class="form-control" value="" name="name" placeholder="Enter District Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100%">Close</button>
                            </div>
                            <div class="col-md-6">
                                {{Form::submit('Save',array('class'=>'btn btn-success', 'style'=>'width:100%'))}}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        {{--  end add model are here--}}



        <!-- /.box-body -->
            <div class="box-footer"> </div>
            <!-- /.box-footer-->
        </div>
    </section>

    <!-- /.content -->
@endsection