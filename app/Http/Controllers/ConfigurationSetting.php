<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Country;
use App\Models\State;
use App\Models\Configuration;
use Validator;
use Session;
use Image;
use DB;

class ConfigurationSetting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
      $data = Configuration::first();
      return view('configuration.settings',compact('data'));
    }

    public function loadState(Request $request)
    {
        $id = $request->id;
        $state = State::where('country_id',$id)->get();
        return view('configuration.load-state',compact('state'));
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
    public function update(Request $request, $id)
    {

        $data=Configuration::findOrFail($id);
        $input=$request->all();
        if ($request->hasFile('logo')){
            $photo=$request->file('logo');
            $fileType=$photo->getClientOriginalExtension();
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            $upload = $photo->move('storage/app/public/uploads/theme_settings/',$fileName);
            $input['logo']=$fileName;  

            $img_path='storage/app/public/uploads/theme_settings/'.$data->logo;
            if($data->logo !=null and file_exists($img_path)){
               unlink($img_path);
            }
        }else{
            $input['logo'] = $data->logo;
        }
        try{
          $bug=0;
          $data->update($input);
        }catch(\Exception $e){
            $bug = $e->getMessage();
        }
        if($bug===0){
            Session::flash('flash_message','Settings Successfully Updated.');
            return redirect()->back()->with('status_color','warning');
        }else{
            Session::flash('flash_message',$bug);
            return redirect()->back()->with('status_color','danger');
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
        //
    }
}
