@extends('frontend.layouts.master')

@section('content')
<section class="section dark-section" id="quest_attempt">
        <div class="container is-fluid">        
            {!! Form::open(array('url' => 'quest/submit', 'class' => '')) !!}
            {!! Form::hidden('quest_id', $quest->id) !!}       
            {!! Form::hidden('revision', 0) !!}

            <div class="tile">
                <div class="tile is-parent">
                    <div class="tile is-child">
                        <div class="tile box">
                            <h2 class="title headline is-uppercase">{!! $quest->name !!}</h2>
                            <h3 class="subtitle">{!! $quest->instructions !!}</h3>

                                <div class="field has-addons">
                                  <p class="control is-expanded">
                                    {!! Form::text('link', '', ['class' => 'input is-large', 'placeholder' => 'http://www.example.com']) !!}
                                  </p>
                                  <p class="control">
                                      {!! Form::submit('Submit', ['class' => 'button is-primary is-large']) !!}
                                  </p>
                                </div>
                        </div>
                    </div>

                    <div class="tile is-4 is-child">
                        <div class="tile box">
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

                            @if(count($skills) > 1)
                                @foreach($skills as $skill)
                                    <p>{!! $skill->name !!} <span class="is-pulled-right">{!! $skill->pivot->amount !!}</span></p>
                                @endforeach
                                <hr/>
                                <p>Total <span class="is-pulled-right">{!! $quest->skills()->sum('amount') !!}</span></p>
                            @else
                                <p>{!! $quest->skills()->sum('amount') !!} Points Available</p>
                            @endif
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