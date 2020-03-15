@extends('layouts.layout')
@section('title', 'Courier Sample collection')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i>  Courier sample collection List</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('logistic')}}">Courier sample collection</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                <div class="box-header with-border" align="right">
                    <a href="{{ url('courier-sample') }}" class="btn btn-success" data-toggle="modal">
                      <i class="fa fa-plus"></i> <b>Add New</b>
                    </a>                   

                    <a href="{{  url('courier-collection')  }}" class="btn btn-warning">
                      <i class="fa fa-refresh"></i> <b>Refresh</b>
                    </a>
                </div>
            </div>



            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-responsive">
                        <th>S/L</th>
                        <th>Courier name</th>
                        <th>Collection date</th>
                        <th>Box-QTY</th>
                        <th>Bus number</th>
                        <th>Supervisor name</th>
                        <th>Status</th>
                        <th>Action</th>
                        <?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
                        <tbody id="mainList">
                        @foreach($courierSample as $data)
                        <?php
                           $courierName =  DB::table('couriers')
                                              ->where('couriers.id',$data->courier_id) 
                                              ->first();
                         ?>

                            <tr>
                                <td><label class="label label-success">{{$currentNumber++}}</label></td>
                                <td>{{ $courierName->name }}</td>
                                <td>{{ $data->collected_date }}</td>
                                <td>{{ $data->box_qty }}</td>
                                <td>{{ $data->bus_number }}</td>
                                <td>{{ $data->supervisor_name }}</td>
                                <td>
                                  @if($data->status ==1)
                                  <label class="control-label label-warning collectionSampleList" style="padding: 0px 15px; border-radius: 3px;">In Transit</label>
                                  @elseif($data->status==2)
                                    <label class="control-label label-info collectionSampleList" style="padding: 0px 9px; border-radius: 3px;">Arrived</label>

                                  @elseif($data->status==3)
                                    <label class="control-label label-primary collectionSampleList" style="padding: 0px 9px; border-radius: 3px;">Way to lab</label>  
                                  @else
                                    <label class="control-label label-success collectionSampleList" style="padding: 0px 9px; border-radius: 3px;">Box-recived successfully</label>
                                  @endif
                                </td> 
                                <td>
                                    <div class="form-inline">
                                        <div class = "input-group">
                                           <a href="#viewModal{{$data->id}}" class="btn btn-warning btn-xs" 
                            data-toggle="modal" style="padding: 1px 15px;font-size:16px;" >View
                           </a>
                                        </div>

                                        <div class="input-group">
                                            {{Form::open(array('route'=>['courier-collection.destroy',$data->id],'method'=>'DELETE'))}}
                                            <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This Division?" style="padding: 1px 9px;font-size:16px;">Delete</button>
                                            {!! Form::close() !!}
                                        </div>

                                    </div> 




                                                 {{--start model--}}
        <div class="modal fade" id="viewModal{{$data->id}}" tabindex="-1" role="dialog">
          <div class="modal-dialog">
             <div class="modal-content">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit" style="color:#E08E0B"></i>{{ $courierName->name }}</h4>
                 </div>              
            <div class="modal-body">
               <div class="box-body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped table-responsive ">
                        <tr>
                           <td class="collectionSampleList">Courier name</td>
                           <td class="collectionSampleList"><label>{{ $courierName->name }}</label></td>

                           <td class="collectionSampleList">Collected date</td>
                           <td class="collectionSampleList"><label>{{$data->collected_date}}</label></td>

                        </tr>
                        <tr> 
                           <td class="collectionSampleList">Box-QTY</td>
                           <td class="collectionSampleList"><label>{{$data->box_qty}}</label></td>

                           <td class="collectionSampleList">Bus numbe</td>
                           <td class="collectionSampleList"><label>{{$data->bus_number}}</label></td>
                               
                         </tr>

                         <tr> 
                           <td class="collectionSampleList">Supervisor name</td>
                           <td class="collectionSampleList"><label>{{$data->supervisor_name}}</label></td>

                           <td class="collectionSampleList">Sample Status</td>
                            <td>
                              @if($data->status ==1)
                              <label class="control-label label-warning collectionSampleList" style="padding: 0px 15px; border-radius: 3px;">In Transit</label>
                              @elseif($data->status==2)
                                <label class="control-label label-info collectionSampleList" style="padding: 0px 9px; border-radius: 3px;">Arrived</label>

                              @elseif($data->status==3)
                                <label class="control-label label-primary collectionSampleList" style="padding: 0px 9px; border-radius: 3px;">Way to lab</label>  
                              @else
                                <label class="control-label label-success collectionSampleList" style="padding: 0px 9px; border-radius: 3px;">Box-recived successfully</label>
                              @endif
                            </td> 
                               
                         </tr>
                        </table>
                        <div align="center">
                          {{Form::open(array('route'=>['courier-collection.update',$data->id],'method'=>'PUT','files'=>true))}}
                          
                         @if($data->status == 1)
                           <button class="btn btn-warning confirm" style="border: none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="2" confirm="Are you want to change the sample status?">Arrive</button> 
                         @endif
                         @if($data->status == 2)
                           <button class="btn btn-info confirm" style="border: none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="3" confirm="Are you want to change the sample status?">Way to lab</button> 
                         @endif
                         @if($data->status == 3)
                           <button class="btn btn-primary confirm" style="border: none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="4" confirm="Are you want to change the sample status?">Box recieve</button> 
                         @endif
                        
                         
                          {!! Form::close() !!}   
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>{{--End model--}}








                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>




            {{--add model are here--}}
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content" style="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-plus-square" style="color: green"></i>Add New Logistic</h4>
                        </div>
                        {!! Form::open(array('route' => ['logistic.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
                        <div class="modal-body">
                            <div class="form-group">
                                 <div class="col-md-12">
                                     <label class="required font-weight-bold text-dark text-2">Courier Type</label>
                                     <select name="courier_type" class="form-control">
                                        <option value="">Select courier type</option>
                                         <option value="1">Bus</option>
                                        <option value="2">Courier</option>    
                                     </select>
                                   </div>
                                <div class="col-md-6">
                                    <label for="user_type">Name:</label>
                                    <input type="text" class="form-control"  value="" name="name" placeholder="Enter courier Name" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="user_type">Branch:</label>
                                    <input type="text" class="form-control"  value="" name="branch_name" placeholder="Enter branch name" required>
                                </div>
                                 <div class="col-md-6">
                                    <label for="user_type">Email:</label>
                                    <input type="text" class="form-control"  value="" name="email" placeholder="Enter email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="user_type">Phone:</label>
                                    <input type="text" class="form-control"  value="" name="phone" placeholder="Enter phone" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="user_type">Address:</label>
                                    <input type="text" class="form-control" value="" name="address" placeholder="Enter address" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="user_type">Commision:</label>
                                    <input type="text" class="form-control"  value="" name="courier_commision" placeholder="Enter courier commision" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="newPassAdmin">New Password:</label>
                                     <input type="password" class="form-control" id="PassAdmin" value="" name="password" placeholder="given new password" required>
                                 </div>
                                 <div class="col-md-6">
                                    <label for="confirmPassAdmin">Confirm Password:</label>
                                     <input type="password" class="form-control" id="confirmPass" value="" name="confirm_password" placeholder="confirm password" required>
                                     <span id="confirmMsg1"></span>      
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

@section('scripts')

<script type="text/javascript"> 
     $('#confirmPassAdmin').on('keyup', function () {
                if($('#oldPasswordAdmin').val()!=''){
                  if ($('#newPassAdmin').val() == $('#confirmPassAdmin').val()) {
                    $('#updateBtn').prop('disabled',false);
                    $('#confirmMsg').html('Password Matched!!').css('color', 'green');
                  } else {
                    $('#updateBtn').prop('disabled',true);
                    $('#confirmMsg').html('Password Do not Matched!!').css('color', 'red');
                  }
                }else{
                    $('#updateBtn').prop('disabled',true);
                    $('#confirmMsg').html('Old password cannot empty while change password!!').css('color', 'red'); 
                }
            });
             $('#oldPasswordAdmin').on('keyup',function(){
                if($('#oldPasswordAdmin').val()!=''){
                    $('#updateBtn').prop('disabled',false);
                    $('#confirmMsg').html('');  
                }else{
                    $('#updateBtn').prop('disabled',true);
                    $('#confirmMsg').html('Old password cannot empty while change password!!').css('color', 'red');
                }
             })

            $('#updateBtn').on('submit',function(){
                if($('#oldPasswordAdmin').val()!=''){
                    if ($('#newPassAdmin').val() == $('#confirmPassAdmin').val()){
                        return true;
                    }else{
                        $('#confirmMsg').html('Password Do not Matched!!').css('color', 'red');
                    
                        return false;
                    }   
                }else{
                    $('#confirmMsg').html('Old password cannot empty while change password!!').css('color', 'red');
                }
                
            });
</script>
@endsection