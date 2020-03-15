@extends('layouts.layout')
@section('title', 'courier sample collection list')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-users"></i>Add courier sample collection</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Courier-sample</a></li>
        </ol>
    </section>

    <style type="text/css">
        .select2-container .select2-selection--single {
            height: 32px !important;
            border-radius: 2px;
       }
       .select2-container--default .select2-selection--single .select2-selection__rendered{
            text-align: center;
            font-size: 17px;
            line-height: 33px !important;
            font-weight: bold;
       }
        .output {
            margin: 0 auto;
            padding: 1em;
        }
        .franchise_header{
            color:#ec2328;
            font-family: 'Pacifico', cursive;
            font-weight: 400;
        }
        .page-header-modern{
            padding-top: 20px;
            margin-bottom: 20px;
        }

        .register-btn{
            background: #ec2328 !important;
            color: #fff;
            font-size: 20px;
            padding: 10px 30px;
            border-radius: 9px;
        }
        .register-btn:hover{
            color: #fff;
        }
        label{
            float: left;
        }
        .upload-file-section{
            padding: 20px 10px;
            
        }
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #b9b9b9;
            color: #000;
            font-weight: bold;
        }
    </style>
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">

            <div class="box-header with-border" align="right">

                <form id="contactForm"  action="{{ route('courier-collection.store') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-row">
                         <div class="form-group col-lg-6">
                            <label class="font-weight-bold text-dark text-2">Destination Place</label>

                            <select  id="destination_place" class="form-control" name="destination_place"
                            style="width: 450px;">
                                <option value="">Select destination place</option>
                                @foreach($courierInfo  as $data)
                                <option value="{{ $data->id }}" {{($data->id == Auth::User()->user_pluck)?'selected':''}}>{{  $data->branch_name }}(<strong>{{$data->phone}}</strong>)</option>
                                @endforeach
                            </select>  

                        </div>

                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold text-dark text-2">Arriving Place</label>
                            
                             <select  id="arriving_place" class="form-control" name="arriving_place"
                            style="width: 450px;">
                                <option value="">Select arriving place</option>
                                @foreach($courierInfo  as $data)
                                <option value="{{ $data->id }}" >{{  $data->branch_name }}(<strong>{{$data->phone}}</strong>)</option>
                                @endforeach
                            </select> 
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="control-label">Supervisor name</label>
                            <input type="text" value="" data-msg-required="date of birth." maxlength="100" class="form-control" name="supervisor_name" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="control-label">Supervisor contact number</label>
                            <input type="text" value="" data-msg-required="date of birth." maxlength="100" class="form-control" name="supervisor_contact_number" required>
                        </div>


                        <div class="form-group col-lg-4">
                            <label class="control-label">Collected date</label>
                            <input type="text" value="" data-msg-required="Collected date" class="form-control wsit_datepicker" name="collected_date" required>
                        </div>

                        <div class="form-group col-lg-4">
                            <label class="control-label">Box-QTY</label>
                             <input type="number" value="" data-msg-required="Box-QTY" class="form-control" name="box_qty" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label class="control-label">Bus number</label>
                            <input type="text" value="" data-msg-required="date of birth." maxlength="100" class="form-control" name="bus_number" required>
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold text-dark text-2">Arriving Time</label>
                            <input type="time" value="" data-msg-required="Please enter arrive place." class="form-control" name="arriving_time">
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold text-dark text-2">Status</label>
                            <select class="form-control" name="status">
                                <option value="">select status</option>
                                <option value="1">On Transit</option>
                                <option value="2">Recivied</option>
                                <option value="3">Cancle</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-xs-12 col-lg-12 col-md-12 col-sm-12" align="center">
                            <input type="submit"  value="Add Courier Sample" class="btn btn-default register-btn" >
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-body">



            </div>
           </div>

        </div>
    </section>
    <script type="text/javascript">
        $("#destination_place").select2({
            allowClear:true,
            placeholder: 'For example: Shyamoli counter,Dhaka'
          });
         $("#arriving_place").select2({
            allowClear:true,
            placeholder: 'For example: Lohagra counter,Narail'
          });
              
    </script>
@endsection


