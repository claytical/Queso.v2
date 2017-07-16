@extends('frontend.layouts.master')

@section('content')

<div class="columns is-multiline is-mobile">
    @foreach($resources as $tag => $resource)
        <div class="column is-half">
        {!! var_dump($resource) !!}
        </div>
    @endforeach
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop