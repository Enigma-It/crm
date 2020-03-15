<?php

namespace App\library {
 	use Auth;
 	use DB;
 	use URL;
 	use Image;
 	use Session;
 	use App\Models\Suppliers;
	use App\Models\MedicineInfo;
	use App\Models\Manufacturer;
	use App\Models\MedicineWiseVariant;
	use App\Models\PurchaseMedicine;
	use App\Models\PurchaseMedicineDtls;
	use App\Models\PurchaseMedicineVariant;
	use App\Models\MedicineExpirationBarcode;
 	use App\Models\AppointmentBooking;

	class pmscommon {
    	/*
		/ @home slider
    	*/
		public function barcode_print($purchaseId){
	        $getBarcode = MedicineExpirationBarcode::where('purchase_id',$purchaseId)->get();
	        $barcodeJsn = json_decode(json_encode($getBarcode),True);
	        if(isset($barcodeJsn) && !empty($barcodeJsn)){
	        	$barcodePrint = $barcodeJsn;
	        }else{
	        	$barcodePrint = "";
	        }
	        return $barcodePrint;

    	}

    	public static function getNumberFormat($number)
    	{
			if(session('configData')['digit_separator']=='comma'){
				$digitValue = number_format($number,2,".",",");
			}else if(session('configData')['digit_separator']=='dot'){
				$digitValue = number_format($number,2,",",".");
			}

			if(session('configData')['currency_space']==1){
				$space = " ";
			}else{
				$space = "";
			}
			
			if(session('configData')['currency_position']==0){
				$digitValue = session('configData')['currency'].$space.$digitValue;
			}else{
				$digitValue = $digitValue.$space.session('configData')['currency'];
			}

			return $digitValue;
		}

		public static function getAllControllerAction()
		{
			$controller_arr = array(
				
				"EmployeeController"=>"Employee", 
				"EmployeeDesignationController"=>"Employee Designation", 
				"EmployeeSalaryController"=>"Employee Salary", 
				
				"UserController"=>"User [ Own Information ]", 
				"UserTypeController"=>"User Type", 
				"DoctorController"=>"Doctor", 
				"AgentFranchiseController"=>"Franchise List", 
				"DivisionController"=>"Division List", 
				"DistrictController"=>"District List", 
				"ThanaController"=>"Thana List", 
				"DiagnosticController"=>"Diagnostic", 
				"DiagnosticPatientDuePayController"=>"Diagnostic Due Pay", 
				"DiagnosticTestStatusCheckController"=>"Diagnostic Test Status",  
				"TestDepartmentController"=>"Test Department",  
				"PathologyTestController"=>"Test List",  
				"FranchiseDepositController"=>"Franchise Deposit",
				"MedicalDepartmentController"=>"Doctor Department",
				"FranchiseAssignToDeliveryManController"=>"Assign Delivery Man",
				
				"ServiceController"=>"Services(Frontend)",
				"PackageController"=>"Packages(Frontend)",
				"EventController"=>"Events(Frontend)",
				"BlogController"=>"Blogs(Frontend)",
				"StoryController"=>"Story(Frontend)",
				"HealthTipsController"=>"Healthtips(Frontend)",
				"SampleCollectionController"=>"Sample Collection",
				"SampleCollectionUpdateController"=>"Sample Status Update",
				"AgentManagementController"=>"Agent Management",
				"AgentPackageSellController"=>"Package sell",
				"AreaController"=>"Area",
				"LogisticController"=>"Logistic",
				"CourierSampleCollectionController"=>"Courier Sample",
				"CentralLabController"=>"Empty Box Collection",
			);
		
			return $controller_arr;
		}


		public static function userWiseAccessSelection($display_action=false,$custom_controller_name=false)
		{
			if(Auth::user()->id != 1){

				$dbUserWiseAccessInfoArr = json_decode(Session::get('userAccessData'), true);
				//$dbUserWiseAccessInfoArr = json_decode(Auth::user()->userTypeObj->user_role, true);

				if($custom_controller_name == true){
					$controller_name = $custom_controller_name;
				}else{
					$controller_name = Session::get('currentControllerName');
				}

				// For Checking Have Any Access Or Not
				if($display_action == false){
					if(isset($dbUserWiseAccessInfoArr[$controller_name])){
						if(isset($dbUserWiseAccessInfoArr[$controller_name]['view']) || isset($dbUserWiseAccessInfoArr[$controller_name]['add_edit']) || isset($dbUserWiseAccessInfoArr[$controller_name]['delete'])){
							return true;
						}else{
							return false;
						}
					}else{
						return false;
					}
				}

				// For Checking Add / Edit Permission or Not
				if($display_action == "add_edit"){
					if(isset($dbUserWiseAccessInfoArr[$controller_name]['add_edit'])){
						return true;
					}else{
						return false;
					}
				}

				// For Checking Delete Permission or Not
				if($display_action == "delete"){
					if(isset($dbUserWiseAccessInfoArr[$controller_name]['delete'])){
						return true;
					}else{
						return false;
					}
				}				 

				// For Checking Delete Permission or Not
				if($display_action == "view"){
					if(isset($dbUserWiseAccessInfoArr[$controller_name]['view'])){
						return true;
					}else{
						return false;
					}
				}

			}else{
				return true;
			}
			
		}


		public static function DoctorAppointmentBookingCheck($date=false,$time=false, $doctorId=false)
		{
			$newDate = date('Y-m-d', strtotime($date));
			$appointmentData = AppointmentBooking::where('date', $newDate)
							   ->where('time', $time)
							   ->where('doctor_id', $doctorId)
							   ->whereIn('status', [1,2])
							   ->first();

			if(count($appointmentData) >0){
				$responseArr = array('result'=>'true', 'booking_id'=>$appointmentData->id, 'bookingData'=>$appointmentData);
			}else{
				$responseArr = array('result'=>'false', 'booking_id'=>'', 'bookingData'=>array());
			}

			return $responseArr;
		}

	}
}
?>