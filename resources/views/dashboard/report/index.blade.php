@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
<section class="content-header">

    <h1>welcom to rport employee  
    <small> can  you saearch  about employee in month</small>
    </h1>

<ol class="breadcrump"></ol>
</section>
<section class="content">
      <div class="row">
      <div class="col col-lg-12">
       
      <form id='but_ajax'">   
            <div class="row">

                <div class="col-md-4">
                <label for="exampleInputEmail1">  select month :-</label>
                      <select required name="mounth" style="width:200px" id="">
                      @foreach($getMonth as $month)
                        <option value="{{$month}}" >{{$month}}</option>
                      @endforeach
                    
                      </select>
                </div>

                <div class="col-md-4">
                <label for="exampleInputEmail1">  select year :-</label>
                      <select  required style="width:200px" name="year">

                      @for ($year = 2020 ; $year <= date('Y') +100; $year++)
                          <option value="{{$year}}" >{{$year}}</option>
                      @endfor
                    </select>
                  
                </div>
                <div class="col-md-4">
                <input type="submit" class="btn btn-primary" value="Search" name="submit">
                </div>
        
               
       </form>  
  
      </div>
  
      </div>
      <div class="container-fluid">
        <div class="row">

           <hr>
            <div class="col-sm-12">
              
                <table class="cont-data">
                   
                    
                </table>

                   


            </div>
        </div>
    </div>


</section>

</div>
<script src="{{asset('/assets')}}/js/jquery-3.4.1.js"  ></script>
    <script src="{{asset('/assets')}}/js/popper.min.js" ></script>
    <script src="{{asset('/assets')}}/js/bootstrap.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script type="text/javascript">


    $('#but_ajax').submit(function(e){
      e.preventDefault();
    //   var but_ajax  = new FormData(jQuery('#but_ajax')[0]);
        var but_ajax=$('#but_ajax').serialize();
        //    console.log(but_ajax)
           
      
      $.ajax({
			 	type:'get',
			 	url:"{{url('dashboard/get_report')}}",
			 	data:but_ajax,
			 	success:function(dataBack){
                    $(".cont-data").empty();
                    $(".cont-data").prepend(dataBack)
			 	},
				error:function(){
                    
				}
			 })
    })


</script>


@endsection
