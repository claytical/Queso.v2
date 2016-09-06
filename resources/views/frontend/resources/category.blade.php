@extends('frontend.layouts.master')

@section('content')
<h2>{!! $title !!}</h2>
<div class="pull-right">
    {{ Form::select('default_course', array('1' => 'Date Posted', '2' => 'Name'), '2') }}
</div>
        <div class="col-lg-12">

            <div class="row">
                @foreach($resources as $resource)
                <div class="col-lg-12">
                    <h4>{!! $resource->title !!}</h4>
                    <h5>{!! date('m-d-Y', strtotime($resource->created_at)) !!}</h5>
                    {!! $resource->description !!}
                    <div>
                    @if($resource->link_label)
                     <a href="{{ $resource->link }}"l>{{ $resource->link_label }}</a>
                    @else
                     <a href="{{ $resource->link }}" data-iframely-url>{{ $resource->link }}</a>
                    @endif
                    </div>
                    @if(!$resource->files->isEmpty())
                        <h6>Attached Files</h6>
                        @foreach($resource->files as $file)
                            {!! link_to('uploads/' . $file->name, substr($file->name,5), ['class' => 'btn btn-default preview', 'download' => substr($file->name,5)]) !!}
                        @endforeach 
                    @endif
                </div>
                @endforeach
            
            </div>

        </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop