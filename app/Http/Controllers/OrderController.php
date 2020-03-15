<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Auth;
use App\Models\Patient;
use App\Models\Order;
use App\Models\Orderdetails;
use Validator;
use DB;

class OrderController extends Controller
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

    public function showOrderDetails($id){       
        /*$orderDetailsData = Order::findOrFail($id);*/
          $items = DB::table('order_details') 
                     ->where('order_details.order_id',$id) 
                     ->get(); 

          $orderDetails =  DB::table('orders') 
                     ->where('orders.order_id',$id) 
                     ->first();          
                
        return view('webmodule.login.orderDetailsReport',compact('items','orderDetails'));
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

     $contents=Cart::getContent();
     $jsonContent = json_decode($contents);

     if(empty($jsonContent)){
            alert()->warning('Error Message', 'Card Is Empty.Please add item in the cart!');
            return redirect()->back();
      }

     $validator = Validator::make($request->all(), [
          'is_home_collection' => 'required',
           'pay_type_value' => 'required'
         ]);
        if($validator->fails())
        {
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].".";
            }
            alert()->warning('Warning Message','Pay Type and Collection type is require');
            return redirect()->back();
        }
        
        $contents=Cart::getContent();
           $patiant_id = DB::table('patients')
                        ->select('patients.patient_id')
                        ->where('patients.email',Auth::User()->email) 
                        ->first();
            $orderArr = array();
            $orderArr['patiant_id']=$patiant_id->patient_id;
            $maxId = Order::max('id');
            $orderArr['order_id'] = 'PBO'.date('y').date('m').str_pad($maxId+1, 4,'0',
                STR_PAD_LEFT);
            $orderArr['order_date']=date("Y.m.d");
            $orderArr['order_status']=1;
            if( $request->is_home_collection == 1){
                 $orderArr['collection_fees']=300;
            }else{
                 $orderArr['collection_fees']=0;
            }
            $orderArr['total']=Cart::getTotal() + $orderArr['collection_fees'];
            $pay_type = $request->pay_type_value;
            if($pay_type == 0){
                $orderArr['pay_type']=0;
            }else{
                $orderArr['pay_type']=1;  
            }
            $is_home = $request->is_home_collection;
            if($is_home == 0){
                $orderArr['is_home_collection']=$is_home;
                $orderArr['shipping_name']=Auth::User()->name; 
                $orderArr['shipping_phone']=Auth::User()->phone_number; 
                $orderArr['shipping_address']=Auth::User()->present_address; 
            }else{
                $orderArr['is_home_collection']=$is_home;
                $orderArr['shipping_name']=$request->shipping_name; 
                $orderArr['shipping_phone']=$request->shipping_phone; 
                $orderArr['shipping_address']=$request->shipping_address; 
                $orderArr['apt_date']=$request->apt_date; 
                $orderArr['apt_from_time']=$request->apt_from_time; 
                $orderArr['apt_to_time']=$request->apt_to_time; 
            }
            $insert= Order::create($orderArr);  

        try{
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->getMessage();
        }
        if($bug==0){
          foreach($contents as $order_content){
           $OrderDetailsArry = array();
           $OrderDetailsArry['order_id']= $insert->order_id;
           $OrderDetailsArry['item_id']= $order_content->id; 
           $OrderDetailsArry['item_type']= $order_content->attributes->item_type; 
           $OrderDetailsArry['quantity']=$order_content->quantity;
           $OrderDetailsArry['unit_cost']=$order_content->price;
           $OrderDetailsArry['total']=Cart::getTotal();
           Orderdetails::create($OrderDetailsArry);
           Cart::clear();  
        }
        alert()->success('Success Message', 'Order Successfully Done');
        return redirect('/')->with('status_color','success');
      }else{
            alert()->warning('Warning Message', 'Somethings Error');
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
        $orderDetails = DB::table('orders')
                         ->join('order_details','orders.order_id','order_details.order_id')
                         ->join('patients','orders.patiant_id','patients.patient_id')
                         ->select('orders.order_id','orders.order_date','orders.pay_type','orders.total','order_details.item_type','order_details.item_id',
                            'orders.order_status','patients.*')
                         ->where('orders.order_id',$id)
                         ->first();       
        
        if($orderDetails->item_type == "package"){
           $orderListData =  DB::table('packages')->where('packages.id',$orderDetails->item_id)->first();
         }else{
             $orderListData =  DB::table('pathology_test')->where('pathology_test.id',$orderDetails->item_id)->first();
         } 
      return view('webmodule.order.orderDetails',compact('orderDetails','orderListData'));
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
        $adminOrderList = DB::table('orders')
                ->join('order_details','orders.order_id','order_details.order_id')
                ->where('orders.order_id',$id)
                ->delete();
        if($adminOrderList){
            alert()->success('Success Message', 'Order Successfully Delete');
            return redirect('order-list')->with('status_color','danger');
        }else{
            alert()->warning('Warning Message','Somethings Error');
            return redirect('order-list')->with('status_color','danger');
        }               
                 
    }

    public function adminOrderList(){ 

        $adminOrderList=DB::table('patients')
                ->join('orders','patients.patient_id','orders.patiant_id')
                ->join('order_details','orders.order_id','order_details.order_id')
                ->select('patients.patient_name','patients.patient_id','patients.phone_no','orders.order_id','orders.order_date','orders.order_status','orders.total')
                ->get(); 
         return view('webmodule.order.adminOrderList',compact('adminOrderList'));   
              
      }
}
