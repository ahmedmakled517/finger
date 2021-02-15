<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Http\Controllers\Controller;

use App\Regestration;
class RegestController extends Controller
{
    public function create()
    {
        $employee= \App\Employee::all();
        return view("dashboard.regest.create",compact('employee'));
    }


    public function store(Request $request)
    {
        $request->validate([
            "date"=>"required",
            "attend"=>"required",
            "sinout"=>"required",
            "employee_id"=>"required",
        ]);
        $official=\App\Official::all();
        $off_date=[];
        foreach ($official as  $offic) {
            array_push($off_date,$offic->date);
        }
        $setting=\App\Setting::findOrFail(1);
        $d = new \DateTime($request->date);
        $dtd = Carbon::now()->addHour($request->sinout);
        $minutes_sin = $dtd->diffInMinutes();
        $dt = Carbon::now()->addHour($request->attend);
        $minutes_attend = $dt->diffInMinutes();
        $total=(((($minutes_sin -  $minutes_attend) +1) / 60));
        $employee= \App\Employee::all();
        $regest_before=\App\Regestration::select('employee_id')->where('date',$request->date)->where('employee_id',$request->employee_id)->get();
        foreach ($employee as  $emplo) {
               
            if ($emplo->id == $request->employee_id) {
                if ($emplo->tawzef_date <= $request->date) {
                    if (count($regest_before) <= 0) {
                       
                        if ($d->format('l') === "Friday" || $d->format('l') === "Saturday" || in_array($request->date,$off_date)) {
                   
                        $additional=($total * $setting->additional  );
                        $row= new Regestration;
                        $row->date=$request->date;
                        $row->attend=$request->attend;
                        $row->sinout=$request->sinout;
                        // $row->hour_add=$additional;
                        $row->employee_id=$request->employee_id;
                        $row->save();
                
                        }else {
                            if(round($total) == 8 ){
                                $row= new Regestration;
                                $row->date=$request->date;
                                $row->attend=$request->attend;
                                $row->sinout=$request->sinout;
                                $row->employee_id=$request->employee_id;
                                $row->save();
                    
                        }elseif(round($total) > 8 ){
                            $additional= $total -8 ;
                    
                            $row= new Regestration;
                            $row->date=$request->date;
                            $row->attend=$request->attend;
                            $row->sinout=$request->sinout;
                            // $row->hour_add=$additional;
                            $row->employee_id=$request->employee_id;
                            $row->save();
                    
                        }elseif(round($total) < 8 ){
                            $discount=8 - $total ;
                            $row= new Regestration;
                            $row->date=$request->date;
                            $row->attend=$request->attend;
                            $row->sinout=$request->sinout;
                            // $row->hour_dis=$discount;
                            $row->employee_id=$request->employee_id;
                            $row->save();
                        
                        } else{
                            echo "faild";
                        }        
                        }
                    
                 
                    
                    }else{
                        session()->flash('error',__('this employee make regestration befor'));
                        return back();
                    }
                  
            }else {
                session()->flash('error',__('sorry this date dont correct'));
                return back();
               
            }
            }
           
    }






       
        session()->flash('success',__('added successfuly'));
        return redirect()->route('dashboard.regest_create');


    }

}
