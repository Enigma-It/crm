<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Franchise;
use App\Models\FranchiseOrg;
use App\Models\FranchiseWallet;
use App\Models\WalletHistory;
use App\Models\PathologyTest;
use App\Models\DiagnosticPatient;
use App\Models\DiagnosticPatientTest;
use App\Models\DoctorAppointment;
use App\Models\Courier;
use App\Models\CourierSampleCollection;
use App\Models\Patient;
use App\Models\Organization;
use App\Models\EmptyBoxCollection;
use App\Models\Order;
use App\User;

use App\Models\SampleCollectioin;
use App\Models\SampleCollectionMaster;
use App\Models\AgentPackageSell;
use App\Library\memberShipLib;
use Session;
use Carbon\Carbon;
use DB;
use Auth;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::User()->user_type == 8){

            $data['franchiseInfo'] = Franchise::where('email',Auth::User()->email)->first();
            
            $data['franchiseOrg'] = FranchiseOrg::where('franchise_id',$data['franchiseInfo']->id)->first();

            $data['wallet_history'] = WalletHistory::where('franchise_id',Auth::User()->id)->orderBy('id','desc')->limit(5)->get();
            $data['latest_sample_order'] = DiagnosticPatient::where('created_by',Auth::User()->id)->orderBy('id','desc')->limit(5)->get();
            $data['total_amount'] = FranchiseWallet::where('franchise_id',Auth::User()->id)->first();
            $data['total_sale'] = DiagnosticPatient::where('created_by',Auth::User()->id)->sum('receive_amount');
            
            return view('dashboard.franchise-dashboard', $data);
        }

        elseif (Auth::User()->user_type == 9) {
             $data['deliveryInfo'] = User::where('email',Auth::User()->email)->first();
             $data['sample_info'] =SampleCollectionMaster::where('delivery_id',Auth::User()->id)->sum('sample_qty');
             $data['delivery_data'] = DB::table('sample_delivery')
                                        ->join('franchises','sample_delivery.franchise_id','franchises.id')
                                        ->select('franchises.name','sample_delivery.*')
                                        ->get();

            return view('dashboard.delivery-dashboard', $data);
        }

        elseif (Auth::User()->user_type == 10) {
            $data['curierInfo'] = Courier::where('email',Auth::User()->email)->first();
            $data['total_courier'] = Courier::count();
            $data['courierData'] = Courier::all();
            $data['totalCourierQty'] = CourierSampleCollection::sum('box_qty');
            $data['courierSampleCollection'] = DB::table('courier_sample_collection')
                                                 ->join('couriers','courier_sample_collection.courier_id','couriers.id')
                                                 ->select('couriers.name','courier_sample_collection.*')
                                                 ->get();                 
             return view('dashboard.counter-dashboard', $data);
        }


        else{
            $data['total_staff'] = Employee::count();
            $data['total_doctor'] = Doctor::count();
            $data['total_franchise'] = Franchise::count();
            $data['appointment'] =  DoctorAppointment::count();
            $data['courier'] =  Courier::count(); 
            $data['patient'] =  Patient::count();
            $data['order'] =  Order::count();
            $data['sample_collection'] =  SampleCollectioin::count();
            $data['empty_box_collection'] =  EmptyBoxCollection::count();
            $data['organization'] =  Organization::count();
            $data['agent_package_sell'] =  AgentPackageSell::count();
            $data['order_data'] = DB::table('orders')
                            ->join('patients','orders.patiant_id','patients.patient_id')
                            ->select('patients.patient_name','orders.*')
                            ->get();   
            $data['diagostic_list'] = DB::table('diagnostic_patient_test')
                                    ->join('pathology_test','diagnostic_patient_test.test_id','pathology_test.id')
                                    ->select('pathology_test.short_name','diagnostic_patient_test.*')
                                    ->get();
            $data['user_franchise'] = Franchise::where('agent_id',Auth::User()->id)->count();
            return view('dashboard', $data); 
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function allTable(){
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $k => $table) {
            foreach ($table as $key => $value)
                    $allData[$k]['table']=$value;

                    $allData[$k]['row']=DB::table("$value")->count();
                    
        }  
        return view('truncate',compact('allData'));
    }

    public function truncateTable($table){

        try {
            DB::statement('DELETE FROM ' . $table); 
            DB::statement('ALTER TABLE ' . $table . ' AUTO_INCREMENT = 1'); 
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->getMessage();
        }
        
        if($bug == 0){
            Session::flash('flash_message','Table Truncate Successfully');
            return redirect()->back()->with('status_color','danger');
        }else{
            Session::flash('flash_message',$bug);
            return redirect()->back()->with('status_color','danger');
        }
    }
}
