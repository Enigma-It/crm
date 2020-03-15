<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use DB;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        
        $data['serviceList'] = DB::table('services')->orderBy('id','desc')->limit(4)->get();
        $data['packageList'] = DB::table('packages')->orderBy('id','desc')->limit(6)->get();
        $data['doctorList'] = DB::table('doctors')->orderBy('id','desc')->limit(4)->get();
        
        $data['events'] = DB::table('events')->orderBy('id','desc')->limit(6)->get();
        $data['healthTip'] = DB::table('healthtips')->orderBy('id','desc')->limit(6)->get(); 
        $data['storyList'] = DB::table('stories')->orderBy('id','desc')->limit(6)->get();
        $data['blogList'] = DB::table('blogs')->orderBy('id','desc')->limit(6)->get();
        $data['testLists'] = DB::table('pathology_test')->orderBy('id','desc')->get();
        return view('welcome',$data);
    }

    public function singleTestView(Request $request){
        $tid = $request->test_id;
        $findTestData = DB::table('pathology_test')->join('test_department','test_department.id','pathology_test.test_dept_id')->select('pathology_test.*','test_department.name as dept_name')->where('pathology_test.id',$tid)->first();
        return view('webmodule.test.test-details',compact('findTestData')); 
    }
    public function contactUs(){
        return view('webmodule.contact-us');
    }


    public function newsPage(){
        $news = News::all();
        return view('webmodule.news-page',compact('news'));
    }


    public function franchise(){
        return view('franchise');
    }
    public function about(){
        return view('webmodule.about.about');
    }
}
