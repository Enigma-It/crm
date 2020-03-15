<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Franchise;
use App\Models\FranchiseOrg;
use App\Models\DeliveryManAssign;
use App\User;
use Session;
use Validator;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
class FranchiseAssignToDeliveryManController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allFranchise = User::where('user_type',8)->get();
        $agentUnderDeliveryMan = User::where('user_type',7)->get();
        $allDeliveryMan = User::where('user_type',9)->get();
        
        return view('delivery-section.delivery-man-assign',compact('allFranchise','agentUnderDeliveryMan','allDeliveryMan'));
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
                    'agent_id' => 'required|not_in:""',
                    'delivery_man_id' => 'required|not_in:""'
                    
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
        if(empty($request->franchise)){
            Session::flash('flash_message', 'Please get at least one franchise');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
        $input['delivery_man_id'] = $request->delivery_man_id;
        $input['agent_id'] = $request->agent_id;
        $input['franchise_id'] = implode(',', $request->franchise);
        
        try{
            $bug = 0;
            DeliveryManAssign::create($input);
        }
        catch(\Exception $e)
        {   
            
            $bug=$e->getMessage();
        }
        if($bug === 0){
            // Toastr::success('Delivery man area assign successfully', 'Title', ["positionClass" => "toast-top-center"]);
            // Toastr::success('Post added successfully :)','Success');
            Session::flash('flash_message','Diagnostic Test Successfully Added.');
            return redirect()->back()->with('status_color','success');
        }else{
            // Toastr::error($bug, 'Title', ["positionClass" => "toast-top-center"]);
            Session::flash('flash_message',$bug);
            return redirect()->back()->with('status_color','warning');
        }
        // echo "<pre>";
        // print_r(expression)

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
}
