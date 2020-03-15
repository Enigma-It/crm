@extends('layouts.layout')
@section('title', 'Deposit History')
@section('content')
    <?php
    use App\Library\pmscommon;
    use App\Library\memberShipLib;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i> Deposit History</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('recharge-money')}}">Recharge History</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('sweet::alert')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                <div class="box-header with-border" align="right">
                    <a href="#addModal" class="btn btn-success" data-toggle="modal">
                        <i class="fa fa-plus"></i> <b>Add New</b>
                    </a>
                    <a href="{{  url('recharge-money')  }}" class="btn btn-warning">
                        <i class="fa fa-refresh"></i> <b>Refresh</b>
                    </a>
                </div>
            </div>

            <div class="box-body">
               
                <div class="table-responsive">
	          	<table class="table table-bordered table-stripped">
	          		<th>Date</th>
	          		<th>Type</th>
	          		<th>Purpose</th>
	          		<th>Status</th>
	          		<th>Amount</th>
	          		<tbody>
	          			@if(isset($wallet_history))
		          			@foreach($wallet_history as $wallet)
		          			<tr>
		          				<td>{{date('d/m/Y',strtotime($wallet->date))}}</td>
		          				<td>
		          					@if($wallet->deposit_type ==1)
		          					<label class="label label-success">Cash</label>
		          					@elseif($wallet->deposit_type ==2)
		          					<label class="label label-info">Bank</label>
		          					@elseif($wallet->deposit_type ==3)
		          					<label class="label label-warning">Card</label>
		          					@else
		          					<label class="label label-primary">Others</label>
		          					@endif
		          				</td>
		          				<td>{{$wallet->deposit_purpose}}</td>
		          				<td>
		          					@if($wallet->status ==1)
		          					<strong>Deposit</strong>
		          					@else
		          					<strong>Reduction</strong>
		          					@endif
		          				</td>
		          				<td>{{$wallet->deposit_amount}} BDT</td>
		          			</tr>
		          			@endforeach
	          			@endif
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
                            <h4 class="modal-title"><i class="fa fa-money" style="color: green"></i>&nbsp;Deposit Money</h4>
                        </div>
                        {!! Form::open(array('route' => ['recharge-money.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="required font-weight-bold text-dark text-2">Deposit Amount</label>
                                    <input type="text" class="form-control" value="" name="deposit_amount" placeholder="Deposit Money" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="required font-weight-bold text-dark text-2">Deposit Date</label>
                                    <input type="date" class="form-control" value="" name="date">
                                </div>
                                
                                <div class="col-md-12">
                                    <label>Deposit Type:</label>
                                    <label class="radio-inline">
                                      <input type="radio" name="deposit_type" value="1"> By Cash
                                      
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="deposit_type" value="2"> By Bank
                                      
                                      
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="deposit_type" value="3"> By Card
                                      
                                    </label>
                                    
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