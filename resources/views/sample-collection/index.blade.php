@extends('layouts.layout')
@section('title', 'Sample collected franchise list')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i>Sample collected franchise list</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('sample-collection')}}">Franchise List</a></li>
        </ol>
    </section>
    <style type="text/css">
      .collectionlist th, .collectionlist tr td{
        font-size: 18px;
      }
      .newly-qty{
        padding: 0px 10px;
        font-size: 16px;
        background-color: green;
        color: #fff;
        font-style: italic;
        border-radius: 10px;
        
      }
    </style>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
    <div class="box-header with-border" align="right">
      @if($add_edit==true)
      <!-- <a href="#" class="btn btn-success"><i class="fa fa-plus"></i> <b>Add New</b></a>  -->
      @endif
      <a href="{{ url('sample-collection') }}" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Refresh</b></a> 
    </div>

    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-responsive collectionlist">
              
              <th>Franchise Org Name</th>
              <th>Address</th>
              <th>Pending Sample Qty</th>
              <th>Action</th>
              <?php                  
                $number = 1;
                $numElementsPerPage = 10; // How many elements per page
                $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
              ?>
          @if(isset($franchisedata))
          <tbody>
            @foreach($franchisedata as $franchise)
            <?php
              $totalSampleCount =  DB::table('sample_delivery_master')
                               ->where('sample_delivery_master.franchise_id',$franchise->id)
                               ->first(); 
                                                                           
             ?> 
             @if(isset($totalSampleCount)) 
             <?php
               $remainQty = $franchise->sample_count - $totalSampleCount->sample_qty;
              
             ?>
             @else
               <?php
                  $remainQty = 0;
                ?>
              @endif  
              <tr>
                <td>@if($remainQty!=0)<span class="newly-qty">new</span>&nbsp; @endif{{ $franchise->org_name }}</td>
                <td>{{$franchise->org_address}}</td>
                <td align="center">{{ $remainQty }}</td>
                <td>
                  <div class="form-inline">
                    @if($add_edit==true)
                    <div class="input-group">
                      <a href="{{($remainQty==0)?'':"#viewModal$franchise->id"}}" class="btn btn-warning btn-xs" data-toggle="modal" style="padding: 1px 15px;font-size:16px;" {{($remainQty==0)?'disabled':''}}>Collect Sample
                      </a>   
                    </div>
                    @endif
                    {{--start model--}}
                      <div class="modal fade" id="viewModal{{$franchise->id}}" tabindex="-1" role="dialog">
                          <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                 <div class="modal-header">
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-edit" style="color:#E08E0B"></i>{{ $franchise->org_name }}</h4>
                                    </div>
                                    {!! Form::open(array('route' => ['sample-collection.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
                                         <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                 <label for="user_type">Sample:</label><br>
                                                 
                                                  <input type="text" class="form-control" value="{{  $remainQty }}" disabled>
                                                  
                                                  </div>
                                              </div>
                                            <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="user_type">Reciving Qunatity:</label>
                                                <input type="text" class="form-control" name="sample_qty" required>
                                                <input type="hidden" name="delivery_id" value="{{ Auth::User()->id }}">
                                                <input type="hidden" name="franchise_id" value="{{ $franchise->id }}">
                                                <input type="hidden" name="sample_status" value="1">
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
                                                 {{Form::submit('Collected',array('class'=>'btn btn-danger', 'style'=>'width:100%'))}}
                                              </div>
                                             </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    {{--End model--}}

                  </div>
                </td>
              </tr>
              @endforeach
          </tbody>
          @endif
        </table>
      </div>
    </div>

    <!-- /.box-body -->
    <div class="box-footer"> </div>
    <!-- /.box-footer-->
  </div>
</section>

<!-- /.content -->
@endsection 