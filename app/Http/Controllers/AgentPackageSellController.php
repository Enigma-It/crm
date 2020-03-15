<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\PathologyTest;
use App\Models\HealthPackageTest;
use App\Models\HealthPackage;
use App\Models\AgentPackageSell;
use App\User;
use Validator;
use Session;
use Auth;
use DB;

class AgentPackageSellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['organization'] = Organization::all();
        return view('health-package-test.package-sell',$data);
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

    public function sellList(){
        $cardSellList = AgentPackageSell::all();
        return view('health-package-test.package-sell-list',compact('cardSellList'));
    }

    public function getPackInfo($packageId){
        

        $packageInfo = HealthPackage::where('package_type', $packageId)->first();

        $packageDetails = array();
        $getHospitalPrice = HealthPackageTest::where('package_type', $packageId)->get();
        if(isset($getHospitalPrice)){
            $packageDetails['package_price'] = $getHospitalPrice;
        }
        
        
        if(isset($packageInfo)){
            $testListId = explode(',', $packageInfo->test_id);
            $packageDetails['life_insurance'] = strip_tags(preg_replace('/[ \t]+/', ' ', $packageInfo->life_insurance));
            $packageDetails['health_insurance'] = strip_tags($packageInfo->health_insurance);
            $testName = PathologyTest::findMany($testListId);
            $testNameArr = array();
            foreach ($testName as $key => $name) {
                $testNameArr[] = $name->short_name;
            }
            $packageDetails['test_name'] = implode(',', $testNameArr);
            
        }else{
           $packageDetails['error_msg'] = 'Package not found'; 
        }

        return $packageDetails;

    }
    public function getYearlyPrice($yearlyBillId){
        if($yearlyBillId !=0){
          $getYearlyPrice = HealthPackageTest::findOrFail($yearlyBillId);
            if(isset($getYearlyPrice)){

                $yearlyPrice = $getYearlyPrice->yearly_price;
            }else{
                $yearlyPrice = 0;
            }  
        }else{
            $yearlyPrice = 0;
        }
        
        return $yearlyPrice;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'org_name' => 'required',
            'phone' => 'required|unique:health_card_sell|max:16',
            'package_type' => 'required',
        ]);

       if($validator->fails())
        {
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].".";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
        $input['org_name']= $request->org_name;
        $input['create_by']=  Auth::User()->id;
        $input['member_name']= $request->member_name;
        $input['phone']= $request->phone;
        $input['address']= $request->address;
        $input['email']= $request->email;
        $input['age']= $request->age;
        $input['sex']= $request->sex;
        $input['package_type'] =  $request->package_type;
        $input['hospital_price'] =  $request->package_total_bill;
        $input['yearly_price'] =  $request->yearly_bill;
        $input['status'] =  $request->status;
        try
        {
            $bug=0;
            $health = AgentPackageSell::create($input);
        }
        catch(\Exception $e)
        {
            $bug=$e->getMessage();
        }
        if($bug==0){
            Session::flash('flash_message','Health card  successfully selled!');
            return redirect('health-package-sell')->with('status_color','success');
        }else{
            Session::flash('flash_message',$bug);
            return redirect('health-package-sell')->with('status_color','danger');
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
        $agentCard = AgentPackageSell::findOrFail($id);
        if($request->approve == 2){
        $input['status'] = 2;
        $sampleStatus=DB::table('health_card_sell')->where('health_card_sell.id',$id)->update($input);
       }else{
         $input['status'] = 3;
         $sampleStatus=DB::table('health_card_sell')->where('health_card_sell.id',$id)->update($input);
       }
        alert()->success('Success Message', 'Card status update succesfully!!');
        return redirect('health-package-sell-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AgentPackageSell::findOrFail($id);
        try
        {
            $bug=0;
            $delete = $data->delete();
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            Session::flash('flash_message','Card Successfully Deleted !');
            return redirect('health-package-sell-list')->with('status_color','danger');

        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('health-package-sell-list')->with('status_color','danger');
        }
    }
}
