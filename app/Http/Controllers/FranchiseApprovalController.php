<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Franchise;
use App\Models\FranchiseOrg;
use App\Models\UserType;
use App\User;
use App\Models\FranchiseWallet;
use App\Models\WalletHistory;
use Auth;
use Session;
use DB;
use Validator;
use Image;
use Hash;
use Alert;
class FranchiseApprovalController extends Controller
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
        echo "sasfs";die;
        $input = $request->all();
        echo "<pre>";
        print_r($input);
        exit();
        $wallet = array();
        $checkWalletUser = FranchiseWallet::where('franchise_id',Auth::User()->id)->first();
            if(isset($checkWalletUser)){
                $wallet['total_wallet'] = $checkWalletUser->total_wallet + $request->deposit_amount;
                $checkWalletUser->update($wallet);    
            }else{
               $wallet['total_wallet'] = $request->deposit_amount; 
               $wallet['franchise_id'] = Auth::User()->id; 
               FranchiseWallet::create($wallet);
            }

           
            $input['deposit_purpose'] = 'General';
           
            WalletHistory::create($input);
            Alert::success('Deposit successfully done');
            return redirect()->back();
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
       
       $franchise = Franchise::findOrFail($id);
       if($request->approve ==2){
        $input['status'] = 2;
        $franchise->update($input);

        $userArr = array();
        $userArr['name'] = $franchise->name;
        $userArr['email'] = $franchise->email;
        $userArr['user_type'] = 8;
        $userArr['present_address'] = $franchise->address;
        $userArr['phone_number'] = $franchise->mobile;
        $userArr['password'] = bcrypt('pf123456');
        User::create($userArr);
        Alert::success('Franchise Successfully approved!');
        
       }else{
        $input['status'] = 3;
        $franchise->update($input);
        Alert::success('Franchise Cancelled, please review for approval!');
        
       }
        return redirect('franchise-list');
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
