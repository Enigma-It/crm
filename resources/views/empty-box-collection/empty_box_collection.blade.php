@extends('layouts.layout')
@section('title', 'Dispatch box List')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-square-o"></i>&nbsp;Empty Box Collection</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('empty-box-collection')}}">Empty Box Collection</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                <div class="box-header with-border" align="right">
                    @if($add_edit == true)
                    <a href="#addModal" class="btn btn-success" data-toggle="modal">
                      <i class="fa fa-plus"></i> <b>Add New</b>
                    </a>
                    @endif
                    <a href="{{  url('empty-box-collection')  }}" class="btn btn-warning">
                      <i class="fa fa-refresh"></i> <b>Refresh</b>
                    </a>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-responsive">
                        <th>Dispatch date</th>
                        <th>Empty box qty</th>
                      
                        <th>Status</th>
                        <th>Action</th>
                        <?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
                        <tbody id="mainList">
                        @foreach($emptyBoxCollection as $data)
                            <tr>
                                <td><strong>{{ date('d/m/Y',strtotime($data->dispatch_date)) }}</strong></td>
                                <td>{{ $data->empty_box_qty }}</td>
                                

                                <td>
                                    @if($data->status ==1)
                                        <label class="control-label label-info" style="padding: 0px 9px; border-radius: 3px;font-size: 16px;">Hand over</label>
                                    @elseif($data->status==2)
                                        <label class="control-label label-warning" style="padding: 0px 9px; border-radius: 3px;font-size: 16px;">In transit</label>   
                                    @else
                                        <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;font-size: 16px;">Box-recieved</label>
                                    @endif
                                </td>
                                <td>
                                  <div class="form-inline">
                                    {!! Form::open(array('route' => ['empty-box-collection.update', $data->id],'class'=>'form-horizontal','method'=>'PUT')) !!}

                                       @if($data->status == 1)
                                        <button class="btn btn-warning confirm" style="border: none;color: #fff;padding: 5px 10px;font-size: 14px;" name="status" value="2" confirm="Are you want to change the empty box status?">In transit</button> 
                                       @endif
                                       @if($data->status == 2)
                                        <button class="btn btn-info confirm" style="border: none;color: #fff;padding: 5px 10px;font-size: 14px;" name="status" value="3" confirm="Are you want to change the empty box status?">Box-recieved</button> 
                                       @endif
                                       @if($data->status == 3)
                                        <label class="label-success" style="padding: 5px 10px;font-size: 16px;"><i class="fa fa-check"></i>&nbsp; Box arrived</label>
                                       @endif
                                     {!! Form::close() !!}
                                    </div>






                                      







                                </td>
                            </tr>

                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>




            {{--add model are here--}}
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content" style="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-plus-square" style="color: green"></i> Empty Box</h4>
                        </div>
                        {!! Form::open(array('route' => ['empty-box-collection.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="user_type">Dispatch Date:</label>
                                    <input type="date" class="form-control" id="" value="" name="dispatch_date" placeholder="Enter Area Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="user_type">Empty box qty:</label>
                                    <input type="number" class="form-control" id="" value="" name="empty_box_qty" placeholder="Enter empty box qty" required>
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