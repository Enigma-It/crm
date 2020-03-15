<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserType;
use App\Models\Order;
use App\User;
use Auth;
use Session;
use DB;
use Validator;
use Image;

class OrderApproveController extends Controller
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
    public function update(Request $request,$id)
    {
       $orderData = DB::table('orders')->where('orders.order_id',$id)->first();

       if($request->approve == 2){
        $input['order_status'] = 2;
        $orderStatus=DB::table('orders')->where('orders.order_id',$id)->update( $input);
       }else{
         $input['order_status'] = 3;
         $orderStatus=DB::table('orders')->where('orders.order_id',$id)->update( $input);
       }
       return redirect('order-list');
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
