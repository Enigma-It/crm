<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;

class PackageController extends Controller
{

      public function singlePackageView($id){
        $packageDetail = DB::table('packages')
                ->where('id',$id)
                ->first();
          return view('webmodule.packages.singlePackageDetails',compact('packageDetail'));
    }
    

    public function index(){
        return view('webmodule.packages.add_package');
    }
    public function allPackage(){
        $package=DB::table('packages')->get();
        return view('webmodule.packages.all_package')->with('package',$package);
    }
    public function allPackageBookingList(){
        $package_booking=DB::table('package_bookings')->get();
        return view('webmodule.packages.all_package_booking')->with('package_booking',$package_booking);
    }

    public function BookingPackage(Request $request){
        $validatedData = $request->validate([
            'name' =>'required',
            'email' =>'required',
            'phone' =>'required',
            'address' =>'required',
        ]);
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $booking=DB::table('package_bookings')
              ->insert($data);
        if ($booking){
            $notification=array(
                'messege'=>'Successfully Agents Inserted',
                'alert-type'=>'success'
            );
            return Redirect()->route('home')->with($notification);
        }else{
            $notification=array(
                'messege'=>'error ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function Store(Request $request)
    {
        $validatedData = $request->validate([
            'name' =>'required',
            'description' =>'required',
            'photo' =>'required',
            'price' =>'required',
        ]);
        $data=array();
        $data['name']=$request->name;
        $data['description']=$request->description;
        $data['price']=$request->price;
        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/package/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $package=DB::table('packages')
                      ->insert($data);
                if ($package){
                    Session::flash('flash_message','Package Successfully Inserted');
                    return redirect()->route('all_package')->with('status_color','success');
                }else{
                    Session::flash('flash_message','Something Error Found.');
                    return redirect()->back()->with('status_color','danger');
                }
            }else{
                return Redirect()->back();
            }
        }else{
            return Redirect()->back();
        }
    }
    public function ViewPackage($id)
    {
        $single=DB::table('packages')
            ->where('id',$id)
            ->first();
        return view('webmodule.packages.view_package', compact('single'));
    }
    public function DeletePackage($id)
    {
        $delete=DB::table('packages')
            ->where('id',$id)
            ->first();
        $dltuser=DB::table('packages')
            ->where('id',$id)
            ->delete();
        if ($dltuser) {
            Session::flash('flash_message','Package Delete Successfully');
            return Redirect()->route('all_package')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
        }
    }

    public function EditPackage($id)
    {
        $package=DB::table('packages')->where('id',$id)->first();
        return view('webmodule.packages.edit_package', compact('package'));
    }
    public function UpdatePackage(Request $request ,$id)
    {
        $data=array();
        $data['name']=$request->name;
        $data['description']=$request->description;
        $data['price']=$request->price;
        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/package/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $img=DB::table('packages')->where('id',$id)->first();
                $image_path = $img->photo;
                $done=unlink($image_path);
                $package=DB::table('packages')->where('id',$id)->update($data);
                if ($package){
                    Session::flash('flash_message','Package Update Successfully');
                    return Redirect()->route('all_package')->with('status_color','warning');
                }else{
                    Session::flash('flash_message','Something Error Found.');
                    return redirect()->back()->with('status_color','danger');
                }
            }else{
                return Redirect()->back();
            }
        }else{
            return Redirect()->back();
        }
    }
}
