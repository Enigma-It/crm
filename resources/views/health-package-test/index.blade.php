@extends('layouts.layout')
@section('title', 'Health Package Test List')
@section('content')
    <?php
    use App\Library\pmscommon;
    use App\Library\memberShipLib;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i> Health Package List</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('health-package-test')}}">Health Package Test</a></li>
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
                    <a href="{{  url('health-package-test')  }}" class="btn btn-warning">
                        <i class="fa fa-refresh"></i> <b>Refresh</b>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-responsive">
                        <th>S/L</th>
                        <th>Package Name</th>
                        <th>Hospital Bill</th>
                        <th>Yearly Bill</th>
                        <th>Action</th>
                        <?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
                        <tbody id="mainList">
                        @foreach($healthpackage as $data)
                            <tr>
                                <td><label class="label label-success">{{$currentNumber++}}</label></td>
                                 <td>
                                    @if($data->package_type ==1)
                                        <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Prevent Health Card</label>
                                    @elseif($data->package_type==2)
                                        <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Gold Health Card</label>
                                    @else
                                        <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Platinum Health Card</label>
                                    @endif
                                </td>

                                <td>{{ memberShipLib::getNumberFormat($data->hospital_price) }}</td>
                                <td>{{ memberShipLib::getNumberFormat($data->yearly_price) }}</td>

                                
                                <td>
                                    <div class="form-inline">
                                        <div class = "input-group">
                                            <a href="#editModal{{$data->id}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                                        </div>
                                        <div class="input-group">
                                            {{Form::open(array('route'=>['health-package-test.destroy',$data->id],'method'=>'DELETE'))}}
                                            <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This District?" style="padding: 1px 9px;">Delete</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"><i class="fa fa-edit" style="color:#E08E0B"></i>Update Health Package Test</h4>
                                                </div>
                                                {!! Form::open(array('route' => ['health-package-test.update', $data->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                         <label class="required font-weight-bold text-dark text-2">Health package name</label>
                                                       <select name="package_type" class="form-control">
                                                         <option value="">Select package</option>
                                                        <option value="1" {{ ($data->package_type==1)?'selected':'' }}>Preventive Health Card</option>
                                                        <option value="2" {{ ($data->package_type==2)?'selected':'' }}>Gold Health Card</option>
                                                         <option value="3" {{ ($data->package_type==3)?'selected':'' }}>Platinum Health Card</option>    
                                                      </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label for="user_type">Hospital price: </label>
                                                            <input type="text" class="form-control" value="{{  $data->hospital_price  }}" name="hospital_price" placeholder="Enter test name" required>
                                                        </div>
                                                    </div>

                                                     <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label for="user_type">Yearly price: </label>
                                                            <input type="text" class="form-control" value="{{  $data->yearly_price  }}" name="yearly_price" placeholder="Enter test name" required>
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
                <div class="modal-dialog modal-sm">
                    <div class="modal-content" style="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-plus-square" style="color: green"></i>Add New Health Package Test</h4>
                        </div>
                        {!! Form::open(array('route' => ['health-package-test.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="required font-weight-bold text-dark text-2">Division</label>
                                    <select name="package_type" class="form-control">
                                        <option value="">Select package</option>
                                        <option value="1" name="package_type">Preventive health card</option>
                                        <option value="2" name="package_type">Gold health card</option>
                                         <option value="3" name="package_type">Platinum health card</option>
                                     </select>
                                </div>
                                <div class="col-md-12">
                                    <label>Hospital price:</label>
                                    <input type="text" class="form-control" value="" name="hospital_price" placeholder="Enter hospital price" required>
                                </div>

                                 <div class="col-md-12">
                                    <label>Yearly price:</label>
                                    <input type="text" class="form-control" value="" name="yearly_price" placeholder="Enter yearly price" required>
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