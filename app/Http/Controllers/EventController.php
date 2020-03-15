<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class EventController extends Controller
{
    public function index(){
        return view('webmodule.event.add_event');
    }

    public function allEvent(){
        $event=DB::table('events')->get();
        return view('webmodule.event.all_event')->with('event',$event);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'description' =>'required',
            'photo' =>'required',
        ]);
        $data=array();
        $data['description']=$request->description;
        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/event/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $package=DB::table('events')
                    ->insert($data);
                if ($package){
                    Session::flash('flash_message','Event Successfully Inserted');
                    return redirect()->route('all_event')->with('status_color','success');
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

    public function ViewEvent($id){
        $single=DB::table('events')
            ->where('id',$id)
            ->first();
        return view('webmodule.event.view_event', compact('single'));
    }
    public function DeleteEvent($id){
        $delete=DB::table('events')
            ->where('id',$id)
            ->first();
        $dltuser=DB::table('events')
            ->where('id',$id)
            ->delete();
        if ($dltuser) {
            Session::flash('flash_message','Event Delete Successfully');
            return Redirect()->route('all_event')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function EditEvent($id){
        $event=DB::table('events')->where('id',$id)->first();
        return view('webmodule.event.edit_event', compact('event'));
    }
    public function UpdateEvent(Request $request,$id){
        $data=array();
        $data['description']=$request->description;
        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/event/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $img=DB::table('events')->where('id',$id)->first();
                $image_path = $img->photo;
                $done=unlink($image_path);
                $event=DB::table('events')->where('id',$id)->update($data);
                if ($event){
                    Session::flash('flash_message','Event Update Successfully');
                    return Redirect()->route('all_event')->with('status_color','warning');
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
