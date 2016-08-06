@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Cloning {!! $quest->name !!}</h2>
    </div>
</div>

<div class="col-lg-8">
    <div id="quest_name">
        <div class="row">
            <div class="col-lg-12">
                    {!! Form::open(['url' => 'manage/quest/clone', 'id' => 'quest-clone-form']) !!}

                <h3>What's the name of this quest?</h3>
                    {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => $quest->name, 'id' => 'quest_title']) }}

                <h3>Describe this quest for the student. It could be a prompt for writing, guidelines for uploads, or whatever you want them to do in order to get points.</h3>
                    {!! Form::textarea('description', $quest->instructions, ['class' => 'field']) !!}




            </div>
        </div>
    </div>


</div>





<div class="col-lg-4">
    <h4>Options</h4>
    <div class="col-lg-12">
        @if($quest->quest_type_id == 3)
    <!-- VIDEO -->
        {{ Form::input('text', 'youtube_url', $quest->youtube_id, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch/?q=AAAAAAAA', 'id' => 'quest_url']) }}
        @endif

    <!-- GENERALIZED -->
        <label for="expiration" class="control-label">Expiration Date</label>

        {{ Form::input('date', 'expiration', $quest->expires_at, ['class' => 'form-control', 'id' => 'quest_expiration']) }}
        
        @if($quest->quest_type_id == 2)
    <!-- ACTIVITY -->
            <div class="checkbox">
              <label>
                {!! Form::checkbox('instant', 1, $quest->instant) !!}
                Instant Credit
              </label>
            </div>

        @endif
    <!-- LINK OR SUBMISSION -->
        @if($quest->quest_type_id == 4 || $quest->quest_type_id == 1)
            <div class="checkbox">
              <label>
                {!! Form::checkbox('peer_feedback', 1, $quest->peer_feedback) !!}
                Peer Feedback
              </label>
            </div>
        @endif
    <!-- SUBMISSION -->
        @if($quest->quest_type_id == 1)
            <div class="checkbox">
              <label>
                {!! Form::checkbox('revisions', 1, $quest->revisions) !!}
                Revisions
              </label>
            </div>
        @endif
    </div>
    <div class="col-lg-12">
        <h5>Skills</h5>
            @foreach($skills as $skill)
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="skill{!! $skill->id!!}" class="control-label">{!! $skill->name !!}</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="skill{!! $skill->id!!}" name="skill[]" value={!! $skill->pivot->amount!!}>
                        <input type="hidden" name="skill_id[]" class="" value={!! $skill->id !!}>
                    </div>
                </div>

            @endforeach
    </div>
    
    <div class="col-lg-12">
        <h5>Thresholds</h5>
        @foreach($thresholds as $threshold)
            <div class="form-group">
                <div class="col-sm-6">
                  <label for="threshold{!! $threshold->id!!}" class="control-label">{!! $threshold->skill->name !!}</label>
                </div>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="threshold{!! $threshold->id!!}" name="threshold[]" value={!! $threshold->amount!!}>
                    <input type="hidden" name="threshold_id[]" class="threshold-input" value={!! $threshold->id !!}>
                </div>
            </div>

        @endforeach
    </div>


    {!! Form::submit('Clone', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
    {!! Form::close() !!}

</div>
@endsection

@section('after-scripts-end')
    <script>



    </script>
@stop