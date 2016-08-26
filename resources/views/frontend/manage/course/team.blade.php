@extends('frontend.layouts.master')

@section('content')
    <h2>{!! $team->name !!}</h2>
        <div class="col-lg-12">
            <div class="col-xs-5">

                <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple">
                @foreach($students_not_on_team as $student)

                    <option value="{!! $student->id !!}">{!! $student->name !!}</option>
                @endforeach
                </select>
            </div>

            <div class="col-xs-2">
                &nbsp;
                <button type="button" id="right_All" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                <button type="button" id="right_Selected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="left_Selected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="left_All" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>

            </div>

            <div class="col-xs-5">
                <select name="to[]" class="form-control" size="8" multiple="multiple">
                @foreach($students as $student)
                    <option value="{!! $student->id !!}">{!! $student->name !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
@endsection

@section('after-scripts-end')
    <script>

    jQuery(document).ready(function($) {
        $('#multiselect').multiselect();
    });


    </script>
@stop