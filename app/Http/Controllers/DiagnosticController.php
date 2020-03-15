<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestDepartment;
use App\Models\PathologyTest;
use App\Models\DiagnosticPatient;
use App\Models\DiagnosticPatientTest;
use App\Models\Patient;
use App\Models\Configuration;
use App\Models\Doctor;
use App\Models\FranchiseWallet;
use App\Models\Franchise;
use App\Models\AgentCommision;
use App\Models\WalletHistory;
use App\Models\AgentWallet;
use App\Library\memberShipLib;
use Validator;
use DB;
use Session;
use Auth;
class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Auth::User()->id !=1){
          $data['patientList'] = DiagnosticPatient::leftJoin('doctors','diagnostic_patient.refd_by','doctors.id')->join('users','diagnostic_patient.created_by','users.id')
                        ->select('diagnostic_patient.*','doctors.first_name','doctors.last_name','doctors.specialist','doctors.educational_qualification','users.name as user_name')
                        ->where('diagnostic_patient.created_by',Auth::User()->id)
                        ->orderBy('diagnostic_patient.id','desc')
                        ->paginate(20);  
        }else{
            $data['patientList'] = DiagnosticPatient::leftJoin('doctors','diagnostic_patient.refd_by','doctors.id')->join('users','diagnostic_patient.created_by','users.id')
                        ->select('diagnostic_patient.*','doctors.first_name','doctors.last_name','doctors.specialist','doctors.educational_qualification','users.name as user_name')
                        ->orderBy('diagnostic_patient.id','desc')
                        ->paginate(20);  
        }
        
        return view('diagnostic.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['doctorList'] = Doctor::where('status',1)->orderBy('first_name','asc')->get();
        $data['configuration'] = Configuration::first();
        return view('diagnostic.add-edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchTests(Request $request)
    {
        $autocomplete = $request->get('term');
        
        $data = PathologyTest::where('test_name','LIKE', '%'.$autocomplete.'%')->orWhere('short_name','LIKE', '%'.$autocomplete.'%')->select('pathology_test.*')->get();

        foreach($data as $key=>$value){
            
            $equipmentList = json_decode($value->equipments,True);
            $deliveryDate = date('d/m/Y',strtotime($value->delivery_day. "days"));
            
            $response[]= array(
                'id'=>$value['id'],
                'label'=>$value['test_name'].'   ('.$value['total_price'].' tk)',
                'short_name'=>$value['short_name'],
                'amount'=>$value['total_price'],
                'pr_amount'=>$value['pr_price'],
                'deliveryDate'=>$deliveryDate,
                'delivery_time'=>'5:00PM'
            );
        }
        
        return Response($response);
        die();
         
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
                    'patient_name' => 'required',
                    'patient_age' => 'required',
                    'patient_phone' => 'required'
                    
                ]);

       if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
       }
       if(empty($input['test_diagnostic'])){
        Session::flash('flash_message', 'Please get at least one test');
        return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
       }
       $maxId = DiagnosticPatient::max('id');
       $patient_id = 'P'.date('y').str_pad($maxId+1, 6, '0', STR_PAD_LEFT);
       $diagnosticPatient = array();

       $diagnosticPatient['patient_name'] = $input['patient_name'];
       $diagnosticPatient['patient_age'] = $input['patient_age'];
       $diagnosticPatient['created_by'] = Auth::User()->id;
       $diagnosticPatient['patient_phone'] = $input['patient_phone'];
       $diagnosticPatient['patient_gender'] = $input['gender'];
       $diagnosticPatient['refd_by'] = $input['refd_by'];
       $diagnosticPatient['patient_id'] = $patient_id;
       $diagnosticPatient['d_patient_id'] = $input['d_patient_id'];
       $diagnosticPatient['date'] = date('Y-m-d h:i:s');
       $diagnosticPatient['total_amount'] = $input['total_amount'];
       $diagnosticPatient['discount'] = $input['discount'];
       $diagnosticPatient['discount_amount'] = $input['discount_amount'];
       $diagnosticPatient['payable_amount'] = $input['total_payable'];
       $diagnosticPatient['receive_amount'] = $input['receive_amount'];
       $diagnosticPatient['due_amount'] = $input['due_amount'];

       
       try{
            $bug = 0;
            $patient= DiagnosticPatient::create($diagnosticPatient);
            // Franchise Wallet History----------------------
            //echo "<pre>";
            if(isset($input['test_diagnostic'])){
                $diagnosticTest = array();
                $prAmount = 0.00;
                $WalletHistory = array();
                foreach($input['test_diagnostic'] as $key => $diagnostic){
                    $diagnosticTest['patient_id'] = $patient->patient_id;
                    $diagnosticTest['diagnostic_id'] = $patient->id;
                    $diagnosticTest['test_id'] = $diagnostic['test_id'];
                    $diagnosticTest['quantity'] = $diagnostic['test_qty'];
                    $diagnosticTest['test_amount'] = $diagnostic['test_amount'];
                    $diagnosticTest['test_delivery_time'] = $diagnostic['test_delivery_time'];

                    $changeDate = str_replace('/', '-', $diagnostic['test_delivery_date'] );
                    $diagnosticTest['test_delivery_date'] = date('Y-m-d', strtotime($changeDate));
                    $prAmount += $diagnostic['pr_price'];

                    $testname = PathologyTest::findOrFail($diagnostic['test_id']);
                    DiagnosticPatientTest::create($diagnosticTest);
                    
                    $WalletHistory['franchise_id'] = Auth::User()->id;
                    $WalletHistory['deposit_amount'] = $diagnostic['pr_price'];
                    $WalletHistory['deposit_purpose'] = $testname->test_name;
                    $WalletHistory['deposit_type'] = 4;
                    $WalletHistory['status'] = 2;
                    $WalletHistory['date'] = date('Y-m-d');
                    WalletHistory::create($WalletHistory);
                   //print_r($diagnostic);
                }
            }
            $wallet = array();
            
            
            $findFranchise = Franchise::findOrFail(Auth::User()->user_pluck);
            if(isset($findFranchise)){
                if($findFranchise->agent_id !=null){
                    $findAgent = AgentCommision::where('agent_id',$findFranchise->agent_id)->first();
                    
                    if(!empty($findAgent)){
                        $agentWalletData = AgentWallet::where('agent_id',$findAgent->agent_id)->first();
                        $agentWallet = array();
                        if(isset($agentWalletData)){
                            $agentCom = ($prAmount * $findAgent->commision)/100;
                            $agentWallet['wallet'] = $agentCom + $agentWalletData->wallet;
                            $agentWallet['commission'] = $findAgent->commision;
                            $agentWalletData->update($agentWallet);
                        }else{
                          $agentWallet['wallet'] = ($prAmount * $findAgent->commision)/100;
                          $agentWallet['commission'] = $findAgent->commision;
                          $agentWallet['agent_id'] = $findAgent->agent_id;  

                          AgentWallet::create($agentWallet);
                        }
                        
                       

                    }
                     
                }
            }else{

            }
            $checkWalletUser = FranchiseWallet::where('franchise_id',Auth::User()->id)->first();
            if(isset($checkWalletUser)){
                $wallet['total_wallet'] = $checkWalletUser->total_wallet - $prAmount;
                $checkWalletUser->update($wallet);    
            }else{
               $wallet['total_wallet'] = $prAmount; 
               $wallet['franchise_id'] = Auth::User()->id; 
               FranchiseWallet::create($wallet);
            }
           
       }
       catch(\Exception $e)
        {   
            
            $bug=$e->getMessage();
        }
       if($bug==0){
            if(isset($_POST['save_print_btn'])){
                Session::flash('flash_message','Diagnostic Test Successfully Added.');
                return redirect('diagnostic-invoice-print/'.$patient->id)->with('status_color','warning'); 

            }else{
                
               Session::flash('flash_message','Diagnostic Test Successfully Added.');
                return redirect('diagnostic')->with('status_color','success'); 
            }
            
        }else{
            Session::flash('flash_message',$bug);
            return redirect()->route('diagnostic.create')->with('status_color','danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function diagnosticInvoice($patientId){

        
        $data['patientInfo'] = DiagnosticPatient::leftJoin('doctors','diagnostic_patient.refd_by','doctors.id')
                        ->select('diagnostic_patient.*','doctors.first_name','doctors.last_name','doctors.specialist','doctors.educational_qualification')
                        ->findOrFail($patientId);

        $data['patientTest'] = DiagnosticPatientTest::join('pathology_test','diagnostic_patient_test.test_id','pathology_test.id')
                                ->join('test_department','pathology_test.test_dept_id','test_department.id')
                                ->select('diagnostic_patient_test.*','pathology_test.test_name','pathology_test.short_name','test_department.name as department')
                                ->where('diagnostic_patient_test.diagnostic_id',$data['patientInfo']->id)
                                ->orderBy('diagnostic_patient_test.id','asc')
                                ->get();
        

        $data['configuration'] = Configuration::first();
        return view('diagnostic.print-invoice',$data);
        
    }
    public function searchDoctorList(Request $request)
    {
        $autocomplete = $request->get('term');

        $data = Doctor::where('first_name','LIKE', '%'.$autocomplete.'%')
                        ->orWhere('last_name','LIKE', '%'.$autocomplete.'%')
                        ->get();
        $getJson = json_decode(json_encode($data),True);
        if(isset($getJson) && !empty($getJson)){
          foreach($data as $key=>$value){
                $response[]= array(
                    'id'=>$value['id'],
                    'label'=>$value['first_name'].' '.$value['last_name'].','.$value['specialist'].','.$value['educational_qualification'],
                    'name'=>$value['customer_name'],
                    'phone'=>$value['customer_phn'],
                    'email'=>$value['customer_email'],
                    'present_address'=>$value['customer_address'],
                );
            }  
        }
        
         echo json_encode($response);
         die();
    }
    public function searchPatientDiagnostic(Request $request){
        $autocomplete = $request->patient_id;
        $data['patientList'] = DiagnosticPatient::leftJoin('doctors','diagnostic_patient.refd_by','doctors.id')
                                ->select('diagnostic_patient.*','doctors.first_name','doctors.last_name','doctors.specialist','doctors.educational_qualification')
                                ->where('diagnostic_patient.patient_id','LIKE', '%'.$autocomplete.'%')
                                ->orderBy('diagnostic_patient.id','desc')
                                ->paginate(20);
        $data['autocomplete'] = $autocomplete;
        return view('diagnostic.index', $data);
    }

    public function changeDeliveryStatus(Request $request){
        $diagnosticData = DiagnosticPatientTest::findOrFail($request->id);
        $input['progress_status'] = 3;
        try{
            $bug = 0;
            $diagnosticData->update($input);
        }
        catch(\Exception $e){   
            $bug=$e->getMessage();
        }

       if($bug==0){
            $responseArr = array('result'=>true);
        }else{
            $responseArr = array('result'=>false);
        }
        return Response($responseArr);
    }
    public function searchPatientList(Request $request)
    {
        $autocomplete = $request->get('term');

        $data = Patient::where('patient_name','LIKE', '%'.$autocomplete.'%')
                        ->orWhere('patient_id','LIKE', '%'.$autocomplete.'%')
                        ->get();
        $getJson = json_decode(json_encode($data),True);
        if(isset($getJson) && !empty($getJson)){
          foreach($data as $key=>$value){
                $response[]= array(
                    'id'=>$value['id'],
                    'patient_id'=>$value['patient_id'],
                    'label'=>$value['patient_name'].' ('.$value['patient_id'].')',
                    'p_name'=>$value['patient_name'],
                    'p_phone'=>$value['phone_no'],
                    'p_gender'=>$value['gender'],
                    'age_year'=>$value['age_year'],
                );
            }  
        }
        
         echo json_encode($response);
         die();
    }
}
