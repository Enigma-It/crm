@extends('layouts.layout')
@section('title', 'Courier List')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i>Division List</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('logistic')}}">Logistic</a></li>
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

                    <a href="{{  url('logistic')  }}" class="btn btn-warning">
                      <i class="fa fa-refresh"></i> <b>Refresh</b>
                    </a>
                </div>
            </div>



            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-responsive">
                        <th>S/L</th>
                        <th>Courier Type</th>
                        <th>Name</th>
                        <th>Branch</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Commision</th>
                        <th>Action</th>
                        <?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
                        <tbody id="mainList">
                        @foreach($Logistic as $data)
                            <tr>
                                <td><label class="label label-success">{{$currentNumber++}}</label></td>

                                <td>
                                    @if($data->courier_type ==1)
                                        <label class="control-label ">Bus</label>
                                    @else($data->courier_type==2)
                                        <label class="control-label">Courier</label>   
                                    @endif
                                </td>

                                <td>{{ $data->name }}</td>
                                <td>{{ $data->branch_name }}</td>
                                <td>{{ $data->address }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->courier_commision }}</td>
                                <td>
                                    <div class="form-inline">
                                        <div class = "input-group">
                                            <a href="#editModal{{$data->id}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                                        </div>

                                         <div class = "input-group">
                                            <a href="#changeModal{{$data->id}}" class="btn btn-warning btn-xs" data-toggle="modal" style="padding: 1px 15px;">Change password</a>
                                         </div>


                                        <div class="input-group">
                                            {{Form::open(array('route'=>['logistic.destroy',$data->id],'method'=>'DELETE'))}}
                                            <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This Division?" style="padding: 1px 9px;">Delete</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div> 

                                    {{--start model--}}
                                    <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"><i class="fa fa-edit" style="color:#E08E0B"></i>Update Logistic</h4>
                                                </div>
                                                {!! Form::open(array('route' => ['logistic.update', $data->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                      <div class="col-md-12">
                                                         <label class="required font-weight-bold text-dark text-2">Courier Type</label>
                                                       <select name="courier_type" class="form-control">
                                                         <option value="">Select courier type</option>
                                                         <option value="1" {{ ($data->courier_type==1)?'selected':'' }}>Bus</option>
                                                         <option value="2" {{ ($data->courier_type==2)?'selected':'' }}>Courier</option>    
                                                      </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="user_type">Name: </label>
                                                        <input type="text" class="form-control" value="{{  $data->name  }}" name="name" placeholder="Enter courier name" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="user_type">Branch:</label>
                                                        <input type="text" class="form-control" value="{{  $data->branch_name  }}" name="branch_name" placeholder="Enter courier name" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="user_type">Address: </label>
                                                        <input type="text" class="form-control" value="{{  $data->address  }}" name="address" placeholder="Enter courier address" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="user_type">Phone: </label>
                                                        <input type="text" class="form-control" value="{{  $data->phone  }}" name="phone" placeholder="Enter courier phone" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="user_type">Email: </label>
                                                        <input type="text" class="form-control" value="{{  $data->email  }}" name="email" placeholder="Enter courier email" required>
                                                    </div>

                                                     <div class="col-md-6">
                                                        <label for="user_type">Commision: </label>
                                                        <input type="text" class="form-control" value="{{  $data->courier_commision  }}" name="commision" placeholder="Enter courier name" required>
                                                    </div>

                                        </div>
                                    </div>
                                 <br>
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
                              {{--End model--}}


                    {{--add model are here--}}
                    <div class="modal fade" id="changeModal{{ $data->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm">
                    <div class="modal-content" style="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-plus-square" style="color: green"></i>Change Password</h4>
                        </div>
                        {!! Form::open(array('url' => ['logistic-change-password'],'class'=>'form-horizontal','method'=>'post')) !!}

                        <?php
                            $user_info = DB::table('users')->where('users.user_pluck',$data->id)->first();
                        ?>
                        <div class="modal-body">
                            <div class="form-group">
                                 <input type="hidden" name="courier_id" value="{{ $data->id }}">

                         <div class="col-md-12">
                            <label for="name">Old Password:</label>
                             <input type="password" class="form-control" id="oldPasswordAdmin" value="" name="exist_password" placeholder="given old password">
                          <input type="hidden" class="form-control" id="existPass" value="{{$user_info->password}}" name="old_password" placeholder="given old password">
                        </div>

                        <div class="col-md-12">
                            <label for="newPassAdmin">New Password:</label>
                             <input type="password" class="form-control" id="newPassAdmin" value="" name="password" placeholder="given new password">
                        </div>

                        <div class="col-md-12">
                            <label for="confirmPassAdmin">Confirm Password:</label>
                             <input type="password" class="form-control" id="confirmPassAdmin" value="" name="confirm_password" placeholder="confirm password">
                            <span id="confirmMsg"></span>
                        </div>

                      </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100%">Close</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" id="updateBtn"><i class="fa fa-floppy-o"></i> <b>Update</b></button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
          {{--  end add model are here--}}


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