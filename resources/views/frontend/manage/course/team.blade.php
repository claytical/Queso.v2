@extends('frontend.layouts.master')

@section('content')
    <h2>{!! $team->name !!}</h2>
            <select name="from[]" class="multiselect form-control" size="8" multiple="multiple" data-right="#multiselect_to_1" data-right-all="#right_All_1" data-right-selected="#right_Selected_1" data-left-all="#left_All_1" data-left-selected="#left_Selected_1">
            @foreach($students as $student)
                <option value="{!! $student->id !!}">{!! $student->name !!}</option>
            @endforeach
            </select>

            <select name="to[]" class="multiselect form-control" size="8" multiple="multiple" data-right="#multiselect_to_1" data-right-all="#right_All_1" data-right-selected="#right_Selected_1" data-left-all="#left_All_1" data-left-selected="#left_Selected_1">
                @foreach($students_not_on_team as $student)
                <option value="{!! $student->id !!}">{!! $student->name !!}</option>
                @endforeach
            </select>

@endsection

@section('after-scripts-end')
    <script>



    </script>
@stop