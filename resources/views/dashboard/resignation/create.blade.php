@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>welcom to resignation  
        <small>you can  add employee at resination</small>
        </h1>

        <ol class="breadcrump"></ol>
    </section>

    <section class="content">
    @include('partials._errors')

        <form action="{{route('dashboard.resign_store')}}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1"> add employee</label>
                <select name="employee_id" style="width:200px">
                    @foreach($employee as $emplo)
                    <option  value="{{$emplo->id}}">{{$emplo->name}}</option>
                    @endforeach
                </select>
            </div>
           
            
            
           
            <div class="form-group">
            <label for="exampleInputEmail1"> resignation date</label>
                <input type="date" name="resign_date" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1"> Reason</label>
                <input type="text" name="reason" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
</form>




    </section>

</div>


@endsection

