<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HealthTip;
use App\User;
use Auth;
use Session;
use DB;
use Validator;
use Image;

class HealthTipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $healthTipsData = HealthTip::all();
        return view('webmodule.health.allHealthTips',compact('healthTipsData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('webmodule.health.addHealthTips');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required',
        ]);
        if ($validator->fails()) {
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) {
                $plainErrorText .= $value[0] . ". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');
        }
        $input = $request->all();

        if ($request->hasFile('photo')){
            $photo=$request->file('photo');
            $fileType=$photo->getClientOriginalExtension();
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            /*$fileName=$photo->getClientOriginalName();*/
            $upload=$photo->move('storage/app/public/uploads/healthtips', $fileName );
            $input['photo']=$fileName;
        }else{
            $input['photo'] = '';
        }
        $insert = HealthTip::create($input);
        try {
            $bug = 0;

        }catch (\Exception $e) {
            $bug = $e->getMessage();
        }
        if ($bug == 0) {
            Session::flash('flash_message', 'Health Card Uploaded Successfully done.');
            return redirect('health')->with('status_color', 'success');
        } else {
            Session::flash('flash_message', $bug);
            return redirect()->back()->with('status_color', 'danger');
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
        $healthtipData = HealthTip::findOrFail($id);
        return view('webmodule.health.addHealthTips',compact('healthtipData'));
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
        $data =HealthTip::findOrFail($id);
        $validator = Validator::make($request->all(), [
             'photo'  => 'required',  
          ]);
         if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
        $input = $request->all();
        if ($request->hasFile('photo')) {
                $photo=$request->file('photo');
                $fileType=$photo->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                /*$fileName=$photo->getClientOriginalName();*/
                $upload=$photo->move('storage/app/public/uploads/healthtips', $fileName );
                $input['photo']=$fileName;
                 $img_path='storage/app/public/uploads/healthtips'.$data['photo'];
            if($data['photo']!=null and file_exists($img_path)){
                   unlink($img_path);
                }
            }else{
            $input['photo'] = $data->photo;
        }
         $update = $data->update($input);
        try {
            $bug = 0;

        }catch (\Exception $e) {
            $bug = $e->getMessage();
        }
        if ($bug == 0) {
            Session::flash('flash_message', 'Health Card Update Successfully done.');
            return redirect('health')->with('status_color', 'success');
        } else {
            Session::flash('flash_message', $bug);
            return redirect()->back()->with('status_color', 'danger');
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
        $data = HealthTip::findOrFail($id);
        $img_path='storage/app/public/uploads/healthtips'.$data['photo'];
        if($data['photo']!=null and file_exists($img_path)){
           unlink($img_path);
        }
        $action = $data->delete();
        if($action)
        {
            Session::flash('flash_message','HealthTip Successfully Deleted.');
            return redirect('health')->with('status_color','danger');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('health')->with('status_color','danger');
        }
    }
    
}
