<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(Request $request)
    {
       
        $getMonth = [];
        foreach (range(1, 12) as $m) {
            $getMonth[] = date('m', mktime(0, 0, 0, $m, 1));
        }
     
            return view("dashboard.report.index",compact('getMonth'));
               

    }


       

    public function report(Request $request)
    {
       
        
if ($request->ajax()) {
          
   
           $request->validate([
                        "mounth"=>"required",
                        "year"=>"required",
                    
                    ]);
                    $regest=\App\Regestration::select('employee_id','date')->whereMonth('date',$request->mounth)->whereYear('date',$request->year)->get();
                    if (count($regest) > 0) {
                       
                    $getMonth = [];
                    foreach (range(1, 12) as $m) {
                        $getMonth[] = date('m', mktime(0, 0, 0, $m, 1));
                    }
                    $employee = \App\Employee::all();
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

            foreach ($employee as  $emplo) {

                    foreach ($regest as $key => $value) {
                    $d = new \DateTime($value->date);
                        if($request->mounth === $d->format('m') && $request->year == $d->format('Y')){

                               if ($emplo->id == $value->employee_id) {
                                    for ($i=date('Y-'.$request->mounth.'-01'); $i <= date('Y-'.$request->mounth.'-31') ; $i++) {

                                        if ($i === $value->date) {
                                            array_push($arr,[$emplo->id=>1]);
                                             $ds = new \DateTime($i);
                                            if ($ds->format('l') === "Friday" || $d->format('l') === "Saturday" || in_array($i,$off_date)) {

                                                $vs= Carbon::parse($value->sinout );
                                                $sinout = ($vs->hour * 60) + $vs->minute;
                                                $da= Carbon::parse($value->attend);
                                                $attend = ($da->hour * 60) + $da->minute;
                                                $tolrt=(((($sinout -  $attend) ) / 60)) ;

                                                array_push($hour_additional,[$emplo->id=>( $tolrt)]);
                                            }
                                        }
                                    }
                                }
                            }
                        
                    }
                
                }



                $hour_discount=[];
                $hour_aded=\App\Regestration::select('employee_id','attend','sinout')->whereMonth('date',$request->mounth)->whereYear('date',$request->year)->get();
                foreach ($employee as $lempo) {
                    foreach ($hour_aded as  $hour_plus) {
                        if ($hour_plus->employee_id == $lempo->id) {

                        
                        
                            
                          if ($hour_plus->attend == $lempo->attend_time && $hour_plus->sinout ==$lempo->sinout_time ) {
                             array_push($hour_discount,[$lempo->id=>0]);
                          }else {
                            $dtd= Carbon::parse($hour_plus->attend);
                            $min_hur = ($dtd->hour * 60) + $dtd->minute;
                             $dt= Carbon::parse($lempo->attend_time);
                            $min_hoour = ($dt->hour * 60) + $dt->minute;
                          $min_hour=(((($min_hur -  $min_hoour) ) / 60)) ;

                          $dtd= Carbon::parse($hour_plus->sinout);
                          $max_hur = ($dtd->hour * 60) + $dtd->minute;
                          $dt= Carbon::parse($lempo->sinout_time);
                          $max_huoor = ($dt->hour * 60) + $dt->minute;
                          $max_hour=(((($max_hur -  $max_huoor) ) / 60)) ;

                           ($max_hour >= 0) ? array_push($hour_additional,[$lempo->id=>$max_hour]) : array_push($hour_discount,[$lempo->id=>(-$max_hour)]); 
                           ($min_hour >= 0) ?  array_push($hour_discount,[$lempo->id=>$min_hour]) : array_push($hour_discount,[$lempo->id=>(-$min_hour)]); 
                        

                          }
                    }
                }
                }

                


                foreach ($employee as $em) {
                $tt=0;
                  foreach ($hour_discount as  $value) {
                    foreach ($value as $keyere => $valueore) {
                            if ($em->id == $keyere) {
                                $tt +=$valueore;
                            }
                        }
                    }
                    array_push($hour_dis,[$em->id=>$tt]);
                }
                foreach ($employee as $em) {
                $tt=0;
                  foreach ($hour_additional as  $value) {
                    foreach ($value as $keye => $valueee) {
                            if ($em->id == $keye) {
                                $tt +=$valueee;
                            }
                        }
                    }
                    array_push($hour_add,[$em->id=>$tt]);
                }




                $attend_day=[];
                foreach ($employee as $em) {
                $tt=0;
                  foreach ($arr as  $value) {
                    foreach ($value as $key => $valuee) {
                            if ($em->id == $key) {
                                $tt +=$valuee;
                            }
                        }
                    }
                    array_push($attend_day,[$em->id=>$tt]);
                }




                $r =cal_days_in_month(CAL_GREGORIAN, $request->mounth, $request->year);
                $absencee_Day=[];
            foreach ($employee as $e) {
                foreach ($attend_day as  $value) {
                    foreach ($value as $key => $valuee) {
                        if ($e->id == $key) {
                            $ttot= $r - $valuee;
                            array_push($absencee_Day,[$e->id=>$ttot]) ;
                        }
                    }
                }
            }    
            
            $absence_day=[];
            for ($i=date('Y-'.$request->mounth.'-01'); $i <= date('Y-'.$request->mounth.'-'.$r); $i++) {
                    $de = new \DateTime($i); 
                    foreach ($employee as  $empo) {
                            $regestt=\App\Regestration::select('employee_id','date')->whereMonth('date',$request->mounth)->whereDay('date',$de->format('d'))->whereYear('date',$de->format('Y'))->where('employee_id',$empo->id)->get();
                            if (count($regestt) <= 0) {
                                array_push($absence_day,[$empo->id=>date('Y-'.$request->mounth.'-'.$de->format('d')) ]);
                            }    
                        }
            }

            $setting=  \App\Setting::findOrFail(1);
            $ardr=  explode(',' ,$setting->weekly_free);
            $dayesNotDis=[];
            $official=\App\Official::all();
            foreach ($employee as  $epo) {
                foreach ($absence_day as $abscen) {
                    foreach ($abscen as $key => $abs) {

                        if ($epo->id == $key) {
                            foreach ($official as  $off) {
                                
                                    $do = new \DateTime($abs);
                                    if ($off->date === $abs  ) {
                                        array_push($dayesNotDis,[$epo->id=>1]);
                                    }
                                
                            
                            
                            }
                        }
                    }
                }   
            }
            $desd=[];
            $derd=[];
            foreach ($employee as  $epo) {
                foreach ($absence_day as $abscen) {
                    foreach ($abscen as $key => $abs) {
                                  if ($epo->id == $key) {

                                    $do = new \DateTime($abs);
                                    if ( in_array($do->format('l'),$ardr)  ) {
                                        array_push($derd,[$epo->id=>1]);
                                    }
                                
                            
                            
                            }
                    }
                }   
            }
            $week_vacation=[];
            foreach ($employee as  $eo) {
                $week_vacat =0 ;
                foreach ($derd as  $dred) {
                    foreach ($dred as $key => $drd) {
                            if ($eo->id == $key) {
                                $week_vacat += $drd;
                            }
                        }
                    }
            array_push($week_vacation,[$eo->id=>$week_vacat]);
            }

            $offi=[];
            foreach ($employee as  $peoe) {
            $tota=0;
                foreach ($dayesNotDis as  $dayes) {
                    foreach ($dayes as $key => $value) {
                       if ($peoe->id == $key) {
                           $tota +=$value;
                       }
                    }
                }
                array_push($offi,[$peoe->id=>$tota]);
            }

            $setting= \App\Setting::all();
            $tottal_add=[];
            $tottal_dis=[];

             foreach ($employee as  $employe) {
                 foreach ($setting as   $set) {
                    foreach ($hour_add as  $value) {
                         foreach ($value as $key => $valuee) {

                             if ($key == $employe->id) {
                                 $hour_count=(($employe->sallary/30)/8);
                                $add= $valuee * $set->additional ;
                                $tot=$add   *$hour_count;
                                array_push($tottal_add,[$employe->id=>$tot]);
                             }
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
                                                if ($keyy == $employe->id && $koo==$employe->id && $kof==$employe->id && $kwe==$employe->id) {
                                                    $dye=((($bsa - ($o + $we_v))*8 ) * $set->discount );
                                                    $hour_count=(($employe->sallary/30)/8);
                                                   $dis= $val * $set->discount ;
                                                    $tet=($dis +$dye ) *$hour_count;
                                                   array_push($tottal_dis,[$employe->id=>$tet]);
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
            foreach ($employee as $emp) {
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
                                                    if ($emp->id == $key && $emp->id == $vct  && $emp->id == $keyey && $emp->id == $keyeo &&  $emp->id == $koy ) {
                                                        $day_count=($emp->sallary /30);
                                                       $da= $request->mounth-$va;
                                                        $tottal=(($emp->sallary +$tot) - $ise) ;
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
                array_push($total,[$emp->id=>$tottal]);

            }


            $monthe= $request->mounth;
            $year= $request->year;




                      return view("dashboard.report.report",compact('employee','monthe','year','getMonth','attend_day','absencee_Day','hour_add','hour_dis','tottal_add','tottal_dis','total'));
                
                
                    }
    
}else{
    return response()->json("plz chack date");
}
    }
}