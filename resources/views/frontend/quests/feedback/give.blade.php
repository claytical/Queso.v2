@extends('frontend.layouts.master')

@section('content')

<section class="section dark-section" id="feedback">
    {!! Form::open(array('url' => 'quest/feedback')) !!}

    <div class="box">
        <div class="container is-fluid">
            <h1 class="title headline is-uppercase">{!! $quest->name !!}</h1>
                <div class="content">
                    @if($quest->quest_type_id == 1)
                        {!! $attempt->submission !!}
                    @endif

                    @if($quest->quest_type_id == 5 || $quest->quest_type_id == 6)
                        @if(!$files->isEmpty())
                            @foreach($files as $file)
                                <p>{!! link_to('uploads/' . $file->name, substr($file->name,5), ['class' => 'preview', 'download' => substr($file->name,5)]) !!}</p>
                            @endforeach
                        @endif
                    @endif

                    @if($quest->quest_type_id == 4 || $quest->quest_type_id == 7)
                      <a href="{{ $attempt->url }}" data-iframely-url>{{ $attempt->url }}</a>
                    @endif
                    <hr/>
                </div>
                <div class="tile is-ancestor">
                    <div class="tile is-parent">
                        <div class="tile is-child is-6">
                            <h3 class="subtitle">What did you like?</h3>
                            <p>Share your thoughts on what you liked about this.</p>
                                {!! Form::hidden('user_id', $user->id) !!}
                                {!! Form::hidden('quest_id', $quest->id) !!}
                                {!! Form::hidden('revision', $attempt->revision) !!}
                                <div class="field">
                                    <p class="control">
                                        {!! Form::textarea('liked', null, ['class' => 'field', 'files' => true]) !!}            
                                    </p>
                                </div>
                        </div>
                        <div class="tile is-child is-6">
                            <h3 class="subtitle">What could be improved?</h3>
                            <p>Share your thoughts on how this could be improved.</p>
                            <div class="field" style="margin-left: 10px;">
                                <p class="control">
                                    {!! Form::textarea('suggestions', null, ['class' => 'field', 'files' => true]) !!}            
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tile is-parent">
                    {!! Form::submit('Submit', ['class' => 'button is-large is-primary is-fullwidth']) !!}        
                </div>

        </div>
    </div>
{!! Form::close() !!}

</section>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop