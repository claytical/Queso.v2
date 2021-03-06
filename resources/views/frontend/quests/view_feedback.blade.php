@extends('frontend.layouts.master')

@section('content')
@if($student->id == access()->user()->id)
    <h2>Feedback for {!! $quest->name !!}</h2>
@else
    {!! link_to('manage/student/' . $student->id, 'Back to Student Overview', ['class' => 'btn btn-default pull-right']) !!}
    <h2>{!! $student->name !!}, {!! $quest->name !!}</h2>
@endif
    <div class="row">
        <div class="col-lg-9">
            @if($quest->quest_type_id == 1)
                @if($attempt)
                    {!! $attempt->submission !!}
                @endif

             @if(!$files->isEmpty())
                    <h6>Attached Files</h6>
                    @foreach($files as $file)
                        {!! link_to('uploads/' . $file->name, substr($file->name,5), ['class' => 'btn btn-default preview', 'download' => substr($file->name,5)]) !!}
                    @endforeach
                @endif
            @endif

            @if($quest->quest_type_id == 4)
                @if($attempt)
                  <a href="{{ $attempt->url }}" data-iframely-url>{{ $attempt->url }}</a>
                @else
                 <p>Attempt Missing</p>
                @endif
            @endif

        </div>
        <div class="col-lg-3">
            @if($graded)
                <div class="col-lg-12">
                    <h4>Current Grade</h4>
                <dl class="dl-horizontal">
                    @foreach($quest_skills as $index => $quest_skill)
                        <dt>{!! $quest_skill->name !!}</dt>
                        @if(isset($skills[$index]))
                            <dd>{!! $skills[$index]->pivot->amount !!} / {!! $quest_skill->pivot->amount !!}</dd>
                        @else
                            <dd>Pending</dd>
                        @endif
                    @endforeach
                </dl>
        </div>
            @else
            <div class="col-lg-12">
                <h3><span class="label label-danger pull-right">UNGRADED</span></h3>
            </div>
            @endif

        </div>  
    </div>
            @if(!$positive->isEmpty())
         <div class="col-lg-12">
                <h4>What Your Peers Liked</h4>
                @foreach($positive as $feedback)            
                    <div class="col-lg-12">

                        <h6>{!! $feedback->user_from->name !!}</h6>
                        <a class="pull-right give-feedback" href="{!! url('feedback/like', [$feedback->id])!!}" role="button"><span class="glyphicon glyphicon-heart"></span></a>                        {!! $feedback->note !!}


                    </div>
                @endforeach
            </div>
            @endif
            @if(!$negative->isEmpty())
             <div class="col-lg-12">
                <h4>Suggestions From Your Peers</h4>
                @foreach($negative as $feedback)
                    <div class="col-lg-12">
                        <h6>{!! $feedback->user_from->name !!}</h6>
                          <a class="pull-right give-feedback" href="{!! url('feedback/like', [$feedback->id])!!}" role="button"><span class="glyphicon glyphicon-heart"></span></a>
                        {!! $feedback->note !!}

                    </div>    
                @endforeach
            </div>
            @endif
            @if($graded)
            <div class="col-lg-12">
                <h4>From The Professor</h4>
                @foreach($instructor_feedback as $feedback)
                    <h6>{!! date('m-d-Y', strtotime($feedback->created_at)) !!}</h6>
                    {!! $feedback->note !!}
                @endforeach
            </div>
            @endif
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