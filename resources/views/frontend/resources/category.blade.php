@extends('frontend.layouts.master')

@section('content')
<h2>{!! $title !!}</h2>
<div class="pull-right">
    {{ Form::select('default_course', array('1' => 'Date Posted', '2' => 'Name'), '2') }}
</div>
        <div class="col-lg-12">

    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
        <thead>
            <tr>
                <th data-field="name" 
                data-sortable="true">Name</th>
                <th data-field="posted" 
                data-sortable="true">Date Posted</th>
            </tr>            
        </thead>
            <tbody>
            @foreach($resources as $resource)
                <tr>
                    <td>{{ link_to('#', $resource->title, ['data-toggle' => 'modal', 'data-target' => '#resource-' . $resource->id]) }}</td>
                    <td>{!! date('m-d-Y', strtotime($resource->created_at)) !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @foreach($resources as $resource)

        <div class="modal fade" tabindex="-1" role="dialog" id="resource-{!! $resource->id !!}">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! $resource->title !!}</h4>
              </div>
              <div class="modal-body">
                <p>{!! $resource->description !!}</p>
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
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->    
    @endforeach

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop