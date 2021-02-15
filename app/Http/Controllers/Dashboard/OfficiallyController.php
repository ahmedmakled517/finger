<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Official;
class OfficiallyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $official= Official::all();

        return view("dashboard.official.index",compact('official'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.official.create');
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
            "date"=>'required',
           
        ]);

        $row= new Official;
        $row->name=$request->name;
        $row->date=$request->date;
            
        $row->save();
        session()->flash('success',__('added successfuly'));
        return redirect()->route('dashboard.official.index');
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
        $official=Official::findOrFail($id);
        return view("dashboard.official.edit",compact("official"));
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
            "date"=>'required',
           
        ]);

        $row=  Official::findOrFail($id);
        $row->name=$request->name;
        $row->date=$request->date;
            
        $row->save();
        session()->flash('success',__('added successfuly'));
        return redirect()->route('dashboard.official.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Official::findOrFail($id)->delete();
        return back();
    }
}
