@extends('frontend.layouts.master')

@section('content')
    <h2>{!! $team->name !!}</h2>
{!! Form::open(array('url' => 'manage/course/team')) !!}
{!! Form::hidden('quest_id', $quest->id ) !!}

<div class="row">
    <div class="col-xs-5">
        <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple">
        @foreach($students_not_on_team as $student)
            <option value="{!! $student->id !!}">{!! $student->name !!}</option>
        @endforeach
        </select>
    </div>
    
    <div class="col-xs-2">
        <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
        <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
        <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
        <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
    </div>
    
    <div class="col-xs-5">
        <select name="to[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
            @foreach($students as $student)
                <option value="{!! $student->id !!}">{!! $student->name !!}</option>
            @endforeach
            
        </select>
    </div>
</div>
<div class="row">
    {!! Form::submit('Set Team', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
</div>
    
    {!! Form::close() !!}

@endsection

@section('after-scripts-end')
    <script>

    jQuery(document).ready(function($) {
        $('#multiselect').multiselect();
    });


    </script>
@stop