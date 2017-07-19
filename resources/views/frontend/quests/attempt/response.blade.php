@extends('frontend.layouts.master')

@section('content')
<section class="hero is-bold is-light is-medium" id="create_resource">
    <div class="hero-body">
        <div class="container is-fluid">        
            {!! Form::open(array('url' => 'quest/submit', 'class' => '')) !!}
            {!! Form::hidden('quest_id', $quest->id) !!}       
            {!! Form::hidden('revision', 0) !!}
            <h2 class="title">{!! $quest->name !!}</h2>
            <h3 class="subtitle">{!! $quest->instructions !!}</h3>

            <div class="tile">
                <div class="tile is-parent">
                    <div class="tile is-child">
                        <div class="container is-fluid">
                            <div class="field">
                                <p class="control">
                                    {!! Form::textarea('submission', ''); !!}
                                </p>
                            {!! Form::submit('Submit', ['class' => 'button is-primary is-large is-pulled-right']) !!}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tile is-4 is-parent box">
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
                    <p class="subtitle">{!! $quest->skills()->sum('amount') !!} Points Available</p>
                        @foreach($skills as $skill)
                            {!! $skill->name !!} / 
                            {!! $skill->pivot->amount !!}
                        @endforeach
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