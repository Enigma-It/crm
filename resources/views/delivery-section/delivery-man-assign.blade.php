<?php  
  use App\Library\pmscommon;
  $add_edit = pmscommon::userWiseAccessSelection('add_edit');
?>
@if($add_edit==false)
  <script type="text/javascript">window.location.href = '{{url("dashboard")}}';</script>
@endif
@extends('layouts.layout')
@section('title', 'Delivery Man Assign')
@section('content')
<!-- <section class="content-header">
  <h1><i class="fa fa-medkit"></i> Diagnostic Tests</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('diagnostic')}}">Diagnostic List</a></li>
    <li class="active">Add Diagnostic</li>
  </ol>
</section> -->

<style type="text/css">
  .form-control {
      height: 28px;
      padding: 0px 12px;
  }
  /*.freeze-btn{
    position: fixed; 
    bottom: 0px; 
    top: 20px;
    left: 0px;
    right: 0px;
    
    z-index: 999999;
  }*/
  
</style>
<section class="content">
  @include('common.message')
  @include('common.commonFunction')

<?php 
  $btn_text = "Save Information"; $desplay_css= "none"; $date = date('m/d/Y'); 
  $btn_print_text = "Save & Print Invoice";
  $btn_name = "save_print_btn";
?>
  @if( !empty($singlePurchaseData) )
        {{Form::open(array('route'=>['diagnostic.update',$singlePurchaseData->id],'method'=>'PUT','files'=>true))}}
        <?php 
              $btn_text = "Update Information"; $desplay_css= "block"; 
              $btn_print_text = "Update & Print Invoice";
              $date = date('m/d/Y', strtotime($singlePurchaseData->invoice_date)); 
              $btn_name = "update_print_btn";
        ?>
  @else
        {{Form::open(array('route'=>['franchise-area-assign.store'],'method'=>'POST','files'=>true))}}
   @endif
  <div class="box box-success">
    <div class="box-header with-border freeze-btn" align="right" >
        <!-- <button type="submit" class="btn btn-success freeze_btn" name="{{$btn_name}}"><i class="fa fa-print"></i> <b>{{$btn_print_text}}</b></button> -->
        <button type="submit" class="btn btn-success freeze_btn"><i class="fa fa-floppy-o"></i> <b>{{$btn_text}}</b></button>
      &nbsp;&nbsp; 
        <a href="{{url('franchise-area-assign')}}" class="btn btn-primary"><i class="fa fa-align-justify"></i> <b>Delivery Man List</b></a> 
    </div>
   <div class="box-body">
    <div class="col-md-12">
     <div class="panel panel-info">
          <div class="panel-heading" style="font-size: 22px; font-weight:bold"><i class="fa fa-tasks"></i> Assign agent & franchise</div>
          <div class="panel-body">
            <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
              <div class="form-group">
                  <label for="patient_name">Assign Agent:</label>
                  <select class="form-control" name="agent_id" required>
                    <option value="">Select Agent</option>
                    @foreach($agentUnderDeliveryMan as $agent)
                      <option value="{{$agent->id}}">{{$agent->name}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
              <div class="form-group">
                  <label for="patient_name">Assign Delivery Man:</label>
                  <select class="form-control" name="delivery_man_id" required>
                    <option value="">Select Delivery Man</option>
                    @foreach($allDeliveryMan as $delivery_man)
                      <option value="{{$delivery_man->id}}">{{$delivery_man->name}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            
            <div class="col-md-12 col-xs-12 col-sm-12">
              <div class="form-group">
                <label for="refd_by" >Assign Franchise: </label>
                <div class="table-responsive">
                  <table class="table table-responsive table-bordered table-stripped">
                    <th>Organization Name</th>
                    <th>Contact Number</th>
                    @if(!empty($allFranchise))
                    @foreach($allFranchise as $franchise)
                    <tr>
                      <td>
                        <label class="checkbox-inline">
                          <input type="checkbox" class="updateMainCheckbox"  name="franchise[]" value="{{$franchise->id}}"> 
                          <strong style="text-align: center;">{{$franchise->franchiseAsUserData->org_name}}</strong>
                        </label>
                      </td>
                      <td><strong>{{$franchise->franchiseAsUserData->mobile}}</strong> 
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </table>
                </div>
              </div>
            </div>
          </div>
       </div>  
    </div>
  </div>
    {!! Form::close() !!} 
   </div>
</section>

@endsection
