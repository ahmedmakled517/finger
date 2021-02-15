

      <div class="row"> 
    
    
 
      <div class="row">   
  <center>
  <h1 style="color:black">Pioneers </h1>
  <h5 style="color:black">shibin elkom</h5>
  <h5 style="color:black">salary slip</h5>
  
  </center>  
    <hr>
       <table class="table table-hover" >
   
 
                         
                              <th  scope="col">employee name</th>
                              <th scope="col">email</th>
                              <th scope="col">sallary</th>
                              <th scope="col">numberphone</th>
                              <th scope="col">attend day time</th>
                              <th scope="col">absence day time</th>
                              <th scope="col">hour  additional </th>
                              <th scope="col">hour  discount </th>
                              <th scope="col">tottal  additional </th>
                              <th scope="col">tottal  discount </th>
                              <th style='color:blue' scope="col">tottal </th>
    </tr>
    <tr>                     
        <td>{{ $employee->name }}</td>
        <td>{{ $employee->email }}</td>
        <td>{{ $employee->sallary }}</td>
        <td>{{ $employee->numberphone }}</td>

        <td>
                                            @foreach($attend_day as $att)
                                                @foreach($att as $key=>$value)
                                                  @if($key == $employee->id)
                                                      {{$value}}
                                                  @endif
                                                @endforeach
                                            @endforeach
          </td>
          <td>
                                            @foreach($absencee_Day as $abs)
                                                @foreach($abs as $key=>$value)
                                                  @if($key == $employee->id)
                                                      {{$value}}
                                                  @endif
                                                @endforeach
                                            @endforeach
                                            </td>
                                            <td>
                                            @foreach($hour_add as $hadd)
                                                @foreach($hadd as $key=>$value)
                                                  @if($key == $employee->id)
                                                      {{$value}}
                                                  @endif
                                                @endforeach
                                            @endforeach
                                            </td>
                                            <td>
                                            @foreach($hour_dis as $hdiss)
                                                @foreach($hdiss as $key=>$value)
                                                  @if($key == $employee->id)
                                                      {{$value}}
                                                  @endif
                                                @endforeach
                                            @endforeach
                                            </td>
                                            <td>
                                            @foreach($tottal_add as $tadd)
                                                @foreach($tadd as $key=>$value)
                                                  @if($key == $employee->id)
                                                      {{$value}}
                                                  @endif
                                                @endforeach
                                            @endforeach
                                            </td>
                                            <td>
                                            @foreach($tottal_dis as $tdiss)
                                                @foreach($tdiss as $key=>$value)
                                                  @if($key == $employee->id)
                                                      {{$value}}
                                                  @endif
                                                @endforeach
                                            @endforeach
      </td>
      <td style='color:blue'>
                                            @foreach($total as $tot)
                                                @foreach($tot as $key=>$value)
                                                  @if($key == $employee->id)
                                                      {{$value}}
                                                  @endif
                                                @endforeach
                                            @endforeach
        </td>
    </tr>
   
  </table>

    </div>
    </div>
    

             
    
                 
              











