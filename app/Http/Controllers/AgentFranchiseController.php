<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Franchise;
use App\Models\FranchiseOrg;
use App\Models\Thana;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Validator;
use Image;
use Storage;
class AgentFranchiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    public function franchiseList()
    {  
        if(Auth::User()->user_type == 1 || Auth::User()->user_type == ''){
            $allFranchise = Franchise::leftJoin('users','franchises.agent_id','users.id')
                        ->select('franchises.*','users.name as agent_name')
                        ->orderBy('franchises.id','desc')->paginate(25);
        }
        else{
           $allFranchise = Franchise::leftJoin('users','franchises.agent_id','users.id')
                        ->select('franchises.*','users.name as agent_name')
                        ->where('franchises.agent_id',Auth::User()->id)
                        ->orderBy('franchises.id','desc')->paginate(25); 
        }
        
        return view('franchise.index',compact('allFranchise'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions =Division::all();
        $districts = District::all();
        $thanas = Thana::all();
        return view('franchise.add-franchise', compact( 'districts','divisions','thanas'));
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
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'organization_type' => 'required',
            'org_name' => 'required',
            'org_address' => 'required'
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

        if(Auth::check()){
            $input['agent_id'] = Auth::User()->id;
        }
    
        $insert= Franchise::create($input);
        try{
            $bug=0;

        }catch(\Exception $e){
            $bug=$e->getMessage();
        }
        if($bug == 0){
            $franchiseOrg = array();
            $franchiseOrg['franchise_id'] = $insert->id;
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

            Session::flash('flash_message','Franchise Registration Successfully done. please wait for approval');
            if(Auth::check()){
                return redirect()->back()->with('status_color','success');
            }else{
                return redirect('franchise-register')->with('status_color','success');
            }


        }else{
            Session::flash('flash_message',$bug);
            return redirect()->back()->with('status_color','danger');
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
        $franchiseData = Franchise::findOrFail($id);

        $franchiseOrgData = FranchiseOrg::where('franchise_id',$id)->get();

        return view('franchise.franchise-data',compact('franchiseData','franchiseOrgData'));
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
        $data = Franchise::findOrFail($id);
        $img_path='storage/app/public/uploads/documents/'.$data['trande_license'];
        $img_path1='storage/app/public/uploads/documents/'.$data['business_card'];

        if($data['trande_license']!=null and file_exists($img_path)){
           Storage::delete($img_path);
        }
        if($data['business_card']!=null and file_exists($img_path1)){
           Storage::delete($img_path1);
        }
        FranchiseOrg::where('franchise_id',$data->id)->delete();
        $action = $data->delete();
        if($action)
        {
            Session::flash('flash_message','Franchise Successfully Deleted.');
            return redirect('franchise-list')->with('status_color','danger');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('franchise-list')->with('status_color','danger');
        }
    }
}
