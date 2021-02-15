@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>welcom to employee  
        <small>you can edit about employee</small>
        </h1>

        <ol class="breadcrump"></ol>
    </section>

    <section class="content">
    @include('partials._errors')

    <form action="{{ route('dashboard.employee.update', $employee->id) }}" method="post">

        {{ csrf_field() }}
        {{ method_field('put') }}

        <div class="form-group">
                <label for="exampleInputEmail1"> add driver</label>
                <input type="text" name="name"value="{{$employee->name}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"> add email</label>
                <input type="email" name="email" value="{{$employee->email}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            
            <div class="form-group">
            <label for="exampleInputEmail1"> add number</label>
                <input type="text" name="numberphone" value="{{$employee->numberphone}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

             
            <div class="form-group">
            <label for="exampleInputEmail1"> add salary</label>
                <input type="text" name="sallary" value="{{$employee->sallary}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1"> add tawzef_date</label>
                <input type="date" name="tawzef_date" value="{{$employee->tawzef_date}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1"> attend_time</label>
                <input type="time" name="attend_time" value="{{$employee->attend_time}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1"> sinout_time</label>
                <input type="time" name="sinout_time"  value="{{$employee->sinout_time}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> edit</button>
        </div>

  </form>





    </section>

</div>


@endsection

