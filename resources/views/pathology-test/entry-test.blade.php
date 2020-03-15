<?php  
	use App\Library\pmscommon;
	$add_edit = pmscommon::userWiseAccessSelection('add_edit');
?>
@if($add_edit==false)
	<script type="text/javascript">window.location.href = '{{url("dashboard")}}';</script>
@endif
@extends('layouts.layout')
@section('title', 'Add/Edit Pathology Test')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-user-plus"></i> Add/Edit Pathology Test</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('pathology-test')}}">Pathology Test</a></li>
    <li class="active">Add Pathology Test</li>
  </ol>
</section>
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
 	
    <div class="box-header with-border" align="right">
		@if( !empty($testData) )
			{{Form::open(array('route'=>['pathology-test.update',$testData->id],'method'=>'PUT','files'=>true))}}
			<button type="submit" class="btn btn-success submit_btn"><i class="fa fa-floppy-o"></i> <b>Update Information</b></button>
		@else
			{{Form::open(array('route'=>['pathology-test.store'],'method'=>'POST','files'=>true))}}
			<button type="submit" class="btn btn-success submit_btn"><i class="fa fa-floppy-o"></i> <b>Save Information</b></button>
		@endif &nbsp;&nbsp; 
			<a href="{{  url('pathology-test')  }}" class="btn btn-primary"><i class="fa fa-align-justify"></i> <b> View Test List</b></a> 
	</div>
   <div class="box-body">

    <div class="col-md-12">
	   <div class="panel panel-warning">
          <div class="panel-heading"><i class="fa fa-info-circle"></i> Test Information</div>
          <div class="panel-body">
          	<div class="col-md-12">
				<div class="form-group">
			      <label for="name">Test Name:</label>

			      <input type="text" name="test_name" class="form-control" value="{{isset($testData->test_name)?$testData->test_name:old('test_name')  }}" placeholder="enter test name" required >
			    </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
			      <label for="short_name">Short Form:</label>

			      <input type="text" name="short_name" class="form-control" value="{{isset($testData->short_name)?$testData->short_name:old('short_name')  }}" placeholder="Short form" >
			    </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
			      <label for="name">Test Specimen:</label>

			      <input type="text" name="specimen" class="form-control" value="{{isset($testData->specimen)?$testData->specimen:old('specimen')  }}" placeholder="optional specimen" >
			    </div>
			</div>
			
			<div class="col-md-12">
				<div class="form-group">
				<label for="designation">Test Department: </label>
				<select name="test_dept_id" class="form-control" id="designation">
		          	<option>Select Department</option>
		          	@if( !empty($testData) )
		          		@foreach($testDepartment as $department)
		          			<option value="{{$department->id}}" {{($testData->test_dept_id==$department->id) ? 'selected' : '' }}>{{$department->name}}</option>
		          		@endforeach
		          	@else
		          		@foreach($testDepartment as $department)
		          			<option value="{{$department->id}}">{{$department->name}}</option>
		          		@endforeach
		          	@endif
		         </select>
				</div>
			 </div>
			 <div class="col-md-6">
				<div class="form-group">
			      <label for="name">Franchise Price:</label>

			      <input type="text" name="fr_price" class="form-control decimal" value="{{isset($testData->fr_price)?$testData->fr_price:old('fr_price')  }}" placeholder="franchise price" onkeyup="getTotal();" id="fr_price">
			    </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
			      <label for="name">Probe Price:</label>

			      <input type="text" name="pr_price" class="form-control decimal" value="{{isset($testData->pr_price)?$testData->pr_price:old('pr_price')  }}" placeholder="probe price" onkeyup="getTotal();" id="pr_price">
			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
			      <label for="name">Total Price:</label>

			      <input type="text" name="total_price" class="form-control" value="{{isset($testData->total_price)?$testData->total_price:old('total_price')  }}" placeholder="total price" id="total_price" readonly>  
			    </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
			      <label for="delivery_day">Delivery Day:</label>

			      <input type="text" name="delivery_day" class="form-control" value="{{isset($testData->delivery_day)?$testData->delivery_day:old('delivery_day')  }}" placeholder="delivery day" id="delivery_day">  
			    </div>
			</div>
			 <div class="col-md-6">
				<div class="form-group">
				<label for="designation">Is Health Card: </label>
				@if( !empty($testData) )
					{{Form::select('is_health_card', array('1' => 'Yes', '2' => 'No'),$testData->is_health_card, ['class' => 'form-control'])}}
				@else
				<select name="is_health_card" class="form-control" id="health_card">
		          	<option>Select health card</option>
		          	<option value="1" >Yes</option>
		          	<option value="2" >No</option>
		         </select>
		         @endif
				</div>
			 </div>
			 <div class="col-md-6">
			 	<div class="form-group">
					<label for="resignDate" >Status: </label>
					@if( !empty($testData) )
						{{Form::select('status', array('1' => 'Enable', '2' => 'Disable'),$testData->status, ['class' => 'form-control'])}}
					@else
					<select name="status" class="form-control">
					<option value="">----Select Status----</option>
						<option value="1">Enable</option>
						<option value="2">Disable</option>
					</select>
					@endif
				</div>
			 </div>
          </div>
       </div>  
		
	</div>


	</div>
  	{!! Form::close() !!} 
   </div>
</section>
<script type="text/javascript">
	  
	  function getTotal(){
	  	var total_price = fr_price = pr_price = 0;
	  	//console.log(pr_price);
	  	fr_price = parseFloat($('#fr_price').val());
	  	pr_price =  parseFloat($("#pr_price").val());

	  	
	  	if(isNaN(parseFloat(fr_price))){
	  		fr_price = 0;
	  	}
	  	if(isNaN(parseFloat(pr_price))){
	  		pr_price = 0;
	  	}
	  	total_price = fr_price + pr_price;
	  	$('#total_price').val(parseFloat(total_price));
	  }

</script>
@endsection
