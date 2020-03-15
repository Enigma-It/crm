<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use Illuminate\Http\Request;
use App\Models\Franchise;
use App\Models\FranchiseOrg;
use App\Models\UserType;
use App\User;
use Auth;
use Session;
use DB;
use Validator;
use Image;
class FranchiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* return view('franchise');*/
    }

    public function franchiseRegister()
    {
        $divisions = Division::all();
        $districts = District::all();
        $thanas = Thana::all();
        return view('franchise', compact('districts', 'divisions', 'thanas'));
    }

    public function getDisctrict($dId)
    {
        $getDisctrict = District::where('division_id', $dId)->get();
        return view('loadData.load-district', compact('getDisctrict'));
    }

    public function getThana($thanaId)
    {
        $getThana = Thana::where('district_id', $thanaId)->get();
        return view('loadData.load-thana', compact('getThana'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'organization_type' => 'required',
            'org_name' => 'required',
        ]);

        if ($validator->fails()) {
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) {
                $plainErrorText .= $value[0] . ". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');
        }
        $input = $request->all();

        if ($request->hasFile('business_card')) {

            $photo=$request->file('business_card');
            $fileType=$photo->getClientOriginalExtension();
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            /*$fileName=$photo->getClientOriginalName();*/
            $upload=$photo->move('storage/app/public/uploads/documents', $fileName );
            $input['business_card']=$fileName;
        }else{
            $input['business_card'] = '';
        }
        
        if ($request->hasFile('trade_license')) {
            $photo=$request->file('trade_license');
            $fileType=$photo->getClientOriginalExtension();
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            /*$fileName=$photo->getClientOriginalName();*/
            $upload=$photo->move('storage/app/public/uploads/documents', $fileName );
            $input['trade_license']=$fileName;
        }else{
            $input['trade_license'] = '';
        }
        $input['status'] = 1;
        $input['dob'] = date('Y-m-d', strtotime($request->dob));
        if (Auth::check()) {
            $input['agent_id'] = Auth::User()->id;
        }

        $insert = Franchise::create($input);
        try {
            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->getMessage();
        }
        if ($bug == 0) {
            $franchiseOrg = array();
            $franchiseOrg['franchise_id'] = $insert->id;
            $franchiseOrg['org_name'] = $input['org_name'];
            $franchiseOrg['org_address'] = $input['org_address'];

            if(!empty($request->speciality) || !empty($request->bed) || !empty($request->daily_indoor_patient) || !empty($request->daily_outdoor_patient) || !empty($request->icu) || !empty($request->nicu) || !empty($request->ct_scan) || !empty($request->mri) || !empty($request->usg) || !empty($request->category) || !empty($request->employee)){
                $franchiseOrg['speciality'] = $request->speciality;
                
                $franchiseOrg['bed'] = $request->bed;
                $franchiseOrg['daily_indoor_patient'] = $request->daily_indoor_patient;
                $franchiseOrg['daily_outdoor_patient'] = $request->daily_outdoor_patient;
                $franchiseOrg['icu'] = $request->icu;
                $franchiseOrg['nicu'] = $request->nicu;
                $franchiseOrg['ct_scan'] = $request->ct_scan;
                $franchiseOrg['mri'] = $request->mri;
                $franchiseOrg['usg'] = $request->usg;
                $franchiseOrg['category'] = $request->category;
                $franchiseOrg['employee'] = $request->employee;
                }
                $franchiseOrg['org_name'] = $request->org_name;
                $franchiseOrg['org_address'] = $request->org_address;
            FranchiseOrg::create($franchiseOrg);
            Session::flash('flash_message', 'Franchise Registration Successfully done. please wait for approval');
            return redirect('franchise-register')->with('status_color', 'success');
        } else {
            Session::flash('flash_message', $bug);
            return redirect()->back()->with('status_color', 'danger');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
