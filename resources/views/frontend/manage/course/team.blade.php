@extends('frontend.layouts.master')

@section('content')
    <h2>{!! $team->name !!}</h2>

{!! var_dump($students) !!}
{!! var_dump($students_not_in_class) !!}

@endsection

@section('after-scripts-end')
    <script>



    </script>
@stop