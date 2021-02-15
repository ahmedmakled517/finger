@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>welcom to official  
        <small>you can edit about official</small>
        </h1>

        <ol class="breadcrump"></ol>
    </section>

    <section class="content">
    @include('partials._errors')

    <form action="{{ route('dashboard.official.update', $official->id) }}" method="post">

        {{ csrf_field() }}
        {{ method_field('put') }}

        <div class="form-group">
                <label for="exampleInputEmail1"> add name</label>
                <input type="text" name="name"value="{{$official->name}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"> add date</label>
                <input type="date" name="date" value="{{$official->date}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            
            

        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> edit</button>
</div>

  </form>





    </section>

</div>


@endsection

