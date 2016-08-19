@extends('frontend.layouts.master')

@section('content')

<h2>Available Quests</h2>
@if($unlocked)
            <div class="col-lg-12">

            @foreach($unlocked as $quest)
                <div class="row">
                    <div class="col-lg-12">
                        @if($quest->quest_type_id == 1)
                            <h4>{{ link_to('quest/'.$quest->id.'/attempt/submission', $quest->name) }}</h4>
                        @endif
                        @if($quest->quest_type_id == 2)
                            <h4>{{ $quest->name }}</h4>
                        @endif
                        @if($quest->quest_type_id == 3)
                            <h4>{{ link_to('quest/'.$quest->id.'/watch', $quest->name) }}</h4>
                        @endif

                        @if($quest->quest_type_id == 4)
                            <h4>{{ link_to('quest/'.$quest->id.'/attempt/link', $quest->name) }}</h4>
                        @endif
                        <h5>{!! $quest->skills()->sum('amount') !!} Points</h5>
                        @if($quest->expires_at)
                        <h6>Due by {!! date('m-d-Y', strtotime($quest->expires_at) !!}</h6>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <p>{!! $quest->instructions !!}</p>
                    </div>
                </div>
            @endforeach
            </div>
@else
<p>There are no available quests.</p>
@endif

@if($locked)
<h2>Quests Requiring Higher Skill Levels</h2>
        <div class="col-lg-12">

            @foreach($locked as $quest)
                <div class="row">
                    <div class="col-lg-12">
                            <h4>{{ $quest->name }}</h4>
                            <h5>{!! $quest->skills()->sum('amount') !!} Points</h5>

                    </div>
                    <div class="col-lg-12">
                        <p>{!! $quest->instructions !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
@endif

@if(!$revisable->isEmpty())
<h2>Quests That Can Be Revised for More Points</h2>
    
    <div class="col-lg-12">
        @foreach($revisable as $quest)

            <div class="row">
                <div class="col-lg-9">
                    <h4>{{ link_to('quest/'.$quest->id.'/revise', $quest->name) }}</h4>
                    <h5>{!! $quest->skills()->sum('amount') !!} Points</h5>
                    @if($quest->expires_at)
                    <h6>Due by {!! date('m-d-Y', strtotime($quest->expires_at) !!}</h6>
                    @endif
                </div>
                <div class="col-lg-12">
                    {!! $quest->instructions !!}
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop