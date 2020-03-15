<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FranchiseWallet;
use App\Models\WalletHistory;
use Auth;
use Session;
use Validator;
use Alert;
class FranchiseDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallet_history = WalletHistory::where('franchise_id',Auth::User()->id)->orderBy('id','desc')->limit(5)->get();

        return view('franchise.recharge-amount',compact('wallet_history'));
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
        
        $input = $request->all();
        
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
            $input['status'] = 1;
            $input['franchise_id'] = Auth::User()->id;
           
            WalletHistory::create($input);
            Alert::success('Deposit successfully done');
            return redirect('recharge-money');
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
