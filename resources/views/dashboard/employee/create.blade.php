@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>welcom to employee  
        <small>you can add new employee</small>
        </h1>

        <ol class="breadcrump"></ol>
    </section>

    <section class="content">
    @include('partials._errors')
    <div class="container"> 
        <div class="row  md-center">
            <div class="col col-md-6 ">
        <form action="{{route('dashboard.employee.store')}}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1"> add employee</label>
                <input type="text"  name="name" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"> add email</label>
                <input type="email" name="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"value="{{ old('email') }}">
            </div>
            
            <div class="form-group">
            <label for="exampleInputEmail1"> add number phone</label>
                <input type="text" name="numberphone" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"value="{{ old('numberphone') }}">
            </div>
           
            <div class="form-group">
            <label for="exampleInputEmail1"> tawzef date</label>
                <input type="date" name="tawzef_date" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"value="{{ old('tawzef_date') }}">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1"> sallary</label>
                <input type="text" name="sallary" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"value="{{ old('sallary') }}">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1"> attend_time</label>
                <input type="time" name="attend_time" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"value="{{ old('attend_time') }}">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1"> sinout_time</label>
                <input type="time" name="sinout_time" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"value="{{ old('sinout_time') }}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
</form>

</div>
</div>
</div>


    </section>

</div>


@endsection

