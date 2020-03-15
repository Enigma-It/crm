<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PathologyTest;
use App\Models\HealthPackageTest;
use App\Models\HealthPackage;
use Exception;
use Validator;
use DB;
use Session;

class HealthPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testName = PathologyTest::where('is_health_card',1)->get();
        $package  = HealthPackageTest::all();
        $packageNameWithPrice= $package->groupBy('$package->package_type');
        return view('health-package-test.add-edit-package',compact('testName','packageNameWithPrice'));
    }

    public function getHospitalPrice($hospitalId){
        $getHospitalPrice = HealthPackageTest::where('package_type', $hospitalId)->get();
        return view('loadData.load-hospital-price', compact('getHospitalPrice'));
    }

    public function getYearlyPrice($yearlyId){
        if($yearlyId !=0){
          $getYearlyPrice = HealthPackageTest::findOrFail($yearlyId);
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
    public function show_package_list(){
        $testdata = [];
        $packageList = HealthPackage::all();
        foreach ($packageList as $packag) {
             $get_test_id = (explode(",",$packag->test_id));
        }
        foreach($get_test_id as $test) {
            $testName = PathologyTest::findOrFail($test);
            array_push($testdata, $testName);
        }
        return view('health-package-test.all-health-package-list',compact('packageList','testdata'));
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
        $validator = Validator::make($request->all(), [
            'package_type' => 'required',
            'hospital_price' => 'required',
            'yearly_price' => 'required',
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
        $input['test_id']= implode(',', $request->test_name);
        $input['package_type'] =  $request->package_type;
        $input['hospital_price'] =  $request->hospital_price;
        $input['yearly_price'] =  $request->yearly_price;
        $input['life_insurance'] =  $request->life_insurance;
        $input['health_insurance'] =  $request->health_insurance;

        try
        {
            $bug=0;
            $health = HealthPackage::create($input);
        }
        catch(\Exception $e)
        {
            echo "dfafdf";die;
            return $bug=$e->getMessage();
        }
        if($bug===0){
            Session::flash('flash_message','Health Package  Successfully Saved!');
            return redirect('health-package')->with('status_color','success');
        }else{
            Session::flash('flash_message',$bug);
            return redirect('health-package')->with('status_color','danger');
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
        $data['testName'] = PathologyTest::where('is_health_card',1)->get();
        $data['packageInfo'] = HealthPackage::findOrFail($id);
        return view('health-package-test.add-edit-package',$data);
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
}
