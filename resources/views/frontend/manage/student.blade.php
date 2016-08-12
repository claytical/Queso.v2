@extends('frontend.layouts.master')

@section('content')

    <div class="col-lg-12">
        <h2>{!! $student->name !!}</h2>
    </div>
    <div class="col-lg-6">
        <h4>{!! $team !!}</h4>
        <h4>{!! $total_points !!} points</h4>
        <h4>{!! $current_level->name !!}
        <h4>5 Loved Feedbacks</h4>
    </div>
    <div class="col-lg-6">
        SKILL DISTRIBUTION CHART
    </div>
    
<div class="col-lg-12">
@if($graded_quests)
    <h3>Graded Quests</h3>
    <!-- Links should be to view only, not add feedback -->
        <div class="col-lg-12">
            <div class="col-lg-4">
                <h5>Quest Name</h5>
            </div>
            <div class="col-lg-3">
                <h5>Submitted</h5>
            </div>
            <div class="col-lg-2">
                <h5>Revisions</h5>
            </div>
            
            <div class="col-lg-3">
                <h5>Points</h5>
            </div>

        </div>

        <div class="col-lg-12">
            <div id="submission-list">
                 <ul class="list-unstyled list">
                    @foreach($graded_quests as $quest)
                    <li>
                        <div class="col-lg-4 quest">
                            {!! $quest['quest']->name !!}
                        </div>

                        <div class="col-lg-3 date">
                            {!! $quest['quest']->created_at !!}
                        </div>
                        <div class="col-lg-2 revisions">
                            {!! $quest['revisions'] !!}
                        </div>
                        <div class="col-lg-3 points">
                            {!! $quest['earned'] !!} / {!! $quest['available'] !!}
                        </div>
                    @endforeach
                    </li>
                </ul>
            </div>
        </div>
    @else
    @endif
    @if($pending_quests)
    <h3>Pending Quests</h3>
    <!-- Links should be to grade submission -->
        <div class="col-lg-12">
            <div class="col-lg-4">
                <h5>Quest Name</h5>
            </div>
            <div class="col-lg-3">
                <h5>Submitted</h5>
            </div>
            <div class="col-lg-2">
                <h5>Revisions</h5>
            </div>
            
            <div class="col-lg-3">
                <h5>Points Available</h5>
            </div>

        </div>

        <div class="col-lg-12">
            <div id="pending-list">
                 <ul class="list-unstyled list">
                    @foreach($pending_quests as $quest)
                    <li>
                        <div class="col-lg-4 quest">
                            {!! $quest['quest']->name !!}
                        </div>

                        <div class="col-lg-3 date">
                            {!! $quest['quest']->created_at !!}
                        </div>
                        <div class="col-lg-2 revisions">
                            {!! $quest['revisions'] !!}
                        </div>
                        <div class="col-lg-3 points">
                            {!! $quest['available'] !!}
                        </div>

                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
    @endif
    @if($available_quests)
    <h3>Available Quests</h3>
    <!-- no links needed, unless on behalf of? -->
        <div class="col-lg-12">
            <div class="col-lg-9">
                <h5>Quest Name</h5>
            </div>
            
            <div class="col-lg-3">
                <h5>Points Available</h5>
            </div>

        </div>

        <div class="col-lg-12">
            <div id="available-list">
                 <ul class="list-unstyled list">
                    @foreach($available_quests as $quest)
                    <li>
                        <div class="col-lg-9 quest">
                            {!! $quest->name !!}
                        </div>
                        <div class="col-lg-3 points">
                            {!! $quest->skills()->sum('amount') !!}
                        </div>
                    </li>
                    @endforeach

                    @foreach($pending_quests as $quest)
                    <li>
                        <div class="col-lg-9 quest">
                            {!! $quest->name !!} <span class="label">LOCKED</span>
                        </div>
                        <div class="col-lg-3 points">
                            {!! $quest->skills()->sum('amount') !!}
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
        @else
        @endif

</div>
@endsection

@section('after-scripts-end')
    <script>
        var submission_list_options = {
        valueNames: [ 'quest', 'date', 'revisions', 'points' ]
            };
        var available_list_options = {
        valueNames: [ 'quest', 'points' ]
    };

    var completedList = new List('submission-list', submission_list_options);
    var availableList = new List('available-list', available_list_options);

    </script>
@stop