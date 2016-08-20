@extends('frontend.layouts.master')

@section('content')
<h2>Peer Feedback</h2>
<h3>{!! $quest->name !!}, {!! $user->name !!}</h3>
    <div class="col-lg-12">

        <div class="row">
            @if($quest->quest_type_id == 1)
                {!! $attempt->submission !!}
                @if(!$files->isEmpty())
                    <h6>Attached Files</h6>
                    @foreach($files as $file)
                        {!! link_to('public/uploads/' . $file->name, $file->name, ['class' => 'btn btn-default']) !!}
                    @endforeach
                @endif
            @endif

            @if($quest->quest_type_id == 4)
              <a href="{{ $attempt->url }}" data-iframely-url>{{ $attempt->url }}</a>
            @endif
        </div>

        <div class="row">

            <h4>What did you like?</h4>
            <p>Share your thoughts on what you liked about this.</p>
        </div>
        <div class="row">
            {!! Form::open(array('url' => 'quest/feedback')) !!}
            {!! Form::hidden('user_id', $user->id) !!}
            {!! Form::hidden('quest_id', $quest->id) !!}
            {!! Form::hidden('revision', $attempt->revision) !!}
            {!! Form::textarea('liked', null, ['class' => 'field', 'files' => true]) !!}

        </div>

        <div class="row">
            <h4>What could be improved?</h4>
            <p>Share your thoughts on where this could be improved. Is there something you wished they explored? Are there other possibilities to explore?</p>
        </div>
        <div class="row">
            {!! Form::textarea('suggestions', null, ['class' => 'field', 'files' => true]) !!}
            <hr/>
            {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-lg pull-right']) !!}
            {!! Form::close() !!}
        </div>
 
    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop