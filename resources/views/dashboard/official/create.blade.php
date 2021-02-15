@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>welcom to official  
        <small>you can add new official</small>
        </h1>

        <ol class="breadcrump"></ol>
    </section>

    <section class="content">
    @include('partials._errors')

        <form action="{{route('dashboard.official.store')}}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1"> add name </label>
                <input type="text" name="name" value="{{ old('name') }}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"> add date</label>
                <input type="date" name="date" value="{{ old('date') }}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            
           
            <button type="submit" class="btn btn-primary">Save</button>
</form>




    </section>

</div>


@endsection

