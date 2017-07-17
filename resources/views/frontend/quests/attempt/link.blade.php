@extends('frontend.layouts.master')

@section('content')
<section class="hero is-bold is-light is-medium" id="quest_attempt">
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

                            <div class="field">
                                <p class="control">
                                @if($quest->groups)
                                    {!! Form::remainingStudentList('students[]', $quest->id, null, ['multiple' => 'multiple', 'class' => 'multiselect input']) !!}
                                @endif
                                </p>
                            </div>
                            <div class="field has-addons">
                              <p class="control">
                                {!! Form::text('link', '', ['class' => 'input is-large', 'placeholder' => 'http://www.example.com']) !!}
                              </p>
                              <p class="control">
                                  {!! Form::submit('Submit', ['class' => 'button is-primary is-large']) !!}
                              </p>
                            </div>
                    </div>
                    <div class="is-4 is-child box">
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