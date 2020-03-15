@extends('layouts.layout')
@section('content')
    <section class="content">
        @include('common.message')
        <div class="content-page">
            <div class="content">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{route('all_blog')}}" class="btn btn-primary">All BLOG</a>
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
                                <h3 class="panel-title">Add Blog</h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{ url('/insert-blog') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6">
                                        <label>Blog Title</label>
                                        <input type="text" class="form-control" name="blog_title"  placeholder="Enter Blog name" >
                                    </div>

                                    <div class="col-md-6">
                                        <label>Blog Details</label>
                                        <input type="text" class="form-control" name="blog_details"  placeholder="Enter blog detais" >
                                    </div>

                                    <div  class="col-md-6">
                                        <label for="exampleInputPassword11">Images</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Vedio Url</label>
                                        <input type="text" class="form-control" name="vedio_url"  placeholder="Enter Vedio url">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Date</label>
                                        <input type="text" class="form-control" name="date" id="datepicker"  placeholder="Enter Date" >
                                    </div>

                                    <div class="col-md-12" align="center" style="margin-top: 20px;">
                                        <button class="btn btn-primary" type="submit">SUBMIT</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- content -->
        </div>
    </section>
    <script type="text/javascript">
        $( "#datepicker" ).datepicker();
    </script>
@endsection

