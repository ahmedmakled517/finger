<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=\App\Employee::all();
       
        return view('dashboard.employee.index',compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.employee.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>'required',
            "email"=>'required',
            "numberphone"=>'required',
            "tawzef_date"=>'required',
            "sallary"=>'required',
            "attend_time"=>'required',
            "sinout_time"=>'required',
        ]);
         Employee::create($request->all()) ;
        session()->flash('success',__('added successfuly'));
        return redirect()->route('dashboard.employee.index');
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
        $employee=  Employee::findOrFail($id);

        return view('dashboard.employee.edit',compact('employee'));
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
        $request->validate([
            "name"=>'required',
            "email"=>'required',
            "numberphone"=>'required',
            "tawzef_date"=>'required',
            "sallary"=>'required',
            "attend_time"=>'required',
            "sinout_time"=>'required',
        ]);

        $row=  Employee::findOrFail($id);
        $row->name=$request->name;
        $row->email=$request->email;
        $row->numberphone=$request->numberphone;
        $row->tawzef_date=$request->tawzef_date;
        $row->sallary=$request->sallary;
        $row->attend_time=$request->attend_time;
        $row->sinout_time=$request->sinout_time;
        $row->save();
        session()->flash('success',__('added successfuly'));
        return redirect()->route('dashboard.employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
         $emplo= \App\Regestration::where('employee_id',$id)->get();
       
        if(count($emplo) <= 0){
         Employee::findOrFail($id)->delete();
         return back();
        }
        session()->flash('error',__('this employee have regestration plz make to him resignation'));
         return back();
     
    }
}
