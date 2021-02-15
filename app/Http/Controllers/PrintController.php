<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;



use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function index($id)
    {
       $employee=\App\Employee::findOrFail($id);



       return view("dashboard.print.emplo",compact('employee'));
    }
    public function prnpriview(Request $request )
    {
   if ($request->ajax()) {
    
        $request->validate([
            "month"=>"required",
            "year"=>"required",
        
        ]);
       
        $employee = \App\Employee::findOrFail($request->id);
        $regest=\App\Regestration::all();
        $official=\App\Official::all();
        $off_date=[];
        foreach ($official as  $offic) {
            array_push($off_date,$offic->date);
        }

$arr=[];
$attend=[];
$hour_add=[];
$hour_dis=[];

$hour_additional=[];



        foreach ($regest as $key => $value) {
        $d = new \DateTime($value->date);
            if($request->month === $d->format('m') && $request->year == $d->format('Y')){

                   if ($employee->id == $value->employee_id) {
                        for ($i=date('Y-'.$request->month.'-01'); $i <= date('Y-'.$request->month.'-31') ; $i++) {

                            if ($i === $value->date) {
                                array_push($arr,[$employee->id=>1]);
                                 $ds = new \DateTime($i);
                                if ($ds->format('l') === "Friday" || $d->format('l') === "Saturday" || in_array($i,$off_date)) {

                                    $vs= Carbon::parse($value->sinout );
                                    $sinout = ($vs->hour * 60) + $vs->minute;
                                    $da= Carbon::parse($value->attend);
                                    $attend = ($da->hour * 60) + $da->minute;
                                    $tolrt=(((($sinout -  $attend) ) / 60)) ;

                                    array_push($hour_additional,[$employee->id=>( $tolrt)]);
                                }
                            }
                        }
                    }
                }
            
        }
    
    



    $hour_discount=[];
    $hour_aded=\App\Regestration::select('employee_id','attend','sinout')->whereMonth('date',$request->month)->whereYear('date',$request->year)->get();
    
        foreach ($hour_aded as  $hour_plus) {
            if ($hour_plus->employee_id == $employee->id) {

            
            
                
              if ($hour_plus->attend == $employee->attend_time && $hour_plus->sinout ==$employee->sinout_time ) {
                 array_push($hour_discount,[$employee->id=>0]);
              }else {
                $dtd= Carbon::parse($hour_plus->attend);
                $min_hur = ($dtd->hour * 60) + $dtd->minute;
                 $dt= Carbon::parse($employee->attend_time);
                $min_hoour = ($dt->hour * 60) + $dt->minute;
              $min_hour=(((($min_hur -  $min_hoour) ) / 60)) ;

              $dtd= Carbon::parse($hour_plus->sinout);
              $max_hur = ($dtd->hour * 60) + $dtd->minute;
              $dt= Carbon::parse($employee->sinout_time);
              $max_huoor = ($dt->hour * 60) + $dt->minute;
              $max_hour=(((($max_hur -  $max_huoor) ) / 60)) ;

               ($max_hour >= 0) ? array_push($hour_additional,[$employee->id=>$max_hour]) : array_push($hour_discount,[$employee->id=>(-$max_hour)]); 
               ($min_hour >= 0) ?  array_push($hour_discount,[$employee->id=>$min_hour]) : array_push($hour_discount,[$employee->id=>(-$min_hour)]); 
            

              }
        }
    }
    

    


 
    $tt=0;
      foreach ($hour_discount as  $value) {
        foreach ($value as $keyere => $valueore) {
                if ($employee->id == $keyere) {
                    $tt +=$valueore;
                }
            }
        }
        array_push($hour_dis,[$employee->id=>$tt]);
    
 
    $tt=0;
      foreach ($hour_additional as  $value) {
        foreach ($value as $keye => $valueee) {
                if ($employee->id == $keye) {
                    $tt +=$valueee;
                }
            }
        }
        array_push($hour_add,[$employee->id=>$tt]);
    




    $attend_day=[];
   
    $tt=0;
      foreach ($arr as  $value) {
        foreach ($value as $key => $valuee) {
                if ($employee->id == $key) {
                    $tt +=$valuee;
                }
            }
        }
        array_push($attend_day,[$employee->id=>$tt]);
    




    $r =cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
    $absencee_Day=[];

    foreach ($attend_day as  $value) {
        foreach ($value as $key => $valuee) {
            if ($employee->id == $key) {
                $ttot= $r - $valuee;
                array_push($absencee_Day,[$employee->id=>$ttot]) ;
            }
        }
    }
  

$absence_day=[];
for ($i=date('Y-'.$request->month.'-01'); $i <= date('Y-'.$request->month.'-'.$r); $i++) {
        $de = new \DateTime($i); 
        
                $regestt=\App\Regestration::select('employee_id','date')->whereMonth('date',$request->month)->whereDay('date',$de->format('d'))->whereYear('date',$de->format('Y'))->where('employee_id',$employee->id)->get();
                if (count($regestt) <= 0) {
                    array_push($absence_day,[$employee->id=>date('Y-'.$request->month.'-'.$de->format('d')) ]);
                }    
            
}

$setting=  \App\Setting::findOrFail(1);
$ardr=  explode(',' ,$setting->weekly_free);
$dayesNotDis=[];
$official=\App\Official::all();

    foreach ($absence_day as $abscen) {
        foreach ($abscen as $key => $abs) {

            if ($employee->id == $key) {
                foreach ($official as  $off) {
                    
                        $do = new \DateTime($abs);
                        if ($off->date === $abs  ) {
                            array_push($dayesNotDis,[$employee->id=>1]);
                        }
                    
                
                
                }
            }
        }
    }   

$desd=[];
$derd=[];

    foreach ($absence_day as $abscen) {
        foreach ($abscen as $key => $abs) {
                      if ($employee->id == $key) {

                        $do = new \DateTime($abs);
                        if ( in_array($do->format('l'),$ardr)  ) {
                            array_push($derd,[$employee->id=>1]);
                        }
                    
                
                
                }
        }
    }   

$week_vacation=[];

    $week_vacat =0 ;
    foreach ($derd as  $dred) {
        foreach ($dred as $key => $drd) {
                if ($employee->id == $key) {
                    $week_vacat += $drd;
                }
            }
        }
array_push($week_vacation,[$employee->id=>$week_vacat]);


$offi=[];

$tota=0;
    foreach ($dayesNotDis as  $dayes) {
        foreach ($dayes as $key => $value) {
           if ($employee->id == $key) {
               $tota +=$value;
           }
        }
    }
    array_push($offi,[$employee->id=>$tota]);


$setting= \App\Setting::all();
$tottal_add=[];
$tottal_dis=[];


     foreach ($setting as   $set) {
        foreach ($hour_add as  $value) {
             foreach ($value as $key => $valuee) {

                 if ($key == $employee->id) {
                     $hour_count=(($employee->sallary/30)/8);
                    $add= $valuee * $set->additional ;
                    $tot=$add   *$hour_count;
                    array_push($tottal_add,[$employee->id=>$tot]);
                 }
              }
         
        
         foreach ($hour_dis as  $di) {
             foreach ($di as $keyy => $val) {
                 foreach ($absencee_Day as  $value) {
                     foreach ($value as $koo => $bsa) {
                         foreach ($offi as $key => $of) {
                            foreach ($of as $kof => $o) {
                                foreach ($week_vacation as  $we_va) {
                                   foreach ($we_va as $kwe => $we_v) {
                                    if ($keyy == $employee->id && $koo==$employee->id && $kof==$employee->id && $kwe==$employee->id) {
                                        $dye=((($bsa - ($o + $we_v))*8 ) * $set->discount );
                                        $hour_count=(($employee->sallary/30)/8);
                                       $dis= $val * $set->discount ;
                                        $tet=($dis +$dye ) *$hour_count;
                                       array_push($tottal_dis,[$employee->id=>$tet]);
                                    }
                                   }
                                }
                            
                            }
                         }
                        
                     }
                 }
                
                
         }
         }
        
    } 
    
 }




$total=[];

    foreach ($tottal_add as  $tott) {
        foreach ($tott as $key => $tot) {
           foreach ($tottal_dis as  $is) {
               foreach ($is as $keyey => $ise) {
                   foreach ($attend_day as  $abs) {
                       foreach ($abs as $keyeo=> $ab) {
                           foreach ($offi as  $ds) {
                              foreach ($ds as $koy => $va) {
                                  foreach ($week_vacation as  $vact) {
                                      foreach ($vact as $vct => $act) {
                                        if ($employee->id == $key && $employee->id == $vct  && $employee->id == $keyey && $employee->id == $keyeo &&  $employee->id == $koy ) {
                                            $day_count=($employee->sallary /30);
                                           $da= $request->month-$va;
                                            $tottal=(($employee->sallary +$tot) - $ise) ;
                                        }
                                      }
                                  }
                                
                              }
                           }
                    
                       }
                   }
                
               }
           }
        }
    }
    array_push($total,[$employee->id=>$tottal]);



     
       return view("dashboard.print.printstudent",compact('employee','attend_day','absencee_Day','hour_add','hour_dis','tottal_add','tottal_dis','total'));
}
}
}
