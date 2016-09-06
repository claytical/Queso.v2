@extends('frontend.layouts.master')

@section('content')
<h2>{!! $resource->title !!}</h2>
<h4>{!! date('m-d-Y', strtotime($resource->created_at)) !!}</h4>
<div class="row">
        <div class="col-lg-12">
            {!! $resource->description !!}
        </div>
        <div class="col-lg-12">
            <div>
                    @if($resource->link_label)
                         <a href="{{ $resource->link }}"l>{{ $resource->link_label }}</a>
                    @else
                        <a href="{{ $resource->link }}" data-iframely-url>{{ $resource->link }}</a>
                    @endif
            </div>
            @if(!$files->isEmpty())
                <h6>Attached Files</h6>
                @foreach($files as $file)
                    {!! link_to('uploads/' . $file->name, substr($file->name,5), ['class' => 'btn btn-default preview', 'download' => substr($file->name,5)]) !!}
                @endforeach 
            @endif
           </div>
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop