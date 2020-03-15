<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\News;
use Session;
use Validator;

class NewsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('news.index');
    }

    public function all_news(){
        $news = News::all();
        return view('news.all-news',compact('news'));
  
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
            $upload_path='public/news/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo'] = $image_url;
                $story=DB::table('news')
                    ->insert($data);
                if ($story){
                    Session::flash('flash_message','News Successfully Inserted');
                    return redirect('news')->with('status_color','success');
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

    /**
     * Display the specified.
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
        $news = News::findOrFail($id);
        return view('news.index',compact('news'));
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
        $data=array();
        $data['description'] = $request->description;
        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/news/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $img=DB::table('news')->where('id',$id)->first();
                $image_path = $img->photo;
                $done=unlink($image_path);
                $package=DB::table('news')->where('id',$id)->update($data);
                if ($package){
                    Session::flash('flash_message','News Update Successfully');
                    return Redirect('all-news')->with('status_color','warning');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = News::findOrFail($id);
        try
        {
            $bug=0;
            $delete = $data->delete();
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            Session::flash('flash_message','News Successfully Deleted !');
            return redirect('news')->with('status_color','danger');

        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('news')->with('status_color','danger');
        }
    }
}
