@extends('frontend.layouts.master')

@section('content')
<section class="hero" id="clone_quest">
    {!! Form::open(['url' => 'manage/quest/create', 'id' => 'quest-clone-form']) !!}
    {!! Form::hidden('quest_type_id', $quest->quest_type_id) !!}
    {!! Form::hidden('instant', $quest->instant) !!}
    {!! Form::hidden('feedback', $quest->peer_feedback) !!}
    {!! Form::hidden('groups_allowed', $quest->groups) !!}
    {!! Form::hidden('revisions', $quest->revisions) !!}
    {!! Form::hidden('submissions_allowed', $quest->submissions_allowed) !!}
    {!! Form::hidden('uploads_allowed', $quest->uploads) !!}
    {!! Form::hidden('course_id', $quest->course_id) !!}



    @foreach($skills as $skill)
        <input type="hidden" id="skill{!! $skill->id!!}" name="skill[]" value={!! $skill->pivot->amount!!}>
        <input type="hidden" name="skill_id[]" class="" value={!! $skill->id !!}>
    @endforeach

    @foreach($thresholds as $threshold)
        <input type="hidden" class="form-control" id="threshold{!! $threshold->id!!}" name="threshold[]" value={!! $threshold->amount!!}>
        <input type="hidden" name="threshold_skill_id[]" class="threshold-input" value={!! $threshold->skill_id !!}>
    @endforeach

  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">Cloning {!! $quest->name !!}</h1>
            <div class="tile">
                <div class="tile is-8 is-parent">
                  <div class="tile is-child">
                  <!-- Title and Description -->                
                    <div class="field">
                      <p class="control">
                        {{ Form::input('text', 'name', null, ['class' => 'input is-large', 'placeholder' => $quest->name, 'id' => 'quest_title']) }}

                      </p>
                    </div>

                    <div class="field">
                      <p class="control">
                        {!! Form::textarea('description', $quest->instructions, ['class' => 'input']) !!}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="tile is-4 is-parent">
                    <div class="tile is-child notification">
                        <div class="field">
                            <p>The new quest will inherit everything from the quest you're cloning except the name.</p>
                        </div>
                        <div class="field">
                            <p class="control">
                            {!! Form::submit('Clone', ['class' => 'button is-primary is-large']) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
  </div>

{!! Form::close() !!}

</section>
@endsection

@section('after-scripts-end')
@stop