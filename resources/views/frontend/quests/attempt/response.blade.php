@extends('frontend.layouts.master')

@section('content')
<section class="section dark-section" id="attempt_quest">
    <div class="box">
        <div class="container is-fluid">        
            {!! Form::open(array('url' => 'quest/submit', 'class' => '')) !!}
            {!! Form::hidden('quest_id', $quest->id) !!}       
            {!! Form::hidden('revision', 0) !!}

            <div class="tile">
                <div class="tile is-child">
                    <h2 class="title headline is-uppercase">{!! $quest->name !!}</h2>
                    <h3 class="subtitle">{!! $quest->instructions !!}</h3>
                    <div class="field">
                        <p class="control">
                            {!! Form::textarea('submission', ''); !!}
                        </p>
                    </div>
                </div>
                <div class="tile is-4">
                    <div class="tile is-child">
                    @if($quest->expires_at)
                        <h4 class="title">Due {!! date('m-d-Y', strtotime($quest->expires_at)) !!}</h4>
                    @endif

                    @if(!$files->isEmpty())
                        <p class="subtitle">Attached Files</p>

                        @foreach($files as $file)
                            <a class="level-item" href="{!! URL::to('uploads/' . $file->name) !!}" title="{!! substr($file->name,5) !!}" download>
                            <span class="icon is-small"><i class="fa fa-paperclip"></i></span> 
                            {!! substr($file->name,5) !!}
                            </a>
                        @endforeach
                    @endif
                    <h3 class="subtitle">{!! $quest->skills()->sum('amount') !!} Points Available</h3>
                        @foreach($skills as $skill)
                            <p>{!! $skill->name !!} <span class="is-pulled-right">{!! $skill->pivot->amount !!}</span></p>
                       @endforeach
                    <div class="field">
                        <p class="control">
                        {!! Form::submit('Submit', ['class' => 'button is-primary is-large is-fullwidth']) !!}
                        </p>
                    </div>

                    </div>
                </div>
            </div>
        </div>
            {!! Form::close() !!}
    </div>
</section>

@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop