@extends('frontend.layouts.master')

@section('content')
<section class="hero is-bold is-light" id="quest_attempt">
    <div class="hero-body">
        <div class="container is-fluid">        
            {!! Form::open(array('url' => 'quest/submit', 'class' => '')) !!}
            {!! Form::hidden('quest_id', $quest->id) !!}       
            {!! Form::hidden('revision', $previous_attempt->revision + 1) !!}
            <h2 class="title">{!! $quest->name !!}</h2>
            <h3 class="subtitle">{!! $quest->instructions !!}</h3>

            <div class="tile">
                <div class="tile is-parent">
                    <div class="tile is-child">
                            <div class="field has-addons">
                              <p class="control is-expanded">
                                {!! Form::text('link', '', ['class' => 'input is-large', 'placeholder' => 'http://www.example.com']) !!}
                              </p>
                              <p class="control">
                                  {!! Form::submit('Submit', ['class' => 'button is-primary is-large']) !!}
                              </p>
                            </div>
                    </div>
                    <div class="is-4 is-child box">
                        @if(empty($existing_skills[0]))
                            <h3><span class="label is-danger">UNGRADED</span></h3>
                            <p>By submitting this revision, your previously submitted and ungraded attempt will be discarded.</p>
                        @endif

                        @if(!empty($existing_skills[0]))
                            <h4 class="subtitle">Current Grade</h4>
                            @foreach($skills as $index => $skill)
                                <h5>{!! $skill->name !!} <span class="is-pulled-right">{!! $existing_skills[$index]->pivot->amount !!} / {!! $skill->pivot->amount !!}</span></h5>
                                            
                            @endforeach
                                <h5>Total Points <span class="is-pulled-right">{!! $total !!} / {!! $quest->skills()->sum('amount') !!}</span></h5>
                        @endif

                        @if($quest->expires_at)
                            <h4 class="title">Due {!! date('m/d/Y', strtotime($quest->expires_at)) !!}</h4>
                        @endif

                        @if($files)
                            <p class="subtitle">Attached Files</p>

                            @foreach($files as $file)
                                <a class="level-item" href="{!! URL::to('uploads/' . $file->name) !!}" title="{!! substr($file->name,5) !!}" download>
                                <span class="icon is-small"><i class="fa fa-paperclip"></i></span> 
                                {!! substr($file->name,5) !!}
                                </a>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
            @if($positive->first())
                <h4>What Your Peers Liked</h4>
                <div class="content">
                @foreach($positive as $feedback)            
                    <blockquote>
                    <h5>{!! $feedback->user_from->name !!}, {!! date('m/d/Y', strtotime($feedback->created_at)) !!}</h5>
                    {!! $feedback->note !!}
                    </blockquote>
                @endforeach
                </div>
            @endif
            @if($negative->first())
                <h4>Suggestions From Your Peers</h4>
                <div class="content">
                @foreach($negative as $feedback)
                    <blockquote>
                    <h5>{!! $feedback->user_from->name !!}, {!! date('m/d/Y', strtotime($feedback->created_at)) !!}</h5>
                    {!! $feedback->note !!}    
                    </blockquote>
                @endforeach
                </div>
            @endif
            
            @if(!empty($existing_skills[0]))
                <h4>From The Professor</h4>
                <div class="content">
                @foreach($instructor_feedback as $feedback)
                    <blockquote>
                    <h6>Sent {!! date('m/d/Y', strtotime($feedback->created_at)) !!}</h6>
                    {!! $feedback->note !!}
                    </blockquote>
                @endforeach
                </div>
            @endif
            
            {!! Form::close() !!}

        </div>
    </div>
</section>

@endsection

@section('after-scripts-end')
    <script>
    $(".multiselect").select2();
    $( "form" ).submit(function( event ) {
        if($('input[name="link"]').val().length > 0) {

        }
        else {
            event.preventDefault();
            alert( "You need to enter a link into the text field." );
        }
    });


    </script>
@stop