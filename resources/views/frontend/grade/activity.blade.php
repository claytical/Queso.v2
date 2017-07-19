@extends('frontend.layouts.master')

@section('content')
<section class="hero is-bold is-light" id="create_resource">
    <div class="hero-body">
        <div class="container is-fluid">        
            {!! Form::open(array('url' => 'grade/confirm/activity')) !!}
            {!! Form::hidden('quest_id', $quest->id ) !!}

            <div class="tile">
                <div class="tile is-parent">
                    <div class="tile is-child">
                        <div class="container is-fluid">
                          <h2 class="title">{!! $quest->name !!}</h2>
                          <h3 class="subtitle">{!! $quest->instructions !!}</h3>
                          <h4>Students Receiving Points</h4>
                            <div class="field">
                                <p class="control">
                                    <select name="students[]" class="multiselect input" multiple>
                                    @foreach($students as $student)
                                        <option value="{!! $student->id !!}">{!! $student->name !!}</option>
                                    @endforeach
                                </p>
                            </div>

                        <h4>Feedback to Student</h4>
                            {!! Form::hidden('quest_id', $quest->id) !!}
                            {!! Form::hidden('attempt_id', $attempt->id) !!}
                            {!! Form::textarea('feedback', null, ['class' => 'field', 'files' => true]) !!}
                        </div>
                    </div>
                </div>
            <div class="tile is-4 is-child box">

                @foreach($skills as $skill)
                  <div class="field">
                    <label class="label">{!! $skill->name !!}</label>                  
                    <div class="control">
                      <input type="range" min="0" step="1" class="point-val" value="0" name="skills[]" max="{!! $skill->pivot->amount !!}" id="skill-input-{{ $skill->id }}">
                      {!! Form::hidden('skill_id[]', $skill->id) !!}
                    </div>
                  </div>
                @endforeach
                <h5>Total Points Awarded</h5>
                <span id="total">0</span> of {!! $quest->skills()->sum('amount') !!}</h3>
                <div class="field">
                  {!! Form::submit('Grade', ['class' => 'button is-primary is-large is-fullwidth']) !!}
                </div>

            </div>
            {!! Form::close() !!}
          </div>
      </div>
    </div>
</section>


@endsection

@section('after-scripts-end')
<style>
.rangeslider__handle {
    text-align: center;
    font-weight: bold;
    font-size: 1.5em;
}
</style>

    <script>
        
        function updateHandle(el, val) {
          el.html(val);
        }
            @foreach($skills as $skill)
              $("#skill-input-{{ $skill->id }}").rangeslider({
                  polyfill: false,
                  onInit: function() {
                    updateHandle($('#skill-input-{{ $skill->id }}+.rangeslider .rangeslider__handle'), 0);
                  }
                  })
                .on('input', function() {
                    updateHandle($('#skill-input-{{ $skill->id }}+.rangeslider .rangeslider__handle'), this.value);
                });

            @endforeach


            $('.point-val').change(function() {
                var totz = 0;
                $( ".point-val" ).each(function( index ) {
                    if($(this).val()) {
                      totz = totz + parseInt($(this).val());
                    }
                  });
                $("span#total").html(totz);
            });



    </script>
@stop