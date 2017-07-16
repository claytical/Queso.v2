@extends('frontend.layouts.master')

@section('content')

<div class="columns is-multiline is-mobile">
    @foreach($resources as $tag => $resource)
        <div class="column is-half">
            <p class="title">{!! $tag !!}</p>
            @foreach($resource as $r)
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