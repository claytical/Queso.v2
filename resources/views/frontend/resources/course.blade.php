@extends('frontend.layouts.master')

@section('content')

<div class="columns is-multiline is-mobile">
{!! var_dump($resources) !!}
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop