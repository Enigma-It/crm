<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(){
        return view('webmodule.blog.add_blog');
    }
    public function allBlog(){
        $blog=DB::table('blogs')->get();
        return view('webmodule.blog.all_blog')->with('blog',$blog);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'blog_title' =>'required',
            'blog_details' =>'required',
            'photo' =>'required',
        ]);
        $data=array();
        $data['blog_title']=$request->blog_title;
        $data['blog_details']=$request->blog_details;
        $data['vedio_url']=$request->vedio_url;
        $data['status']=$request->status;
        $data['date']=date('Y-m-d',strtotime($request->date));
        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/blog/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $package=DB::table('blogs')
                    ->insert($data);
                if ($package){
                    Session::flash('flash_message','Blog Successfully Inserted');
                    return redirect()->route('all_blog')->with('status_color','success');
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
    public function ViewBlog($id){
        $single=DB::table('blogs')
            ->where('id',$id)
            ->first();
        return view('webmodule.blog.view_blog', compact('single'));
    }
    public function DeleteBlog($id){
        $delete=DB::table('blogs')
            ->where('id',$id)
            ->first();
        $dltuser=DB::table('blogs')
            ->where('id',$id)
            ->delete();
        if ($dltuser) {
            Session::flash('flash_message','Blog Delete Successfully');
            return Redirect()->route('all_blog')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
        }
    }
    public function EditBlog($id){
        $blog=DB::table('blogs')->where('id',$id)->first();
        return view('webmodule.blog.edit_blog', compact('blog'));
    }
    public function UpdateBlog(Request $request,$id){
        $data=array();
        $data['blog_title']=$request->blog_title;
        $data['blog_details']=$request->blog_details;
        $data['vedio_url']=$request->vedio_url;
        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/blog/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $img=DB::table('blogs')->where('id',$id)->first();
                $image_path = $img->photo;
                $done=unlink($image_path);
                $event=DB::table('blogs')->where('id',$id)->update($data);
                if ($event){
                    Session::flash('flash_message','Blog Update Successfully');
                    return Redirect()->route('all_blog')->with('status_color','warning');
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
