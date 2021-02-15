@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
<section class="content-header">

    

<ol class="breadcrump"></ol>
</section>
<section class="content">
      <div class="row">   
  <center>
  <h1 style="color:black">Pioneers </h1>
  <h5 style="color:black">shibin elkom</h5>
  <h5 style="color:black">salary slip</h5>
  
  </center>  
  <hr>
    <table class="table table-hover" >
    <tr><th>Name</th><th>Email</th><th>Salary</th><th>NumberPhone</th></tr>
    <td>{{ $employee->name }}</td>
    <td>{{ $employee->email }}</td>
    <td>{{ $employee->sallary }}</td>
    <td>{{ $employee->numberphone }}</td>
    </tr>
   
  </table>
<hr>
<hr>

  <center>
  <a href="{{ route('dashboard.prnpriview',$employee->id ) }}" class="btnprint btn btn-primary">Print Preview</a>
  </center>
    <script src="{{asset('/assets')}}/js/jquery-3.4.1.js"  ></script>
    <script src="{{asset('/assets')}}/js/popper.min.js" ></script>
    <script src="{{asset('/assets')}}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('/assets')}}/js/jquery.printPage.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        $('.btnprint').printPage();
        });

    </script>
    </div>
    </div>
    
</section>



                 
              








@endsection


