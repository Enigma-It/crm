@extends('layouts.layout')
@section('title', 'Health Package list')
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
            <li class="active"><a href="{{URL::to('sample-collection')}}">Health Package List</a></li>
        </ol>
    </section>
    <style type="text/css">
      .collectionlist th, .collectionlist tr td{
        font-size: 14px;
      }
      .newly-qty{
        padding: 0px 10px;
        font-size: 14px;
        background-color: green;
        color: #fff;
        font-style: italic;
        border-radius: 10px;
      }
      .test-name{
        padding: 5px 10px;
        margin: 2px;
        background-color: #f5dcdc;
        font-size: 15px;
        float: left;
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
              
              <th>Package name</th>
              <th>Test name</th>
              <th>Life insurance</th>
              <th>Health insurance</th>
              <th>Hospital price</th>
              <th>Yearly price</th>
              <th>Action</th>
              <?php                  
                $number = 1;
                $numElementsPerPage = 10; // How many elements per page
                $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
              ?>
          @if(isset($packageList))
          <tbody>
            @foreach($packageList as $data)
              <tr>
                <td>
                   @if($data->package_type ==1)
                        <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Prevent Health Card</label>
                    @elseif($data->package_type==2)
                        <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Gold Health Card</label>
                    @else
                        <label class="control-label " style="padding: 0px 9px; border-radius: 3px;">Platinum Health Card</label>
                    @endif
                </td>

                <td style="width: 300px;">
                  @foreach($testdata as $test)
                    <span class="test-name">{{ $test->short_name}}</span>
                  @endforeach
                </td>

                <td>{!!  $data->life_insurance   !!}</td>
                <td>{!!  $data->health_insurance !!}</td>
                <td>{{   $data->hospital_price }}</td>
                <td>{{   $data->yearly_price }}</td>
                <td>
                  <div class="form-inline">
                    <!-- <div class = "input-group">
                      <a href="{{URL::to("/edit-package-list/$data->id")}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                     </div> -->
                     <div class="input-group">
                        {{Form::open(array('route'=>['health-package.destroy',$data->id],'method'=>'DELETE'))}}
                          <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This District?" style="padding: 1px 9px;">Delete</button>
                            {!! Form::close() !!}
                       </div>
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