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
                            <a href="{{route('blog')}}" class="btn btn-primary">ADD BLOG</a>
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
                                    <h3 class="panel-title">All BLOG</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <table id="datatable" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Blog Title</th>
                                                    <th>Blog Details</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                   <tbody>
                                                   @foreach($blog as $row)
                                                       <tr>
                                                           <td> {{ substr($row->blog_title,0,50) }}....</td>
                                                           <td>{{ substr($row->blog_details,0,50) }}...</td>
                                                           <td><img src="{{ $row->photo }}" style="height: 60px; width: 60px;"></td>
                                                           <td>
                                                               <a href="{{ URL::to('edit_blog/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                               <a href="{{ URL::to('delete_blog/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                                               <a href="{{ URL::to('view_blog/'.$row->id) }}" class="btn btn-sm btn-primary">View</a>
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

