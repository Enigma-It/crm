<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class ServiceController extends Controller
{
     public function singleServiceView($id){   
        $serviceDetail = DB::table('services')
                ->where('id',$id)
                ->first();
         $testDetails =DB::table('pathology_test')->get();                   
          return view('webmodule.service.singleServiceDetails', compact('serviceDetail','testDetails'));    
         }

    public function index(){
        return view('webmodule.add_service');
    }
    public function allService(){
        $services=DB::table('services')->get();
        return view('webmodule.all_service')->with('services',$services);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' =>'required',
            'description' =>'required',
            'photo' =>'required',
        ]);
        $data=array();
        $data['name']=$request->name;
        $data['description']=$request->description;
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
                $service=DB::table('services')
                      ->insert($data);
                if ($service){
                    Session::flash('flash_message','Service Successfully Inserted');
                    return redirect()->route('all_service')->with('status_color','success');
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

    public function ViewService($id){
        $single=DB::table('services')
            ->where('id',$id)
            ->first();
        return view('webmodule.view_service',compact('single'));
    }

    public function DeleteService($id){
        $delete=DB::table('services')
            ->where('id',$id)
            ->first();
        $dltuser=DB::table('services')
            ->where('id',$id)
            ->delete();
        if ($dltuser) {
            Session::flash('flash_message','Service Delete Successfully');
            return Redirect()->route('all_service')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function EditService($id){

        $service=DB::table('services')->where('id',$id)->first();
        return view('webmodule.edit_service', compact('service'));
    }

    public function UpdateService(Request $request,$id){
        $data=array();
        $data['name']=$request->name;
        $data['description']=$request->description;
        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/service/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $img=DB::table('services')->where('id',$id)->first();
                $image_path = $img->photo;
                $done=unlink($image_path);

                $package=DB::table('services')->where('id',$id)->update($data);
                if ($package){
                    Session::flash('flash_message','Service Update Successfully');
                    return redirect()->route('all_service')->with('status_color','warning');
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
