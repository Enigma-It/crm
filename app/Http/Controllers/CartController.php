<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Auth;
use Route;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function AddCart(Request $request){
        if(!empty($request->test_id)){
            $test_id = $request->test_id;
            $test_info=DB::table('pathology_test')
                        ->where('id',$test_id)
                        ->first();
            $data['quantity']=$request->quantity;
            $data['id']=$test_id;
            $data['name']=$test_info->test_name;
            $data['price']=$test_info->total_price;
            $data['total']=$data['quantity'] * $data['price'];
            $data['attributes']['item_type'] = 'test';
            

        }else{
            $qty=$request->qty;
            $package_id=$request->package_id;
            $package_info=DB::table('packages')
                            ->where('id',$package_id)
                            ->first();
            $data['quantity']=$qty; 
            $data['id']= $package_info->id;
            $data['name']=$package_info->name;
            $data['price']=$package_info->price;
            $data['total']=$data['quantity'] * $data['price'];
            $data['attributes']['item_type']='package';
        }
        Cart::add($data);
        return redirect()->back();
    }
 
    public function viewCart(){
        return view('webmodule.cart.show-cart');
    }
    public function RemoveCart($id){
        Cart::remove($id);
        return redirect()->back();
    }
    public function increaseQty($id,$qty){
        $getData = Cart::get($id);
        $getData->quantity = $getData->quantity + 1;
        Cart::update($id, $getData);
        return redirect('order-page');
    }

    public function decreaseQty($id,$qty){
        $getData = Cart::get($id);
        $getData->quantity = $getData->quantity - 1;
        if($getData->quantity < 1){
            Cart::remove($id);
        }else{
            Cart::update($id, $getData);
        }
        return redirect('order-page');
    }


     public function showIncreaseQty($id,$qty){
        $getData = Cart::get($id);
        $getData->quantity = $getData->quantity + 1;
        Cart::update($id, $getData);
        return redirect('view-cart');
    }
    
    public function showDecreaseQty($id,$qty){
        $getData = Cart::get($id);
        $getData->quantity = $getData->quantity - 1;
        if($getData->quantity < 1){
            Cart::remove($id);
        }else{
            Cart::update($id, $getData);
        }
        return redirect('view-cart');
    }
}
