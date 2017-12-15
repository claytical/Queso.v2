@extends('frontend.layouts.master')

@section('content')
<section class="section dark-section">

<div class="tile is-ancestor">
      <div class="tile is-parent is-vertical is-2">
        @include('frontend.includes.admin')
      </div>
      <div class="tile is-parent is-vertical is-6">
        <div class="tile is-child box">
            <h2 class="title headline is-uppercase">{!! $student->name !!}</h2>
                @if($graded_quests)

                    <h3 class="subtitle">Graded Quests</h3>

                    <table class="table">
                        <thead>
                            <tr>
                                <th data-field="name" 
                            data-sortable="true">Quest</th>
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
                            @if($quest['quest'])
                            <tr>
                                <td>
                                    {!! link_to('quest/'.$quest['quest']->id.'/feedback/'.$student->id,  $quest['quest']->name) !!}            
                                </td>
                                <td>
                                    {!! date('m/d/Y', strtotime($quest['history']->pivot->created_at)) !!}
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
                                    <a class="delete" href="{!! URL::to('manage/student/'.$student->id.'/remove/quest/'.$quest['quest']->id) !!}"></a>
                                </td>

                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif

                @if($pending_quests)

                <h3 class="subtitle">Pending Quests</h3>
                    <table class="table" data-classes="table-no-bordered">
                        <thead>
                            <tr>
                                <th data-field="name" 
                        data-sortable="true">Quest</th>
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
                                   @if($quest['quest'])

                                    <tr>
                                        <td>{!! $quest['quest']->name !!}</td>
                                        <td>{!! date('m/d/Y', strtotime($quest['quest']->created_at)) !!}</td>
                                        <td>{!! $quest['revisions'] !!}</td>
                                        <td>{!! $quest['available'] !!}</td>
                                        <td>
                                        <a class="delete" href="{!! URL::to('manage/student/'.$student->id.'/remove/quest/'.$quest['quest']->id) !!}"></a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                    </table>
                @endif

                @if($available_quests)
                    <h3 class="subtitle">Available Quests</h3>
                    <table class="table">
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
                            @if($quest['quest'])

                        <tr>
                            <td>{!! $quest->name !!}</td>
                            @if($quest->quest_type_id == 1)
                                <td>Response</td>
                            @endif
                            @if($quest->quest_type_id == 2)
                                <td>Activity</td>
                            @endif
                            @if($quest->quest_type_id == 3)
                                <td>Video</td>
                            @endif
                            @if($quest->quest_type_id == 4)
                                <td>Link</td>
                            @endif
                            @if($quest->quest_type_id == 5)
                                <td>Upload</td>
                            @endif
                            @if($quest->quest_type_id == 6)
                                <td>Group Upload</td>
                            @endif
                            @if($quest->quest_type_id == 7)
                                <td>Group Link</td>
                            @endif

                            @if($quest->expires_at)
                                <td>{!! date('m/d/Y', strtotime($quest->expires_at)) !!}</td>
                            @else
                                <td>Never</td>
                            @endif

                            <td>{!! $quest->skills()->sum('amount') !!}</td>
                        </tr>
                            @endif
                        @endforeach

                        @foreach($locked_quests as $quest)
                            @if($quest['quest'])

                            <tr>
                                <td>{!! $quest->name !!} <span class="is-pulled-right tag is-warning">LOCKED</span></td>
                                @if($quest->quest_type_id == 1)
                                    <td>Response</td>
                                @endif
                                @if($quest->quest_type_id == 2)
                                    <td>Activity</td>
                                @endif
                                @if($quest->quest_type_id == 3)
                                    <td>Video</td>
                                @endif
                                @if($quest->quest_type_id == 4)
                                    <td>Link</td>
                                @endif
                                @if($quest->quest_type_id == 5)
                                    <td>Upload</td>
                                @endif
                                @if($quest->quest_type_id == 6)
                                    <td>Group Upload</td>
                                @endif
                                @if($quest->quest_type_id == 7)
                                    <td>Group Link</td>
                                @endif

                                @if($quest->expires_at)
                                    <td>{!! date('m/d/Y', strtotime($quest->expires_at)) !!}</td>
                                @else
                                    <td>Never</td>
                                @endif

                                <td>{!! $quest->skills()->sum('amount') !!}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
        </div>
      </div>
    <div class="tile is-parent is-vertical is-4">
        <div class="tile is-child box">
            <h2 class="title headline is-uppercase">Current Level</h2>
            <h3 class="subtitle">{!! $current_level->name !!}</h3>
            <progress class="progress is-large is-success" value="{!! $total_points !!}" min="{!! $current_level->amount !!}" max="{!! $total_points_potential !!} "></progress>

            @if(count($acquired_skills) > 1)
                @foreach($acquired_skills as $skill)
                        <p>{!! $skill['name'] !!} <span class="is-pulled-right">{!! $skill['amount'] !!}</span></p>

                @endforeach
                    <hr/>
                    <p>Total <span class="is-pulled-right">{!! $total_points !!}</span></p>           
            @else
                    <p>Total <span class="is-pulled-right">{!! $total_points !!}</span></p>           
            @endif

            @if($team)
                <br/>
                <h3 class="subtitle">Teams</h3>            
                    <a class="button is-small is-pulled-right is-danger" href="{!! URL::to('manage/student/'.$student->id.'/team/remove') !!}">Remove</a>
                    <p>Current Team: {!! $team->name !!}</p>                
            @else
            @endif
            @foreach($teams as $team)            
                <p>{!! link_to('manage/student/'.$student->id.'/team/assign/'.$team->id, "Assign to " . $team->name) !!}</p>
            @endforeach
        </div>
    </div>
</div>
</section>

@endsection

@section('after-scripts-end')
    <script>

    </script>
@stop