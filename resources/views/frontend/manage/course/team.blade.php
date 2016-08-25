@extends('frontend.layouts.master')

@section('content')
    <h2>{!! $team->name !!}</h2>
        <div class="col-lg-12">
            <div class="col-xs-5">

                <select name="from[]" class="multiselect form-control" size="8" multiple="multiple" data-right="#multiselect_to_1" data-right-all="#right_All_1" data-right-selected="#right_Selected_1" data-left-all="#left_All_1" data-left-selected="#left_Selected_1">
                @foreach($students_not_on_team as $student)

                    <option value="{!! $student->id !!}">{!! $student->name !!}</option>
                @endforeach
                </select>
            </div>

            <div class="col-xs-2">
                &nbsp;
                <button type="button" id="right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                <button type="button" id="right_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="left_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>

            </div>

            <div class="col-xs-5">
                <select name="to[]" class="multiselect form-control" size="8" multiple="multiple" data-right="#multiselect_to_1" data-right-all="#right_All_1" data-right-selected="#right_Selected_1" data-left-all="#left_All_1" data-left-selected="#left_Selected_1">
                @foreach($students as $student)
                    @endforeach
                </select>
            </div>
        </div>
@endsection

@section('after-scripts-end')
    <script>

    jQuery(document).ready(function($) {
        $('.multiselect').multiselect();
    });


    </script>
@stop