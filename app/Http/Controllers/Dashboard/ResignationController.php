<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Resign;
class ResignationController extends Controller
{
    public function index()
    {
        $resign=\App\Resign::all();
        return view("dashboard.resignation.index",compact('resign'));
    }
    public function create()
    {
        $employee=\App\Employee::all();
        return view("dashboard.resignation.create",compact('employee'));
    }
    public function store(Request $request)
    {
        $request->validate([
            "employee_id"=>'required',
            "resign_date"=>'required',
            "reason"=>'required',
        ]);
        $d = new \DateTime($request->resign_date);
  
       
        $employee=Resign::all();
       $thisemplo=\App\Employee::findOrFail($request->employee_id);
        $attend_day=\App\Regestration::where('employee_id',$request->employee_id)->whereMonth('date',$d->format('m'))->get();
        

        $day_count=($thisemplo->sallary /30);
        $tottal=(((($day_count * count($attend_day)  ) )));

       
        $row= new Resign;
        $row->name=$thisemplo->name;
        $row->email=$thisemplo->email;
        $row->totall=$tottal;
        $row->sallary=$thisemplo->sallary;
        $row->tawzef_date=$thisemplo->tawzef_date;
        $row->employee_id=$request->employee_id;
        $row->resign_date=$request->resign_date;
        $row->reason=$request->reason;
        $row->save();
       \App\Employee::findOrFail($request->employee_id)->delete();

        session()->flash('success',__('added successfuly'));
        return redirect()->route('dashboard.resign_index');
           
    }
}
