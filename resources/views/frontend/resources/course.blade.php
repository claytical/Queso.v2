@extends('frontend.layouts.master')

@section('content')

<div class="columns is-multiline is-mobile">
    @foreach($resources as $category => $resource)
        <div class="column is-half">
            <p class="title">{!! $category !!}</p>
            @foreach($resource as $category => $r)
                {!! $r->title !!}
            @endforeach
        </div>
    @endforeach
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop