@if($employee->count() > 0)
<table class="table">
<thead class="thead-dark">
                  <tr>  
                             <th scope="col">#</th>
                              <th scope="col">employee name</th>
                              <th scope="col">sallary</th>
                              <th scope="col">attend day time</th>
                              <th scope="col">absence day time</th>
                              <th scope="col">hour  additional </th>
                              <th scope="col">hour  discount </th>
                              <th scope="col">tottal  additional </th>
                              <th scope="col">tottal  discount </th>
                              <th scope="col">tottal </th>
                              <th scope="col">print </th>
                    </tr>
                </thead>
                              <tbody>
                                      @foreach($employee as $index=>$dataa)
                                    <tr>

                                      <td>{{$index +1}}</td>
                                      
                                        <td>{{$dataa->name}}</td>
                                        <td>{{$dataa->sallary}}</td>
                                        
                                        <td>
                                        @foreach($attend_day as $att)
                                            @foreach($att as $key=>$value)
                                              @if($key == $dataa->id)
                                                  {{$value}}
                                              @endif
                                            @endforeach
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach($absencee_Day as $abs)
                                            @foreach($abs as $key=>$value)
                                              @if($key == $dataa->id)
                                                  {{$value}}
                                              @endif
                                            @endforeach
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach($hour_add as $hadd)
                                            @foreach($hadd as $key=>$value)
                                              @if($key == $dataa->id)
                                                  {{$value}}
                                              @endif
                                            @endforeach
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach($hour_dis as $hdiss)
                                            @foreach($hdiss as $key=>$value)
                                              @if($key == $dataa->id)
                                                  {{$value}}
                                              @endif
                                            @endforeach
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach($tottal_add as $tadd)
                                            @foreach($tadd as $key=>$value)
                                              @if($key == $dataa->id)
                                                  {{$value}}
                                              @endif
                                            @endforeach
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach($tottal_dis as $tdiss)
                                            @foreach($tdiss as $key=>$value)
                                              @if($key == $dataa->id)
                                                  {{$value}}
                                              @endif
                                            @endforeach
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach($total as $tot)
                                            @foreach($tot as $key=>$value)
                                              @if($key == $dataa->id)
                                                  {{$value}}
                                              @endif
                                            @endforeach
                                        @endforeach
                                        </td>
                                        <td>
                                       
                                        
                                        <button type="button"  value="{{ $dataa -> id}}"   class="classroomLike btn btn-primary"  ><span> <i class="fa fa-print"></i> print</span></button>
                                        <!-- <a class="classroomLike btn btn-primary " href="{{url('dashboard/prnpriview')}}">Print</a> -->
                                      </td>
                                    </tr>
                                   

                                    @endforeach
  
                                </tbody>

                    </table>

                    <div class="col-sm-12">
              
                <table class="cont-data">
                   
                    
                </table>



            </div>

@else
  <h1>not found data</h1>
@endif
<script src="{{asset('/assets')}}/js/jquery-3.4.1.js"  ></script>
    <script src="{{asset('/assets')}}/js/popper.min.js" ></script>
    <script src="{{asset('/assets')}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('/assets')}}/js/jquery.printPage.js"></script>
<script type="text/javascript">

$('.classroomLike').click(function() {
    
  
   var id =$(this).val()

    $.ajax({
      url: '{{url('dashboard/prnpriview')}}',
      type: 'get',
      data: 'month=' + {{$monthe}} +'&year=' + {{$year}}+'&id=' + id ,
      
      success:function(dataBack) {
        var popupWin = window.open('', 'PRINT','height=650,width=900,top=100,left=150');
        popupWin.document.write('<html><body onload="window.print()">' + dataBack + '</html>');
        popupWin.print();
       
      },
      error: function(data) {
       
      }
    });
  });


</script>  
