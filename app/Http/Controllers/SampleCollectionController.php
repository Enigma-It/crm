<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryManAssign;
use App\Models\FranchiseOrg;
use App\Models\Franchise;
use App\Models\SampleCollectioin;
use App\Models\SampleCollectionMaster;
use Auth;
use App\User;
use DB;
use Validator;

class SampleCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $franchisedata = [];
       $deliveryManInfo = DB::table('delivery_man_assign')
                         ->where('delivery_man_assign.delivery_man_id',Auth::User()->id)
                         ->first();
       if(Auth::User()->user_type == 9){
        $get_franchise_id = explode(",",$deliveryManInfo->franchise_id);
       
        foreach ($get_franchise_id as $franchise_id) {
           $userInfo = DB::table('users')
                               ->where('users.user_pluck',$franchise_id)
                               ->first();                   
           $franchise_auth =  $userInfo->id;
           if(isset($franchise_auth)){
             $countOfSample = DB::table('diagnostic_patient')
                         ->where('diagnostic_patient.created_by',$franchise_auth)
                         ->count();   

            
           $franchise_id = $userInfo->user_pluck;
           $franchiseInfo = Franchise::findOrFail($franchise_id);           
            $franchiseInfo->sample_count = $countOfSample;       
            array_push($franchisedata,$franchiseInfo);
           }
          
         }
         
         return view('sample-collection.index',compact('franchisedata'));
     }else{
        alert()->warning('Error Message', 'You are not into allow this');
        return redirect()->back();
     } 
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    public function collection_list(){

       
        $sampleList = SampleCollectioin::Join('franchise_org','sample_delivery.franchise_id','=','franchise_org.franchise_id')
                       ->select('sample_delivery.*','franchise_org.org_name as franchise_name')
                       ->get();

          return view('sample-collection.sample-collection-list',compact('sampleList'));             
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'sample_qty' => 'required',
        ]);
        if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) {
                $plainErrorText .= $value[0].".";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
        $input = $request->all();
        $input['delivery_date'] = date('Y-m-d');
        
        try
        {
          $bug=0;
          $sampleCollection = SampleCollectioin::create($input);
          $sampleCollectionMasterData =   SampleCollectionMaster::where('franchise_id',
                                            $sampleCollection->franchise_id)
                                         ->first();
          if(isset($sampleCollectionMasterData)){
             $sampleUpdateData['sample_qty'] = $sampleCollectionMasterData->sample_qty +  $request->sample_qty;
              $sampleCollectionMasterData->update($sampleUpdateData); 
          }else{
            $sampleCollection = SampleCollectionMaster::create($input);
          }

        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            alert()->success('Success Message', 'Sample collected Succesgully');
            return redirect()->back();
        }else{
            alert()->warning('Error Message', 'Somethings went wrong!!');
            return redirect()->back();
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

        $sampleData = SampleCollectioin::findOrFail($id);
        $sampleInfoData =FranchiseOrg::where('franchise_org.franchise_id',$sampleData->franchise_id)->first();
        return view('sample-collection.sample-status',compact('sampleData','sampleInfoData'));

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
        $sampleCollection = SampleCollectioin::findOrFail($id);
        if($request->approve == 2){
        $input['sample_status'] = 2;
        $sampleStatus=DB::table('sample_delivery')->where('sample_delivery.id',$id)->update($input);
       }else{
         $input['sample_status'] = 3;
         $sampleStatus=DB::table('sample_delivery')->where('sample_delivery.id',$id)->update($input);
       }
        alert()->success('Success Message', 'Sample status update succesfully!!');
        return redirect('sample-collection-list');
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
