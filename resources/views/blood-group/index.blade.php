@extends('layouts.layout')
@section('title', 'Blood Group List')
@section('content')
<?php  
  use App\Library\memberShipLib;
  use App\Library\pmscommon;
  $add_edit = pmscommon::userWiseAccessSelection('add_edit');
  $delete = pmscommon::userWiseAccessSelection('delete');
?>
<section class="content-header">
  <h1><i class="fa fa-list"></i> Blood Group List</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Blood Group List</li>
  </ol>
</section>

<section class="content">

  @include('common.message')

  <div class="box box-success">

    <div class="box-header with-border" align="right">
      @if($add_edit==true)
      <a href="#addModal" class="btn btn-success" data-toggle="modal">
        <i class="fa fa-plus"></i> <b>Add New</b>
      </a> 
      @endif
      <a href="{{URL::to('blood-group')}}" class="btn btn-warning">
        <i class="fa fa-refresh"></i> <b>Refresh</b>
      </a> 
    </div>

    <div class="box-body">
      
      <div class="table_scroll">
        <table class="table table-bordered table-striped table-responsive">
              <th>S/L</th>
              <th>Blood Group</th>
              <th>Sale Rate / Bag</th>
              <th>Action</th>
            <?php                           
              $number = 1;
              $numElementsPerPage = 10; // How many elements per page
              $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
            ?>
          <tbody>
            @if(isset($alldata) && count($alldata)>0)

              @foreach($alldata as $data)
                <tr>
                  <td><label class="label label-success">{{$currentNumber++}}</label></td>
                  <td>{{  $data->group_name  }}</td>
                  <td>{{  memberShipLib::getNumberFormat($data->sale_rate)  }}</td>
                  <td>
                    <div class="form-inline">
                        @if($add_edit==true)
                        <div class = "input-group">
                          <a href="#editModal{{$data->id}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                        </div>
                        @endif
                        @if($delete==true)
                        <div class = "input-group"> 
                          {{Form::open(array('route'=>['blood-group.destroy',$data->id],'method'=>'DELETE'))}}
                            <button type="submit" confirm="Are you sure you want to delete this information ?" class="btn btn-danger btn-xs confirm" title="Delete" style="padding: 1px 9px;">Delete</button>
                          {!! Form::close() !!}
                        </div>
                        @endif
                    </div>
                    @if($add_edit==true)
                    <!-- Modal Start -->
                      <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content" style="">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"> <i class="fa fa-edit"></i> Update Blood Group</h4>
                            </div>
                              {!! Form::open(array('route' => ['blood-group.update', $data->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                            <div class="modal-body">
                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="group_name">Blood Group Name: </label>
                                    <input type="text" class="form-control" value="{{  $data->group_name  }}" name="group_name" placeholder="Blood Group Name" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="sale_rate">Sale Rate: </label>
                                    <input type="text" class="form-control" value="{{  $data->sale_rate  }}" name="sale_rate" placeholder="Sale Rate" required>
                                  </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      {{Form::submit('Update',array('class'=>'btn btn-success'))}}
                            </div>
                              {!! Form::close() !!}
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div>
                    <!-- /.modal -->
                    @endif
                  </td>
                </tr>
              @endforeach
              @else
              <tr>
                <td colspan="4" align="center"> No Data Found</td>
              </tr>
              @endif
          </tbody>
        </table>
        <div align="center">{{ $alldata->render() }}</div>
      </div>

    </div>

    <div class="box-footer"> </div>

  </div>
</section>

@if($add_edit==true)
<!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"> <i class="fa fa-plus-square"></i> Add Blood Group</h4>
        </div>
          {!! Form::open(array('route' => ['blood-group.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
        <div class="modal-body">
          <div class="form-group">
              <div class="col-md-12">
                <label for="group_name">Blood Group Name: </label>
                <input type="text" class="form-control" value="" name="group_name" placeholder="Blood Group Name" required>
              </div>
          </div>
          <div class="form-group">
              <div class="col-md-12">
                <label for="sale_rate">Sale Rate: </label>
                <input type="text" class="form-control" value="" name="sale_rate" placeholder="Sale Rate" required>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {{Form::submit('Save',array('class'=>'btn btn-success'))}}
        </div>
          {!! Form::close() !!}
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
<!-- /.modal -->
@endif

@endsection 