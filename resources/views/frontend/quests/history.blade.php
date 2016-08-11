@extends('frontend.layouts.master')

@section('content')
<h2>Progress</h2>

        <div class="col-lg-12">

            @foreach($quests as $quest)
                <div class="col-lg-6">
                    <h4>{!! $quest['quest']->name !!} </h4>
                    {!! $quest['quest']->instructions !!}
                    <h5>Submitted {!! $quest['quest']->created_at !!}</h5>

                    @if($quest['revisions'])
                    <h6>Revisions</h6>
                        <ul>
                        @foreach($quest['revisions'] as $revision)
                            <li>{!! $revision->created_at !!}</li>
                        @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col-lg-6">
                <h4>Points</h4>
                    @foreach($quest['skills'] as $skill)
                        <div class="col-lg-6">
                            {!! $skill->name!!}
                        </div>
                        <div class="col-lg-6">
                            {!! $skill->pivot->amount !!}
                        </div>
                    @endforeach
                        <div class="col-lg-6">
                            Total Points
                        </div>

                        <div class="col-lg-6">
                            {!! $quest['earned'] !!} / {!! $quest['available'] !!}
                        </div>
                    </div>
                </div>
            @endforeach
 
         </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop