@extends('layouts.layout')
@section('content')
    <section class="content">
        @include('common.message')
        <div class="content-page">
            <div class="content">
                <div class="">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="{{ route('health.create') }}" class="btn btn-primary">ADD HEALTH TIPS</a>
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">Probe</a></li>
                                <li class="active">IT</li>
                            </ol>
                        </div>
                    </div>
                    <!-- Start Widget -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">All HEALTH TIPS</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <table id="datatable" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                   <th>Image</th>
                                                   <th>Action</th>
                                                </tr>
                                                </thead>
                                         <tbody>
                                            @foreach($healthTipsData as $row)
                                                <tr>
                                                    <td><img src="{{asset("storage/app/public/uploads/healthtips/$row->photo")}}" style="height: 60px; width: 120px;"></td>

                                                    <td>
                                                      <div class="form-inline">
                                                        <div  class="input-group">
                                                            <a href="{{ route('health.edit',$row->id) }}" class="btn btn-primary btn-xs" style="padding: 1px 15px;">Edit</a>
                                                        </div>   
                                                        <div class="input-group"> 
                                                             {{Form::open(array('route'=>['health.destroy',$row->id],'method'=>'DELETE'))}}
                                                              <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This Employee ?"  style="padding: 1px 9px;">Delete</button>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
    </section>
@endsection

