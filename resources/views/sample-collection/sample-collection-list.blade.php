@extends('layouts.layout')
@section('title', 'Sample Collection List')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    $view = pmscommon::userWiseAccessSelection('view');
    ?>
    <style type="text/css">
      .collectionSampleList{
        font-size: 16px;
      }
    </style>
    <!-- Content Header (Page header) -->
<section class="content-header">
   <h1><i class="fa fa-list"></i>Order List</h1>
     <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><a href="#">Sample Collected List</a></li>
     </ol>
</section>
    <!-- Main content -->
<section class="content">
 @include('common.message')
 @include('sweet::alert')
 <div class="box box-success">
   <div class="box-header with-border" align="right">
      <a href="{{ URL::to('sample-collection-list') }}" class="btn btn-warning"><i class="fa fa-refresh"></i> 
        <b>Refresh</b>
      </a>
    </div>
    <div class="box-body">
      <div class="table-responsive">
         <table class="table table-bordered table-striped table-responsive">
            <th>S/L</th>
              <th>Franchise Name</th>
              <th>Sample Qty</th>
              <th>Sample Status</th>
              <th>Action</th>
                <?php
                    $number = 1;
                    $numElementsPerPage = 25; // How many elements per page
                    $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $currentNumber = ($pageNumber - 1) * $numElementsPerPage;
                ?>
              <tbody id="mainList">
                @foreach($sampleList as $data)
                <tr>
                 <td><label class="label label-warning">{{$currentNumber++}}</label></td>
                    <td><b>{{ $data->franchise_name }}</b></td>
                    <td><b>{{ $data->sample_qty }}</b></td>
                    <td>
                    @if($data->sample_status ==1)
                    <label class="control-label label-warning" style="padding: 0px 15px; border-radius: 3px;">Collectd</label>
                    @elseif($data->sample_status==2)
                    <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">In Transit</label>
                    @else
                     <label class="control-label label-success" style="padding: 0px 9px; border-radius: 3px;">Cancelled</label>
                    @endif
                    </td>
                    <td>
                      <div class="form-inline">
                        <div class="input-group">
                          <a href="#viewModal{{$data->id}}" class="btn btn-warning btn-xs" 
                            data-toggle="modal" style="padding: 1px 15px;font-size:16px;" >View
                           </a>



                                           <!-- <a href="{{route('sample-collection.show',$data->id)}}" class="btn btn-info btn-xs" style="padding: 1px 15px; margin:5px;">View</a> -->
											 <!-- <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This List?" style="padding: 1px 9px;">Delete</button> -->


             {{--start model--}}
        <div class="modal fade" id="viewModal{{$data->id}}" tabindex="-1" role="dialog">
          <div class="modal-dialog">
             <div class="modal-content">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit" style="color:#E08E0B"></i>{{ $data->franchise_name }}</h4>
                 </div>              
            <div class="modal-body">
               <div class="box-body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped table-responsive ">
                        <tr>
                           <td class="collectionSampleList">Franchise Name</td>
                           <td class="collectionSampleList"><label>{{ $data->franchise_name }}</label></td>
                        </tr>
                        <tr>   
                           <td class="collectionSampleList">Sample Quantity</td>
                           <td class="collectionSampleList"><label>{{$data->sample_qty}}</label></td>
                         </tr>
                         <tr>
                           <td class="collectionSampleList">Sample Status</td>
                            <td>
                              @if($data->sample_status ==1)
                              <label class="control-label label-primary collectionSampleList" style="padding: 0px 15px; border-radius: 3px;">Collectd</label>
                              @elseif($data->sample_status==2)
                                <label class="control-label label-success collectionSampleList" style="padding: 0px 9px; border-radius: 3px;">In Transit</label>
                              @else
                                <label class="control-label label-success collectionSampleList" style="padding: 0px 9px; border-radius: 3px;">Cancelled</label>
                              @endif
                            </td>    
                           </tr>
                        </table>
                        <div align="center">
                          {{Form::open(array('route'=>['sample-collection.update',$data->id],'method'=>'PUT','files'=>true))}}
                          @if($data->sample_status == 1 || $data->sample_status == 3)
                           <button class="btn btn-default confirm" style="background: #057522;border: none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="2" confirm="Are you want to change the sample status?">In Transit</button> 
                         @endif
                         @if($data->sample_status == 1 || $data->sample_status == 2) 
                           <button class="btn btn-default confirm" style="background:#e22020;border:none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="3" confirm="Are you want to cancel this sample?">Cancel</button> 
                           @endif
                          {!! Form::close() !!}   
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>{{--End model--}}
              </div>
            </div>
          </td>
         </tr>
         @endforeach
       </tbody>
     </table>
   </div>
 </div>
      <!-- /.box-body -->
   <div class="box-footer"> </div>
      <!--/.box-footer-->
   </div>
</section>
    <!-- /.content -->
 <script type="text/javascript">
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
 </script>
@endsection