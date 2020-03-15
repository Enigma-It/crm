@extends('layouts.layout')
@section('title', 'Health package sell')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-users"></i>Sell Health Card</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Health package sell</a></li>
        </ol>
    </section>

    <style type="text/css">
      .test_list{
            /* background-color: #e2e2e2; */
            background: #fbe790;
            border-radius: 5px;
            border-top: 2px solid #4decb9;
            border-bottom: 2px solid #fd9696;
            width: 100%;
            text-align: center;
            font-size: 16px;
            font-weight: 300px;
            font-family: sans-serif;
            padding: 30px 0px;
            float: left;

      }
      .test_name{
        margin-top: 15px;
      }
    </style>

    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border">
                <form id="contactForm"  action="{{ route('health-package-sell.store') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                       <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                          <div class="form-group">
                            <label>Organization name</label>
                             <select class="form-control" name="org_name">
                               <option >Select organization name</option>
                               @foreach($organization as $org)
                               <option value="{{ $org->id }}">{{ $org->name }}</option>
                              @endforeach
                             </select>
                          </div>
                        </div>

                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                          <div class="form-group">
                            <label>Member name</label>
                            <input type="text" name="member_name" class="form-control">
                           </div> 
                         </div>

                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                          <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control decimal" maxlength="16">
                           </div> 
                         </div>

                          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                            <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                            </div>
                         </div>

                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                          <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control">
                           </div> 
                         </div>

                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                          <div class="form-group">
                            <label>Age</label>
                            <input type="text" name="age" class="form-control decimal" maxlength="3">
                            </div>
                         </div>


                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                          <div class="form-group">
                            <label>Sex</label>
                            <select class="form-control" name="sex">
                              <option value="1">Male</option>
                              <option value="2">Female</option>
                            </select>
                            </div>
                         </div>

                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                          <div class="form-group">
                            <label>Health card</label>
                            <select class="form-control" name="package_type" onChange="getPackageDetails()" id="packageId">
                                <option value="">Select package name</option>
                                <option value="1">Preventive health card</option>
                                <option value="2">Gold health card</option>
                                <option value="3">Platinum health card</option>
                            </select>
                           </div> 
                         </div>

                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                          <div class="form-group">
                           <label>Test List</label>
                           <div class="test_list" id="testList">
                              
                           </div>
                           </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                          <div class="form-group">
                           <label>Life insurance</label>
                            <div class='test_list' id='lifeInsurance'></div>
                           </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                          <div class="form-group">
                           <label>Health insurance</label>
                           <div class="test_list" id="healthInsurance">
                            
                           </div>
                          </div> 
                        </div>

                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                          <div class="form-group">
                            <label>Hospital bill</label>
                            <select class="form-control" name="package_total_bill" id="hospitalBill">
                                <option value="">Select package name</option>
                                
                            </select>
                           </div> 
                         </div>

                          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                            <div class="form-group">
                            <label>Yearly bill</label>
                            <input type="text" name="yearly_bill" readonly class="form-control" id="YearlyPrice">

                            <input type="hidden" name="status" value="1">
                            </div>
                         </div>



                    </div>
                  </br>
                       <div class="form-row">
                          <div class="form-group col-xs-12 col-lg-12 col-md-12 col-sm-12" align="center">
                              <input type="submit"  value="Sell Health Package" class="btn btn-success register-btn">
                          </div>
                      </div>
                </form>
             </div>
            </div>
    </section>
   <script type="text/javascript">
      function getPackageDetails(){
         var packageId = $('#packageId').val();
         
          $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                method: "GET",
                url: "load-package-data/"+packageId,
                dataType: "json",
                success: function(data){
                  if(data['error_msg']){
                    alert(data['error_msg']);
                    $('#testList').text('');
                    $('#lifeInsurance').text('');
                    $('#healthInsurance').text('');
                  }else{
                    $('#testList').html(data['test_name']);
                    $('#lifeInsurance').html( data['life_insurance']);
                    $('#healthInsurance').html(data['health_insurance']);
                     
                    
                    $.each(data['package_price'],function(index,value){
                        $('#hospitalBill')
                         .append($("<option></option>")
                                    .attr("value",value['id'])
                                    .text(value['hospital_price'])); 
                         
                          });
                  }
                  
                },
                error: function(data){
                }
            });
      }
      $('select[name=package_total_bill]').change(function() {
            var yearlyId = $(this).val();
            //$('#YearlyPrice').load('{{ URL::to('load-yearly-bill')}}/'+yearlyId);

            $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          method: "GET",
          url: "load-package-yearly-bill/"+yearlyId,
          dataType: "json",
          success: function(data){
            if(data !=0){
              $('#YearlyPrice').val(data);
              //alert($('#hospitalPrice').data('hospital-price'));
              
              $('#hospital_bill').val($('#hospitalPrice').children('option:selected').data('hospital-price'));
            }else{
              $('#YearlyPrice').val('');
              $('#hospital_bill').val(0);
            }
            
          },
          error: function(data){
          }
        });
        });
  </script>
@endsection


