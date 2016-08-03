@extends('frontend.layouts.master')

@section('content')
<h2>{!! $resource->title !!}</h2>
<h4>{!! $resource->created_at !!}</h4>
<div class="row">
        <div class="col-lg-12">
            {!! $resource->description !!}
        </div>
        <div class="col-lg-12">
            <div>
                EMBEDLY CARD GOES HERE
            </div>

            <h6>Attached Files</h6>
            <a href="#" class="btn btn-default">filename.pdf</a>         
            <a href="#" class="btn btn-default">filename.pdf</a>
            <a href="#" class="btn btn-default">filename.pdf</a>
        </div>
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop