@extends('layouts.layout')
@section('title', "Sample Details")
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    $view = pmscommon::userWiseAccessSelection('view');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-user"></i> Sample Details of {{$sampleInfoData->org_name}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Franchise</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                
                <a href="#" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Sample Details</b></a>
            </div>

            <div class="box-body">
               
                <div class="table-responsive">
                	
                    <table class="table table-bordered table-striped table-responsive">
                    	
                    	<tr>
                    		<td>Franchise Name</td>
                    		<td><label>{{$sampleInfoData->org_name}}</label></td>
                    		<td>Sample Quantity</td>
                    		<td><label>{{$sampleData->sample_qty}}</label></td>
                    	</tr>
                    	<tr>
                    		<td>Sample Status</td>
                    		<td>
                    			@if($sampleData->sample_status ==1)
                                    <b>Collected</b>
                                @elseif($sampleData->sample_status ==2)
                                 <b>In Transit</b>
                                @elseif($sampleData->sample_status ==3)
                                 <b>Cancle</b>
                                @endif
                    		</td>	
                    	</tr>
                    </table>
                    
                    <div align="center">
                        {{Form::open(array('route'=>['sample-collection.update',$sampleData->id],'method'=>'PUT','files'=>true))}}

                        @if($sampleData->sample_status == 1 || $sampleData->sample_status == 3)
                           <button class="btn btn-default confirm" style="background: #057522;border: none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="2" confirm="Are you want to change the sample status?">In Transit</button> 
                         @endif
                         @if($sampleData->sample_status == 1 || $sampleData->sample_status == 2) 
                           <button class="btn btn-default confirm" style="background:#e22020;border:none;color: #fff;padding: 10px 30px;font-size: 18px;" name="approve" value="3" confirm="Are you want to cancel this sample?">Cancel</button> 
                           @endif
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