@extends('frontend.layouts.master')

@section('content')

<section class="section">

    <div class="tile is-ancestor">
          <div class="tile is-parent is-vertical is-8">
            <div class="tile is-child">
                @if($student->id == access()->user()->id)
                    @if($quest->quest_type_id == 2)
                    <h2 class="title">{!! $quest->name !!}</h2>
                    <h3 class="subtitle">Watched Video</h3>
                    @else
                    <h2 class="title">Feedback for {!! $quest->name !!}</h2>
                    @if($quest->groups)
                    <h3 class="subtitle">Group Members</h3>
                        @foreach($students as $s)
                            <p>{!! $s->name !!}</p>
                        @endforeach
                    @endif

                    @endif
                @else
                    {!! link_to('manage/student/' . $student->id, 'Back to Student Overview', ['class' => 'button is-primary is-small is-pulled-right is-outlined']) !!}
                    <h2 class="title">{!! $student->name !!}, {!! $quest->name !!}</h2>
                @endif
                <div class="content">
                @if($quest->quest_type_id == 1)
                    @if($attempt)
                        {!! $attempt->submission !!}
                    @endif
                @endif
    
                @if($quest->quest_type_id == 5 | $quest->quest_type_id == 6)
                    @if($files)
                        @foreach($files as $file)
                            <p>
                            {!! link_to('uploads/' . $file->name, substr($file->name,5), ['class' => 'preview', 'download' => substr($file->name,5)]) !!}
                            </p>
                        @endforeach
                    @endif
                @endif

                @if($quest->quest_type_id == 4 || $quest->quest_type_id == 7)
                    @if($attempt)
                      <a href="{{ $attempt->url }}" data-iframely-url>{{ $attempt->url }}</a>
                    @else
                     <p>Attempt Missing</p>
                    @endif
                @endif
                </div>

                @if(!$positive->isEmpty())
                    <h4 class="subtitle">What Your Peers Liked</h4>
                        @foreach($positive as $feedback)
                        <div class="content">
                            <blockquote>
                            
                            <a class="pull-right give-feedback" href="{!! url('feedback/like', [$feedback->id])!!}" role="button"><span class="glyphicon glyphicon-heart"></span></a>
                            {!! $feedback->note !!}
                            <br/>
                            &mdash;{!! $feedback->user_from->name !!}
                            </blockquote>
                        </div>
                    @endforeach
                @endif

                @if(!$negative->isEmpty())
                    <h4 class="subtitle">Suggestions From Your Peers</h4>
                    @foreach($negative as $feedback)
                        <div class="content">
                            <blockquote>
                              <a class="is-pulled-right give-feedback" href="{!! url('feedback/like', [$feedback->id])!!}" role="button"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            {!! $feedback->note !!}
                            <br/>
                            &mdash;{!! $feedback->user_from->name !!}

                            </blockquote>
                        </div>    
                    @endforeach
                @endif

                @if($graded)
                    @foreach($instructor_feedback as $feedback)
                        <div class="content">    
                            <h4>From The Professor</h4>
                            <blockquote>
                                <h6>{!! date('m/d/Y', strtotime($feedback->created_at)) !!}</h6>
                                {!! $feedback->note !!}
                            </blockquote>
                        </div>
                    @endforeach
                @endif

            </div>
      </div>
    <div class="tile is-parent is-vertical is-4">
        <div class="tile is-child">
            @if($graded)
                <h3 class="title">Current Grade</h3>
                    @if(count($quest_skills) > 1)
                        @foreach($quest_skills as $index => $quest_skill)
                            <p>{!! $quest_skill->name !!} 
                                <span class="is-pulled-right">
                                @if(isset($skills[$index]))
                                   {!! $skills[$index]->pivot->amount !!} / {!! $quest_skill->pivot->amount !!}
                                @else
                                   Pending
                                @endif
                                </span>
                            </p>
                        @endforeach
                    @else
                        @foreach($quest_skills as $index => $quest_skill)
                            <p>Total 
                                <span class="is-pulled-right">
                                @if(isset($skills[$index]))
                                   {!! $skills[$index]->pivot->amount !!} / {!! $quest_skill->pivot->amount !!}
                                @else
                                   Pending
                                @endif
                                </span>
                            </p>
                        @endforeach

                    @endif
            @else
                <h4 class="subtitle">UNGRADED</h4>
            @endif

            </div>
        </div>
    </div>
</section>
@endsection

@section('after-scripts-end')
<script>
	$(function(){
						
		// Hook up link click events to load content.
		$( ".give-feedback" ).click(
			function( objEvent ){
				var jLink = $( this );
				$.ajax(
					{
						url: jLink.attr( "href" ),
						type: "get",
						dataType: "json",
						error: function(){
							},
						
						beforeSend: function(){
						},
						
						complete: function(){
						},
						
						success: function( data ){
							jLink.hide();
						}
					}							
					);
				return( false );					
			});
	});    
    </script>
@stop