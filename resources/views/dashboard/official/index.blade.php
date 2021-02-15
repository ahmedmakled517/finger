@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
<section class="content-header">

    <h1>welcom to official  
    <small>you can see and maintain in official</small>
    </h1>

<ol class="breadcrump"></ol>
</section>
<section class="content">
      <div class="row"> 
             

              <a href="{{route('dashboard.official.create')}}" class="btn btn-primary" ><i class="fa fa-plus"></i> addNewOfficial</a>
         
              </div>
                 
              

      <div>



@if($official->count() > 0)
<table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">name</th>
                                  <th scope="col">date</th>
                                  
                                  <th scope="col">maintain</th>
                                </tr>
                              </thead>
                              <tbody>
                                            @foreach($official as $index=>$dataa)
                                    <tr>

                                      <td>{{$index +1}}</td>
                                      
                                        <td>{{$dataa->name}}</td>
                                        <td>{{$dataa->date}}</td>
                                        
                                      

                                        <td>
                                        <form action="{{ route('dashboard.official.destroy', $dataa->id) }}" method="post" style="display: inline-block">
                                                  {{ csrf_field() }}
                                                  {{ method_field('delete') }}
                                                  <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> delete</button>
                                            </form>


                                        <a href="{{route('dashboard.official.edit',$dataa->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>edit</a> 
                                  
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>

                    </table>

@else
  <h1>not found data</h1>
@endif

</section>

</div>


@endsection

