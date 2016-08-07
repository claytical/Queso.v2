@extends('frontend.layouts.master')

@section('content')
<h2>{!! $quest->name !!}</h2>

        <div class="col-lg-12">
            <div class="col-lg-6">
                {!! $quest->instructions !!}
            </div>
            <div class="col-lg-6">
            <ul class="unstyled-list">
                @foreach($skills as $skill)
                    <li>
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                {!! $skill->name !!}
                            </div>
                            <div class="col-lg-6">
                                {!! $skill->amount !!}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
                <h4>{!! $quest->skills()->sum('amount') !!} Points Total</h4>
                @if($quest->expires_at)
                <h4>Due {!! $quest->expires_at !!}</h4>
                @endif
                {!! Form::open(array('url' => 'quest/submit')) !!}
                {!! Form::hidden('quest_type', 'link') !!}        
                {!! Form::text('link', ''); !!}
                {!! Form::submit('Submit') !!}

                {!! Form::close() !!}

            </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop