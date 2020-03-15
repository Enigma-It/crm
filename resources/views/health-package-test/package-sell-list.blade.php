@extends('layouts.layout')
@section('title', 'Health card sell list')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i>Health card sell list</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('logistic')}}">Health card sell list</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                <div class="box-header with-border" align="right">
                    <a href="{{ url('health-package-sell') }}" class="btn btn-success" data-toggle="modal">
                      <i class="fa fa-plus"></i> <b>Add New</b>
                    </a>                   

                    <a href="{{  url('health-package-sell-list')  }}" class="btn btn-warning">
                      <i class="fa fa-refresh"></i> <b>Refresh</b>
                    </a>
                </div>
            </div>



            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-responsive">
                        <th>S/L</th>
                        <th>Organization name</th>
                        <th>Member name</th>
                        <th>Phone</th>
                        <th>Card name</th>
                        <th>Status</th>
                        <th>Action</th>
                        <?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
                        <tbody id="mainList">
                        @foreach($cardSellList as $data)
                        <?php
                           $orgName =  DB::table('organizations')
                                              ->where('organizations.id',$data->org_name) 
                                              ->first();
                         ?>

                            <tr>
                                <td><label class="label label-success">{{$currentNumber++}}</label></td>
                                <td>{{ $orgName->name }}</td>
                                <td>{{ $data->member_name }}</td>
                                <td>{{ $data->phone }}</td>


                                <td>
                                    @if($data->package_type ==1)
                                        <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Prevent Health Card</label>
                                    @elseif($data->package_type==2)
                                        <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Gold Health Card</label>
                                    @else
                                        <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Platinum Health Card</label>
                                    @endif
                                </td>

                                <td>
                                     @if($data->status ==1)
                                   <label class="control-label label-warning" style="padding: 0px 15px; border-radius: 3px;">Pending</label>
                                    @elseif($data->status==2)
                                    <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">Approved</label>
                                    @else
                                     <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">Cancelled</label>
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
                                            {{Form::open(array('route'=>['health-package-sell.destroy',$data->id],'method'=>'DELETE'))}}
                                            <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This Division?" style="padding: 1px 16px;font-size:16px;">Delete</button>
                                            {!! Form::close() !!}
                                        </div>

                                    </div> 




        {{--start model--}}
        <div class="modal fade" id="viewModal{{$data->id}}" tabindex="-1" role="dialog">
          <div class="modal-dialog">
             <div class="modal-content">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit" style="color:#E08E0B"></i>{{ $orgName->name }}</h4>
                 </div>              
            <div class="modal-body">
               <div class="box-body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped table-responsive ">
                        <tr>
                           <td class="collectionSampleList">Organization name</td>
                           <td class="collectionSampleList"><label>{{ $orgName->name }}</label></td>

                           <td class="collectionSampleList">Member name</td>
                           <td class="collectionSampleList"><label>{{$data->member_name}}</label></td>

                        </tr>
                        <tr> 
                           <td class="collectionSampleList">Phone</td>
                           <td class="collectionSampleList"><label>{{$data->phone}}</label></td>

                           <td class="collectionSampleList">Email</td>
                           <td class="collectionSampleList"><label>{{$data->email}}</label></td>
                               
                         </tr>

                         <tr>

                           <td class="collectionSampleList">Supervisor name</td>
                            <td>
                                @if($data->package_type ==1)
                                    <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Prevent Health Card</label>
                                @elseif($data->package_type==2)
                                    <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Gold Health Card</label>
                                @else
                                    <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Platinum Health Card</label>
                                @endif
                            </td>

                           <td class="collectionSampleList">Status</td>
                            <td>
                              @if($data->status ==1)
                              <label class="control-label label-primary collectionSampleList" style="padding: 0px 15px; border-radius: 3px;">Pending</label>
                              @elseif($data->status==2)
                                <label class="control-label label-success collectionSampleList" style="padding: 0px 9px; border-radius: 3px;">Approve</label>
                              @else
                                <label class="control-label label-success collectionSampleList" style="padding: 0px 9px; border-radius: 3px;">Cancelled</label>
                              @endif
                            </td>     
                         </tr>
                        </table>
                        <div align="center">
                          {{Form::open(array('route'=>['health-package-sell.update',$data->id],'method'=>'PUT','files'=>true))}}
                          @if($data->status == 1 || $data->status == 3)
                           <button class="btn btn-default confirm" style="background: #057522;border: none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="2" confirm="Are you want to change the card status?">Approved</button> 
                         @endif
                         @if($data->status == 1 || $data->status == 2) 
                           <button class="btn btn-default confirm" style="background:#e22020;border:none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="3" confirm="Are you want to cancel this card?">Cancel</button> 
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
       <div class="box-footer"> </div>
    </div>
 </section>
@endsection




