@extends('layouts.layout')
@section('title', 'News List')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-list"></i>News List</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><a href="{{URL::to('News')}}">News</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                <div class="box-header with-border" align="right">
                    <a href="{{ url('news') }}" class="btn btn-success" data-toggle="modal">
                      <i class="fa fa-plus"></i> <b>Add New</b>
                    </a>
                    <a href="{{  url('all-news')  }}" class="btn btn-warning">
                      <i class="fa fa-refresh"></i> <b>Refresh</b>
                    </a>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-responsive">
                        <th>S/L</th>
                        <th>Photo</th>
                        <th>Description</th>
                        <th>Action</th>
                        <?php
                        $number = 1;
                        $numElementsPerPage = 10; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        ?>
                        <tbody id="mainList">
                        @foreach($news as $data)
                            <tr>
                                <td><label class="label label-success">{{$currentNumber++}}</label></td>

                                <td><img src="{{ $data->photo }}" style="height: 60px; width: 60px;"></td>
                                <td>{!! substr($data->description,0,50)  !!}</td>

                                <td>
                                    <div class="form-inline">
                                        <div class = "input-group">
                                            <a href="{{ route('news.edit',$data->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                                        </div>
                                        <div class="input-group">
                                            {{Form::open(array('route'=>['news.destroy',$data->id],'method'=>'DELETE'))}}
                                            <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This news?" style="padding: 1px 9px;">Delete</button>
                                            {!! Form::close() !!}
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
            <!-- /.box-footer-->
        </div>
    </section>
    <!-- /.content -->
@endsection