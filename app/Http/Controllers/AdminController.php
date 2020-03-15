<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserType;
use Validator;
use Session;
use Auth;
use Hash;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user_type']= UserType::all();
        $data['manageUser'] = User::findOrFail(Auth::User()->id);
        Session::put('title',Auth::User()->name." Information");
        return view('administration.manage-admin',$data);
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
        $data = User::findOrFail($id);
        $input = $request->all();
        $input['exist_password'] = $request->exist_password;
        $input['old_password'] = $request->old_password;
        $input['password'] = $request->password;
        if ($request->hasFile('image')) {
            $photo=$request->file('image');
            $fileType=$photo->getClientOriginalExtension();
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            /*$fileName=$photo->getClientOriginalName();*/
            $upload=$photo->move('storage/app/public/uploads/users', $fileName );
            $input['image']=$fileName;
             $img_path='storage/app/public/uploads/users/'.$data['image'];
            if($data['image']!=null and file_exists($img_path)){
                   unlink($img_path);
                }
        }else{
            $input['image'] = $data->image;
        }
        if($input['password']){
            if (Hash::check($input['exist_password'], $data->password)) {
                $input['password'] = bcrypt($input['password']);
            }else{
                Session::flash('flash_message','Old password does not match, please give correct password.');
                return redirect('manage-admin')->with('status_color','warning');
            }
        }else{
            $input['password'] = $input['old_password'];
        }
        $data->update($input);
        Session::flash('flash_message','Admin Information Successfully Updated.');
        return redirect('manage-admin')->with('status_color','success');
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
