@extends('frontend.layouts.master')

@section('content')
        <div class="col-lg-12">
            <div class="col-lg-9">
                <h2>{!! $quest->name !!}</h2>
                @if($quest->expires_at)
                    <h4>Due {!! date('m-d-Y', strtotime($quest->expires_at)) !!}</h4>
                @endif


                {!! $quest->instructions !!}
                {!! Form::open(array('url' => 'quest/submit', 'class' => 'form-inline')) !!}
                {!! Form::hidden('quest_id', $quest->id) !!}       
                {!! Form::hidden('revision', 0) !!}
                @if($quest->groups)
                <h5>Group Members</h5>
                    {!! Form::remainingStudentList('students[]', $quest->id, null, ['multiple' => 'multiple', 'class' => 'multiselect']) !!}
                @endif
                <h5>URL</h5>
                {!! Form::text('link', '', ['class' => 'form-control', 'placeholder' => 'http://www.example.com']); !!}

                {!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}

                {!! Form::close() !!}
            </div>
            <div class="col-lg-3">

                <div class="panel panel-default">
                  <div class="panel-heading"> {!! $quest->skills()->sum('amount') !!} Points Available</div>
                  <div class="panel-body">            
                        <ul class="list-unstyled">
                            @foreach($skills as $skill)
                                <li>
                                    <div class="col-lg-12">
                                        <div class="col-lg-9">
                                            {!! $skill->name !!}
                                        </div>
                                        <div class="col-lg-3">
                                            {!! $skill->pivot->amount !!}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    $(".multiselect").select2();

    </script>
@stop