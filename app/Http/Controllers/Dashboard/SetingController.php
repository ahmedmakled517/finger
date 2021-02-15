<?php

namespace App\Http\Controllers\Dashboard;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SetingController extends Controller
{
    // public function index(){
    //     $setting= Setting::all();
    //     return view("dashboard.setting.index",compact("setting"));
    // }
    public function create(){
      $setting= Setting::where("id",1)->first();
      if ($setting) {
        $arr=  explode(',' ,$setting->weekly_free);
      return view('dashboard.setting.create',compact('setting',"arr"));
      }else{
        $row= new Setting;
        $row->discount=0;
        $row->additional=0;
        $row->weekly_free='1,2';
        $row->save();
        $setting= Setting::where("id",1)->first();
        $arr=  explode(',' ,$setting->weekly_free);
        return view('dashboard.setting.create',compact('setting',"arr"));
      }
      
    }
    public function store(Request $request){
        $request->validate([
            "discount"=>'required',
            "additional"=>'required',
            "weekly_free"=>'required',
        ]);
        $ddd=implode(  ',',$request->weekly_free);

        $row= new Setting;
        $row->discount=$request->discount;
        $row->additional=$request->additional;
        $row->weekly_free=$ddd;
       
        $row->save();
        session()->flash('success',__('added successfuly'));
        return redirect()->route('dashboard.setting');

      }

      public function edit($id)
      {
          $setting=  Setting::findOrFail($id);
        $arr=  explode(',' ,$setting->weekly_free);
        
          return view('dashboard.setting.edit',compact('setting','arr'));
      }


      public function update(Request $request, $id)
      {
        $request->validate([
            "discount"=>'required',
            "additional"=>'required',
            "weekly_free"=>'required',
        ]);
        $dd=implode(  ',',$request->weekly_free);

        $row=  Setting::findOrFail($id);
        $row->discount=$request->discount;
        $row->additional=$request->additional;
        $row->weekly_free=$dd;
       
        $row->save();
        session()->flash('success',__('added successfuly'));
        return redirect()->route('dashboard.setting_create');
      }

     
  


}
