@extends('frontend.layouts.master')

@section('content')

    <div class="col-lg-12">
        <h2>{!! $student->name !!}</h2>
    </div>
    <div class="col-lg-6">
        <div class="btn-group pull-right">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! $team->name !!} <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        @foreach($teams as $team)
                            <li>{!! link_to('manage/student/'.$student->id.'/team/assign/'.$team->id, $team->name) !!}</li>
                        @endforeach
                            <li role="separator" class="divider"></li>
                            <li>{!! link_to('manage/student/'.$student->id.'/team/remove', 'Remove Team Assignment') !!}</li>
                      </ul>
        </div>
    <h4>{!! $current_level->name !!}, {!! $total_points !!} / {!! $total_points_potential !!} points</h4>
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="{!! $total_points !!}" aria-valuemin="{!! $current_level->amount !!}" aria-valuemax="{!! $next_level->amount !!}" style="width: {!! $percentage !!}%;">


            <span class="sr-only"></span>
          </div>
        </div>
    </div>
    <div class="col-lg-6">
        <dl class="dl-horizontal">
            @foreach($acquired_skills as $skill)
                    <dt>{!! $skill['name'] !!}</dt>
                    <dd>{!! $skill['amount'] !!}</dd>
            @endforeach
        </dl>    
    </div>

<div class="col-lg-12">
@if($graded_quests)

    <h3>Graded Quests</h3>

    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
        <thead>
            <tr>
                <th data-field="name" 
            data-sortable="true">Name</th>
                <th data-field="submitted" 
            data-sortable="true">Submitted On</th>
                <th data-field="revisions" 
            data-sortable="true">Revisions</th>
                <th data-field="points" 
            data-sortable="true">Points</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($graded_quests as $quest)
            <tr>
                <td>
                    {!! link_to('quest/'.$quest['quest']->id.'/feedback/'.$student->id,  $quest['quest']->name) !!}            
                </td>
                <td>
                    {!! date('m-d-Y', strtotime($quest['history']->pivot->created_at)) !!}
                </td>
                <td>
                    @if($quest['quest_master']->revisions)
                        {!! $quest['revisions'] !!}
                    @else
                    N/A
                    @endif
                </td>
                <td>
                    {!! $quest['earned'] !!} / {!! $quest['available'] !!}
                </td>
                <td>
                    <div class="btn-group pull-right">
                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                        <li>{!! link_to('manage/student/'.$student->id.'/remove/quest/'.$quest['quest']->id, 'Remove') !!}</li>
                                  </ul>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    @endif
    @if($pending_quests)
    <h3>Pending Quests</h3>
        <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
            <thead>
                <tr>
                    <th data-field="name" 
            data-sortable="true">Name</th>
                    <th data-field="submitted" 
            data-sortable="true">Submitted On</th>
                    <th data-field="revisions" 
            data-sortable="true">Revisions</th>
                    <th data-field="points" 
            data-sortable="true">Points</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                    @foreach($pending_quests as $quest)
                    <tr>
                        <td>{!! $quest['quest']->name !!}</td>
                        <td>{!! date('m-d-Y', strtotime($quest['quest']->created_at)) !!}</td>
                        <td>{!! $quest['revisions'] !!}</td>
                        <td>{!! $quest['available'] !!}</td>
                        <td>
                            <div class="btn-group pull-right">
                                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu">
                                                <li>{!! link_to('manage/student/'.$student->id.'/remove/quest/'.$quest['quest']->id, 'Remove') !!}</li>
                                          </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    @else
    @endif

    @if($available_quests)
    <h3>Available Quests</h3>
    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
        <thead>
            <tr>
                <th data-field="name" 
            data-sortable="true">Name</th>
                <th data-field="type" 
            data-sortable="true">Type</th>
                <th data-field="expires" 
            data-sortable="true">Expires</th>
                <th data-field="points" 
            data-sortable="true">Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach($available_quests as $quest)
            <tr>
                <td>{!! $quest->name !!}</td>
                @if($quest->quest_type_id == 1)
                    <td>Online Submission</td>
                @endif
                @if($quest->quest_type_id == 2)
                    <td>In Class Activity</td>
                @endif
                @if($quest->quest_type_id == 3)
                    <td>Video</td>
                @endif
                @if($quest->quest_type_id == 4)
                    <td>Link</td>
                @endif
                @if($quest->expires_at)
                    <td>{!! date('m-d-Y', strtotime($quest->expires_at)) !!}</td>
                @else
                    <td>Never</td>
                @endif

                <td>{!! $quest->skills()->sum('amount') !!}</td>
            </tr>
            @endforeach

            @foreach($locked_quests as $quest)
            <tr>
                <td>{!! $quest->name !!} <span class="badge pull-right">LOCKED</span></td>
                @if($quest->quest_type_id == 1)
                    <td>Online Submission</td>
                @endif
                @if($quest->quest_type_id == 2)
                    <td>In Class Activity</td>
                @endif
                @if($quest->quest_type_id == 3)
                    <td>Video</td>
                @endif
                @if($quest->quest_type_id == 4)
                    <td>Link</td>
                @endif
                @if($quest->expires_at)
                    <td>{!! date('m-d-Y', strtotime($quest->expires_at)) !!}</td>
                @else
                    <td>Never</td>
                @endif

                <td>{!! $quest->skills()->sum('amount') !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
        @else
        @endif

</div>
@endsection

@section('after-scripts-end')
    <script>

    </script>
@stop