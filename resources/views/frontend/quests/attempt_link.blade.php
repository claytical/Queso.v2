@extends('frontend.layouts.master')

@section('content')
        <div class="col-lg-12">
            <div class="col-lg-6">
                <h2>{!! $quest->name !!}</h2>
                {!! $quest->instructions !!}
                {!! Form::open(array('url' => 'quest/submit', 'class' => 'form-inline')) !!}
                {!! Form::hidden('quest_type', 'link') !!}        
                <div class="form-group">
                    {!! Form::text('link', '', ['class' => 'form-control']); !!}
                </div>

                {!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}

                {!! Form::close() !!}
            </div>
            <div class="col-lg-6">
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
                    <li role="separator" class="divider"></li>
                    <li>
                        <div class="col-lg-12">
                            <div class="col-lg-9">
                            Points Total
                            </div>
                            <div class="col-lg-3">
                                {!! $quest->skills()->sum('amount') !!}
                            </div>
                        </div>
                    </li>
            </ul>
                @if($quest->expires_at)
                <h4>Due {!! $quest->expires_at !!}</h4>
                @endif


            </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop