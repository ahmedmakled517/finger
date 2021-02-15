@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
<section class="content-header">

    <h1>welcom to resination  
    <small>you can see who make him resignation</small>
    </h1>
    <hr>
    <a href="{{route('dashboard.resign_create')}}" class="btn btn-primary" ><i class="fa fa-plus"></i> addNewResignation</a>

<ol class="breadcrump"></ol>
</section>
<section class="content">
      <div class="row"> 
      <div class="col-md-4">

              
      @if($resign->count() > 0)
<table class="table">
                              <thead>
                                  <tr>
                                      <th scope="col">#</th>
                                      <th scope="col"> name</th>
                                      <th scope="col"> email</th>
                                      <th scope="col"> sallary</th>
                                      <th scope="col"> tawzef_date</th>
                                      <th scope="col"> resign_date</th>
                                      <th scope="col"> romain_mouny</th>
                                      <!-- <th scope="col"> delete</th> -->
                                  </tr>
                              </thead>
                              <tbody>
                                 @foreach($resign as $index=>$dataa)
                                    <tr>

                                      <td>{{$index +1}}</td>
                                      
                                        <td>{{$dataa->name}}</td>
                                        <td>{{$dataa->email}}</td>
                                        <td>{{$dataa->sallary}}</td>
                                        <td>{{$dataa->tawzef_date}}</td>
                                        <td>{{$dataa->resign_date}}</td>
                                        <td>{{$dataa->totall}}</td>
                                        <td> 
                                           <!-- <form action="{{ route('dashboard.employee.destroy', $dataa->id) }}" method="post" style="display: inline-block">
                                                  {{ csrf_field() }}
                                                  {{ method_field('delete') }}
                                                  <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> delete</button>
                                          </form> -->
                                        </td>
                                            
                                    </tr>

                                  @endforeach

                                </tbody>

                    </table>

@else
  <h1>not found data</h1>
@endif
              

        <div>
      <div>





</section>

</div>


@endsection

