@extends('layouts.layout')
@section('title', 'Health package')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-users"></i>Add health package</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Health package</a></li>
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
            /*background: #ec2328 !important;*/
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

                <form id="contactForm"  action="{{ route('health-package.store') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-row">
                         <div class="form-group col-lg-12">
                            <label class="font-weight-bold text-dark text-2">Package name</label>
                            <select class="form-control" name="package_type">
                                <option value="">Select package name</option>
                                <option value="1">Preventive health card</option>
                                <option value="2">Gold health card</option>
                                <option value="3">Platinum health card</option>
                            </select>  
                         </div>

                         <div class="form-group col-lg-6">
						 	<label>Hospital bill</label>
						 	<select id="hospitalPrice" class="form-control" name="package_id">
						 		
						 	</select>
						 	<input type="hidden" name="hospital_price" id="hospital_bill">
						 </div>
					
                        <div class="form-group col-lg-6">
						 	<label>Yearly bill</label>
						 	<input type="text" class="form-control" name="yearly_price" 
						 	id="YearlyPrice" readonly>
						 </div>

                         <div class="form-group col-md-12">
                         	<label class="" style="font-size: 16px;">
	                      		Select Package Test:
	                      	</label>
                         </div>
	                      <div class="form-group col-md-12">
	                      	
	                      	@foreach( $testName as $test)
						    	 <label class="checkbox-inline"><input type="checkbox" name="test_name[]" value="{{ $test->id }}">{{ $test->short_name }}</label>
						    @endforeach
						 </div>  
						

						 <div class="form-group col-lg-6">
						 	<label class="form-control">Life insurance</label>
						 	<textarea id="life_insurance" name="life_insurance" class="ckeditor"></textarea>
						 </div>

					    <div class="form-group col-lg-6">
						 	<label class="form-control">Health insurance</label>
						 	<textarea id="health_insurance" name="health_insurance" class="ckeditor"></textarea>
						 </div>

						
					

	                    <div class="form-row">
	                        <div class="form-group col-xs-12 col-lg-12 col-md-12 col-sm-12" align="center">
	                            <input type="submit"  value="Add Health Package" class="btn btn-success register-btn">
	                        </div>
	                    </div>

                </form>
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

         $('select[name=package_type]').change(function() {
            var hospitalId = $(this).val();

            $('#YearlyPrice').val('');
            $('#hospitalPrice').load('{{ URL::to('load-hospital-bill')}}/'+hospitalId);

        });
        $('select[name=package_id]').change(function() {
            var yearlyId = $(this).val();
            //$('#YearlyPrice').load('{{ URL::to('load-yearly-bill')}}/'+yearlyId);

            $.ajax({
		      headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		      method: "GET",
		      url: "load-yearly-bill/"+yearlyId,
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


