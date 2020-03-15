@extends('layouts.layout')
@section('title', 'Agent Commision List')
@section('content')
<?php  
  use App\Library\pmscommon;
  $add_edit = pmscommon::userWiseAccessSelection('add_edit');
  $delete = pmscommon::userWiseAccessSelection('delete');
?>
<section class="content-header">
  <h1><i class="fa fa-list"></i> Agent Commision List</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Agent Commision List</li>
  </ol>
</section>

<section class="content">

  @include('common.message')

  <div class="box box-success">

    <div class="box-header with-border" align="right">
       <a href="#addModal" class="btn btn-primary" data-toggle="modal">Add Commision</a>
       <a href="{{url('agent-management')}}" class="btn btn-warning">
        <i class="fa fa-refresh"></i> <b>Refresh</b>
      </a> 
    </div>
    <div class="box-body">
      <div class="table_scroll">
        <table class="table table-bordered table-striped table-responsive">
              <th>S/L</th>
              <th>Agent Name</th>
              <th>Agent Type</th>
              <th>Agent Commision(%)</th>
              <th>Action</th>
            <?php                           
              $number = 1;
              $numElementsPerPage = 10; // How many elements per page
              $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
            ?>
          <tbody>
            @if(isset($agentListData))
              @foreach($agentListData as $data)
                <tr>
                  <td><label class="label label-success">{{$currentNumber++}}</label></td>
                  <td>{{  $data->name  }}</td>
                  @if($data->agent_type == 1)
                  <td> Central Agent </td>
                  @elseif($data->agent_type == 2)
                   <td>Division Agent</td>
                  @elseif($data->agent_type == 3)
                    <td>District  Agent</td>
                  @elseif($data->agent_type == 4)
                     <td>Thana  Agent</td>
                  @endif
                  <td>{{  $data->commision  }}%</td>
                  <td>
                    <div class="form-inline">
                        @if($add_edit==true)
                        <div class = "input-group">
                          <a href="#editModal{{$data->id}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                        </div>
                        @endif
                        <div class="input-group">
                           {{Form::open(array('route'=>['agent-management.destroy',$data->id],'method'=>'DELETE'))}}
                            <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This District?" style="padding: 1px 9px;">Delete</button>
                           {!! Form::close() !!}
                        </div>
                    </div>
                    @if($add_edit==true)
                    <!-- Modal Start -->
                      <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content" style="">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"> <i class="fa fa-edit"></i>Agent Commision Edit</h4>
                            </div>
                              {!! Form::open(array('route' => ['agent-management.update', $data->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                            <div class="modal-body">


                              <div class="form-group">
                                  <div class="col-md-12">
                                     <label class="required font-weight-bold text-dark text-2">Agent Name</label>
                                        <select name="agent_name" class="form-control" required>
                                           <option value="">Select Agent Name</option>
                                            @foreach($agentDataInfo as $agentData)
                                            <option value="{{  $agentData->id }}"{{($data->agent_id== $agentData->id)?'selected':''}}>{{ $agentData->name }}</option>
                                             @endforeach
                                         </select>
                                     </div>
                                </div> 

                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="name">Agent Type:</label>
                                    <select name="agent_type" class="form-control" required>
                                        <option value="">Select Agent Type</option> 
                                        <option value="1" {{ ($data->agent_type==1)?'selected':'' }}>Central  Agent</option>
                                        <option value="2" {{ ($data->agent_type==2)?'selected':'' }}>Division Agent</option>
                                        <option value="3" {{ ($data->agent_type==3)?'selected':'' }}>District  Agent</option>
                                        <option value="4" {{ ($data->agent_type==4)?'selected':'' }}>Thana  Agent</option>
                                     </select>
                                    
                                  </div>
                              </div> 

                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="name">Agent Commision:</label>
                                    <input type="text" name="commision" class="form-control" value="{{  $data->commision }}" required> 

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
                <td colspan="3" align="center"> No Data Found</td>
              </tr>
              @endif



          </tbody>
        </table>
        

                            <!-- Modal Start -->
                      <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content" style="">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"> <i class="fa fa-edit"></i> Assign Agent Commision</h4>
                            </div>
                              {!! Form::open(array('route' => ['agent-management.store', $data->id],'class'=>'form-horizontal','method'=>'POST')) !!}
                            <div class="modal-body">
                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="name">Agent Name: </label>
                                      <select name="agent_id" class="form-control" required>
                                        <option value="">Select Agent</option>
                                         @foreach($agentDataInfo  as $agent)
                                       <option value="{{$agent->id}}">{{ $agent->name }}</option>
                                        @endforeach
                                     </select>
                                  </div>
                              </div> 

                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="name">Agent Type:</label>
                                      <select name="agent_type" class="form-control" required>
                                        <option value="">Select Agent Type</option> 
                                        <option value="1">Central  Agent</option>
                                        <option value="2">Division Agent</option>
                                        <option value="3">District  Agent</option>
                                        <option value="4">Thana  Agent</option>
                                     </select>
                                  </div>
                              </div> 

                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="name">Agent Commision:</label>
                                    <input type="text" name="commision" class="form-control" required> 

                                  </div>
                              </div> 

                              <input type="hidden" name="status" value="1">

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      {{Form::submit('SAVE',array('class'=>'btn btn-success'))}}
                            </div>
                              {!! Form::close() !!}
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div>

      </div>
    </div>
    <div class="box-footer"> </div>
  </div>
</section>
<!-- /.modal -->


@endsection 