@extends('frontend.layouts.master')

@section('content')

<div class="col-lg-9">
    <h2>Quest Name</h2>
    <h4>00 Points Available</h4>
</div>
  {!! Form::open(array('url' => 'grade/confirm/activity')) !!}

<div class="col-lg-3">

</div>


    <div class="col-lg-12">

        <h4>Feedback</h4>

        <div class="row">
            <div class="col-lg-9">
                {!! Form::textarea('notes', null, ['class' => 'field', 'files' => false]) !!}
            </div>
            <div class="col-lg-3">
                <div class="col-lg-12">
                  {{ Form::select('students', array('1' => 'Sally Fields', '2' => 'Tom Hanks'), '2') }}
                </div>
                <div class="col-lg-6">
                    <label>Skill #1</label>
                </div>
                <div class="col-lg-6">
                    <input type="number" class="form-control" id="skill1">
                </div>

                <div class="col-lg-6">
                    <label>Skill #2</label>
                </div>
                <div class="col-lg-6">
                    <input type="number" class="form-control" id="skill2">
                </div>

                <div class="col-lg-6">
                    <label>Skill #3</label>
                </div>
                <div class="col-lg-6">
                    <input type="number" class="form-control" id="skill3">
                </div>

                <hr/>

                <div class="col-lg-12">
                    <div class="pull-right">
                            <span>xx</span> / 50
                    </div>
                </div>

                  <div class="col-lg-12">
                    {!! Form::submit('Grade', ['class' => 'btn btn-primary btn-lg btn-block']) !!}

                  </div>
            </div>


        </div>
        {!! Form::close() !!}

    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop