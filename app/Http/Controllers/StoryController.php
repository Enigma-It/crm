<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class StoryController extends Controller
{
    public function index(){
        return view('webmodule.story.add_story');
    }
    public function allStory(){
        $story=DB::table('stories')->get();
        return view('webmodule.story.all_story')->with('story',$story);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'photo' =>'required',
            'description' =>'required',
        ]);
        $data=array();
        $data['description'] = $request->description; 
        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/story/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo'] = $image_url;
                $story=DB::table('stories')
                    ->insert($data);
                if ($story){
                    Session::flash('flash_message','Story Successfully Inserted');
                    return redirect()->route('all_story')->with('status_color','success');
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
    public function ViewStory($id){
        $single=DB::table('stories')
            ->where('id',$id)
            ->first();
        return view('webmodule.story.view_story', compact('single'));
     }
    public function DeleteStory($id){

        $delete=DB::table('stories')
            ->where('id',$id)
            ->first();
        $dltuser=DB::table('stories')
            ->where('id',$id)
            ->delete();
        if ($dltuser) {
            Session::flash('flash_message','Story Delete Successfully');
            return Redirect()->route('all_story')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
        }

    }

    public function EditStory($id){

        $story=DB::table('stories')->where('id',$id)->first();
        return view('webmodule.story.edit_story', compact('story'));

    }

    public function UpdateStory(Request $request,$id){
        $data=array();
        $data['description'] = $request->description;
        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/story/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $img=DB::table('stories')->where('id',$id)->first();
                $image_path = $img->photo;
                $done=unlink($image_path);
                $package=DB::table('stories')->where('id',$id)->update($data);
                if ($package){
                    Session::flash('flash_message','Story Update Successfully');
                    return Redirect()->route('all_story')->with('status_color','warning');
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
