@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>welcom to regestration  
        <small>you can add new regestration</small>
        </h1>

        <ol class="breadcrump"></ol>
    </section>

    <section class="content">
         @include('partials._errors')

        <div class="container"> 
        <div class="row  md-center">
            <div class="col col-md-6 ">
              
                <form action="{{route('dashboard.regest_store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1"> add date </label>
                        <input type="date" name="date" value="{{ old('date') }}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> attend time</label>
                        <input type="time" name="attend" value="{{ old('attend') }}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> sinout time</label>
                        <input type="time" name="sinout" value="{{ old('sinout') }}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> select employee :-</label>
                        <select name="employee_id" style="width:200px" id="">
                        @foreach($employee as $emplo)
                            <option value="{{$emplo->id}}">{{$emplo->name}}</option>
                        @endforeach
                        </select>
                    </div>



                
                    <button type="submit" class="btn btn-primary">Save</button>
            </form>
           


         </div>
         </div>
        </div>

    </section>

</div>


@endsection

