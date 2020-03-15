@extends('layouts.layout')
@section('title', 'Truncate Table')
@section('content')
<section class="content-header">
  <h1><i class="fa fa-table"></i> {{DB::getDatabaseName()}} Table List</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"> {{DB::getDatabaseName()}} Table List</li>
  </ol>
</section>
<section class="content">

  @include('common.message')

  <div class="box box-primary">
    <div class="box-body">
      
      <div class="table_scroll">
        <table class="table table-striped table-hover table-bordered center_table">
        <thead>
            <tr>
                <th>SL</th>
                <th>Table Name</th>
                <th>Data Row</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; 
        ?>
        @foreach($allData as $key => $data)
        	
            <tr>
                <td>{{$i++}}</td>
                <td>{{$data['table']}}</td>
                <td>{{$data['row']}}</td>
                <td>
                    <?php $table = $data['table']; ?>
				    {!! Form::open(array('url' =>"truncate/$table",'method'=>'GET')) !!}
				        <button type="submit" confirm="Are you sure you want to truncate this table ?" class="btn btn-danger btn-sm confirm">Truncate</button>
				    {!! Form::close() !!}
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
