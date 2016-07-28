@extends('frontend.layouts.master')

@section('content')

    <div class="col-lg-12">
        <h2>Student Name</h2>
    </div>
    <div class="col-lg-6">
        <h4>Blue Team</h4>
        <h4>50 / 100 points</h4>
        <h4>5 Loved Feedbacks</h4>
    </div>
    <div class="col-lg-6">
        SKILL DISTRIBUTION CHART
    </div>

<div class="col-lg-12">
    <h3>Completed Quests</h3>
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
                    <li>
                        <div class="col-lg-4 quest">
                            Another Quest
                        </div>

                        <div class="col-lg-3 date">
                            00/00/0000
                        </div>
                        <div class="col-lg-2 revisions">
                            0
                        </div>
                        <div class="col-lg-3 points">
                            25 / 40
                        </div>

                    </li>

                    <li>
                        <div class="col-lg-4 quest">
                            First Quest
                        </div>

                        <div class="col-lg-3 date">
                            00/00/0000
                        </div>
                        <div class="col-lg-2 revisions">
                            1
                        </div>
                        <div class="col-lg-3 points">
                            60 / 60
                        </div>

                    </li>

                </ul>
            </div>
        </div>

    <h3>Available Quests</h3>
        <div class="col-lg-12">
            <div class="col-lg-9">
                <h5>Quest Name</h5>
            </div>
            
            <div class="col-lg-3">
                <h5>Points</h5>
            </div>

        </div>

        <div class="col-lg-12">
            <div id="available-list">
                 <ul class="list-unstyled list">
                    <li>
                        <div class="col-lg-9 quest">
                            Life Questions
                        </div>
                        <div class="col-lg-3 points">
                            40
                        </div>

                    </li>

                    <li>
                        <div class="col-lg-9 quest">
                           Second Quest
                        </div>

                        <div class="col-lg-3 points">
                            60
                        </div>

                    </li>

                </ul>
            </div>
        </div>

    <div>
    PROJECTION CHART
    </div>
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