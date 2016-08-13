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
                <a href="{{ $resource->link }}" data-iframely-url>{{ $resource->link }}</a>
            </div>
            @if($files)
                <h6>Attached Files</h6>
                @foreach($files as $file)
                    {!! link_to('public/uploads/' . $file->name, $file->name, ['class' => 'btn btn-default']) !!}
                @endforeach 
            @endif
           </div>
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop