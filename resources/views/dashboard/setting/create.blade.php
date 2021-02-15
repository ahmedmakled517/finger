@extends('layout_dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>welcom to setting  
        <small>you can add new setting</small>
        </h1>

        <ol class="breadcrump"></ol>
    </section>

    <section class="content">
    @include('partials._errors')

        <form action="{{route('dashboard.setting_update',1)}}" method="POST">
            {{ csrf_field() }}
        {{ method_field('put') }}

            <div class="form-group">
                <label for="exampleInputEmail1">How many hours do I multiplication in an hour discount..</label>
                <input type="text" name="discount" value="{{$setting->discount}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"> How many hours do I multiplication in an hour additional..</label>
                <input type="text" name="additional" value="{{$setting->additional}}"  required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"> Weekend </label>
               
                        <li><label><input type="checkbox" {{in_array('Saturday',$arr) ? 'checked' : '' }}  name="weekly_free[]" value="Saturday">Saturday </label></li>
                        <li><label><input type="checkbox" {{in_array('Sunday',$arr) ? 'checked' : '' }} name="weekly_free[]" value="Sunday">Sunday </label></li>
                        <li><label><input type="checkbox"{{in_array('Monday',$arr) ? 'checked' : '' }}  name="weekly_free[]" value="Monday ">Monday  </label></li>
                        <li><label><input type="checkbox" {{in_array('Tuesday ',$arr) ? 'checked' : '' }} name="weekly_free[]" value="Tuesday "> Tuesday </label></li>
                        <li><label><input type="checkbox" {{in_array('Wednesday',$arr) ? 'checked' : '' }} name="weekly_free[]" value="Wednesday">Wednesday </label></li>
                        <li><label><input type="checkbox" {{in_array('Thursday',$arr) ? 'checked' : '' }} name="weekly_free[]" value="Thursday">Thursday </label></li>
                        <li><label><input type="checkbox"{{in_array('Friday',$arr) ? 'checked' : '' }} name="weekly_free[]" value="Friday">Friday </label></li>

            </div>
           
            <button type="submit" class="btn btn-primary">update</button>
</form>




    </section>

</div>


@endsection

