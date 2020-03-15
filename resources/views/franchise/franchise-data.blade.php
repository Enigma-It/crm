@extends('layouts.layout')
@section('title', "Franchise Details of $franchiseData->name")
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    $view = pmscommon::userWiseAccessSelection('view');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-user"></i> Franchise Details of {{$franchiseData->name}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('franchise-list')}}">Franchise</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                
                <a href="{{ url('franchise-list') }}" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Franchise List</b></a>
            </div>

            <div class="box-body">
               
                <div class="table-responsive">
                	
                    <table class="table table-bordered table-striped table-responsive">
                    	<tr>
                    		<td colspan="3"></td>
                    		<td  class="pull-right">
                    			@if(!empty($franchiseData->agent_id))
                    				<h3>Franchise Owner &nbsp;&nbsp;:&nbsp;&nbsp;<b style="color: #bb3839">{{$franchiseData->agentName->name}}</b></h3>
                    			@else
                    				<h3>Franchise Owner &nbsp;&nbsp;:&nbsp;&nbsp;<b style="color: #bb3839">Franchise Self</b></h3>
                    			@endif
                    		</td>
                    	</tr>
                    	<tr>
                    		<td>Franchise Name</td>
                    		<td><label>{{$franchiseData->name}}</label></td>
                    		<td>Franchise Mobile</td>
                    		<td><label>{{$franchiseData->mobile}}</label></td>
                    	</tr>
                    	<tr>
                    		<td>Date Of Birth</td>
                    		<td><label>{{date('d/m/Y',strtotime($franchiseData->dob))}}</label></td>
                    		<td>Franchise Email</td>
                    		<td><label>{{$franchiseData->email}}</label></td>
                    	</tr>
                    	<tr>
                    		<td>Division</td>
                    		<td><label>
                    			@if(isset($franchiseData->divisionName))
                    			{{$franchiseData->divisionName->name}}
                    			@endif
                    		</label></td>
                    		<td>District</td>
                    		<td><label>
                    			@if(isset($franchiseData->districtName))
                    			{{ $franchiseData->districtName->name }}
                    	@endif</label></td>
                    			
                    	</tr>
                    	<tr>
                    		<td>Thana</td>
                    		<td><label>
                    			@if(isset($franchiseData->thanaName))
                    			{{$franchiseData->thanaName->name}}
                    			@endif
                    		</label></td>
                    		<td>address</td>
                    		<td><label>{{$franchiseData->address}}</label></td>
                    			
                    	</tr>
                    	<tr>
                    		@if($franchiseData->trade_license !=null)
                    		<td colspan="2">
                    			<label>Trade License</label>
                    			<img src='{{asset("storage/app/public/uploads/documents/$franchiseData->trade_license")}}' id="card-image" style="width: 300px;height: 250px">
                    		</td>
                    		@else
                    		<td>Trade License</td>
                    		<td>No trade license uploaded</td>
                    		@endif
                    		@if($franchiseData->business_card !=null)
                    		<td colspan="2">
                    			<label>Business License</label>
                    			<img src='{{asset("storage/app/public/uploads/documents/$franchiseData->business_card")}}' id="card-image" style="width: 300px;height: 250px;">
                    		</td>
                    		@else
                    		<td>Business Card</td>
                    		<td>No business card uploaded</td>
                    		@endif
                    	</tr>
                    	<tr>
                    		<td>Gender</td>
                    		<td>
                    			@if($franchiseData->sex ==1)
                    			<label class="label label-success" style="font-size: 15px">Male</label>
                    			@else
                    			<label class="label label-warning" style="font-size: 15px">Female</label>
                    			@endif
                    		</td>
                    		<td>Organization Type</td>
                    		<td>
                    			@if($franchiseData->organization_type ==1)
                                    <b>Hospital</b>
                                @elseif($franchiseData->organization_type ==2)
                                 <b>Clinic</b>
                                @elseif($franchiseData->organization_type ==3)
                                 <b>Diagnostic Center</b>
                                @elseif($franchiseData->organization_type ==4)
                                <b>Nursing Home</b>
                                @elseif($franchiseData->organization_type ==5)
                                <b>Doctor Chamber</b>
                                @elseif($franchiseData->organization_type ==6)
                                <b>Pharmacy</b>
                                @elseif($franchiseData->organization_type ==7)
                                <b>Others</b>
                                @endif
                    		</td>
                    			
                    	</tr>
                    </table>
                    <h2 align="center" style="color: #bb3839">Organization Information</h2>
                    <table class="table table-bordered table-striped table-responsive">
                    	@if(isset($franchiseData->organizationData))
                    	<tr>
                    		<td>Organization Name</td>
                    		<td><label>{{$franchiseData->organizationData->org_name}}</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>Organization Address</td>
                    		<td><label>{{$franchiseData->organizationData->org_address}}</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>Speciality</td>
                    		<td><label>{{$franchiseData->organizationData->speciality}}</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>Total Bed</td>
                    		<td><label>{{$franchiseData->organizationData->bed}}</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>Daily Indoor Patient</td>
                    		<td><label>{{$franchiseData->organizationData->daily_indoor_patient}}</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>Daily Outdoor Patient</td>
                    		<td><label>{{$franchiseData->organizationData->daily_outdoor_patient}}</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>ICU</td>
                    		<td><label>
                    			@if($franchiseData->organizationData->icu ==1)
                    			<i class="fa fa-check" style="font-size: 16px;color:#00a65a;"></i>
                    			@else
                    			<i class="fa fa-times" style="font-size: 16px;color:#f32527"></i>
                    			@endif
                    		</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>NICU</td>
                    		<td><label>
                    			@if($franchiseData->organizationData->nicu ==1)
                    			<i class="fa fa-check" style="font-size: 16px;color:#00a65a;"></i>
                    			@else
                    			<i class="fa fa-times" style="font-size: 16px;color:#f32527"></i>
                    			@endif
                    		</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>CT SCAN</td>
                    		<td><label>
                    			@if($franchiseData->organizationData->ct_scan ==1)
                    			<i class="fa fa-check" style="font-size: 16px;color:#00a65a;"></i>
                    			@else
                    			<i class="fa fa-times" style="font-size: 16px;color:#f32527"></i>
                    			@endif
                    		</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>MRI</td>
                    		<td><label>
                    			@if($franchiseData->organizationData->mri ==1)
                    			<i class="fa fa-check" style="font-size: 16px;color:#00a65a;"></i>
                    			@else
                    			<i class="fa fa-times" style="font-size: 16px;color:#f32527"></i>
                    			@endif
                    		</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>USG</td>
                    		<td><label>
                    			@if($franchiseData->organizationData->usg ==1)
                    			<i class="fa fa-check" style="font-size: 16px;color:#00a65a;"></i>
                    			@else
                    			<i class="fa fa-times" style="font-size: 16px;color:#f32527"></i>
                    			@endif
                    		</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>Category</td>
                    		<td><label>
                    			@if(!empty($franchiseData->organizationData->category))
                    			{{$franchiseData->organizationData->category}}
                    			@endif
                    		</label></td>
                    		
                    	</tr>
                    	<tr>
                    		<td>Employee</td>
                    		<td><label>
                    			@if(!empty($franchiseData->organizationData->employee))
                    			{{$franchiseData->organizationData->employee}}
                    			@endif
                    		</label></td>
                    		
                    	</tr>
                    	@else
                    	<tr><td><h4 align="center">No Information Here</h4></td></tr>
                    	@endif
                    </table>
                    <div align="center">
                        {{Form::open(array('route'=>['franchise-approval.update',$franchiseData->id],'method'=>'PUT','files'=>true))}}
                           <button class="btn btn-default confirm" style="background: #057522;border: none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="2" confirm="Are you want to approve this franchise?">Approve This Franchise</button> 
                           <button class="btn btn-default confirm" style="background: #e22020;border: none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="3" confirm="Are you want to cancel this franchise?">Cancel This Franchise</button> 
                           
                        {!! Form::close() !!}
                        
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"> </div>
            <!-- /.box-footer-->
        </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection