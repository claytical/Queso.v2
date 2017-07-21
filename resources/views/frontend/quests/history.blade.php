@extends('frontend.layouts.master')

@section('content')
<section class="section">

<div class="tile is-ancestor">
      <div class="tile is-parent is-vertical is-8">
        <div class="tile is-child">
            <h2 class="title">Quests</h2>

            <div class="tabs">
              <ul>
                <li class="is-active"><a>Available</a></li>
                <li><a>Completed</a></li>
                <li><a>Revisable</a></li>
                <li><a>Locked</a></li>
              </ul>
            </div>

            <table class="table" id="completed">
                <thead>
                    <tr>
                        <th data-field="name" 
                        data-sortable="true">Name</th>
                        <th data-field="revisions" 
                        data-sortable="true">Revisions</th>
                        <th data-field="submitted" 
                        data-sortable="true">Submitted On</th>
                        <th data-field="points"
                        data-sortable="true">Points</th>
                    </tr>            
                </thead>
                <tbody>
                    @foreach($quests as $quest)
                    <tr>
                        <td>
                        @if($quest['earned'])
                            @if($quest['quest']->quest_type_id == 6 || $quest['quest']->quest_type_id == 7)
                                {{ link_to('quest/' . $quest['quest']->id . '/group/feedback', $quest['quest']->name) }}
                            @else
                                {{ link_to('quest/' . $quest['quest']->id . '/feedback', $quest['quest']->name) }}
                            @endif
                        @else
                            {!! $quest['quest']->name !!}

                        @endif

                        </td>
                        <td>
                            @if($quest['revisions'])
                                {!! count($quest['revisions']) !!}
                            @else
                                None
                            @endif
                        </td>
                        <td>{!! date('m/d', strtotime($quest['quest']->created_at)) !!}</td>

                        <td>
                            @if(!$quest['earned'])
                              <p><em>Pending</em></p>
                            @else
                                 <p>{!! $quest['earned'] !!} / {!! $quest['available'] !!}</p>
                            @endif
                            
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>  

    @if($unlocked)
        <table class="table" id="available">
            <thead>
                <tr>
                    <th data-field="name" 
                    data-sortable="true">Name</th>
                    <th data-field="points" 
                    data-sortable="true">Points</th>
                    <th data-field="course">Course</th>
                    <th data-field="expiration" 
                    data-sortable="true">Expires</th>
                </tr>            
            </thead>
            <tbody>

            @foreach($unlocked as $q)
                        <tr>
                            <td>
                                @if($q->quest_type_id == 1)
                                    <a href="{!! URL::to('quest/attempt/response/'.$q->id) !!}">{!! $q->name !!}</a>            
                                @endif
                                @if($q->quest_type_id == 2)
                                    {!! $q->name !!}
                                @endif
                                @if($q->quest_type_id == 3)
                                    <a href="{!! URL::to('quest/watch/'.$q->id) !!}">{!! $q->name !!}</a>                    
                                @endif
                                @if($q->quest_type_id == 4)
                                    <a href="{!! URL::to('quest/attempt/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 5)
                                    <a href="{!! URL::to('quest/attempt/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 6)
                                    <a href="{!! URL::to('quest/attempt/group/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 7)
                                    <a href="{!! URL::to('quest/attempt/group/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                            </td>
                            <td>
                                {!! $q->skills()->sum('amount') !!}
                            </td>
                            <td>{!! $q->course->name !!}</td>
                            <td>
                                @if($q->expires_at)
                                {!! date('m/d/Y', strtotime($q->expires_at)) !!}
                                @else
                                Never
                                @endif
                            </td>
                        </tr>
            @endforeach

                </tbody>
            </table>
    @else
        <p>There are no available quests.</p>
    @endif


    @if(!$revisable->isEmpty())
        <table class="table" data-toggle="table" id="revisable">
            <thead>
                <tr>
                    <th data-field="name" 
                    data-sortable="true">Name</th>
                    <th data-field="points" 
                    data-sortable="true">Points</th>
                    <th>Course</th>
                    <th data-field="expiration" 
                    data-sortable="true">Expires</th>
                </tr>            
            </thead>
                <tbody>
                @foreach($revisable as $q)
                            <tr>
                                <td>
                                    @if($q->quest_type_id == 1)
                                        <a href="{!! URL::to('quest/revise/response/'.$q->id) !!}">{!! $q->name !!}</a>            
                                    @endif
                                    @if($q->quest_type_id == 4)
                                        <a href="{!! URL::to('quest/revise/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                    @endif
                                    @if($q->quest_type_id == 5)
                                        <a href="{!! URL::to('quest/revise/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                    @endif
                                    @if($q->quest_type_id == 6)
                                        <a href="{!! URL::to('quest/revise/group/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                    @endif
                                    @if($q->quest_type_id == 7)
                                        <a href="{!! URL::to('quest/revise/group/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                    @endif
                                </td>
                                <td>
                                    {!! $q->skills()->sum('amount') !!}
                                </td>
                                <td>{!! $q->course->name !!}</td>
                                <td>
                                    @if($q->expires_at)
                                    {!! date('m-d-Y', strtotime($q->expires_at)) !!}
                                    @else
                                    Never
                                    @endif
                                </td>
                            </tr>
                @endforeach
                    </tbody>
                </table>
    @endif

    @if($locked)
        <table class="table table-hover" id="locked">
            <thead>
                <tr>
                    <th data-field="name" 
                    data-sortable="true">Name</th>
                    <th data-field="points" 
                    data-sortable="true">Points</th>
                    <th>Course</th>
                    <th data-field="expiration" 
                    data-sortable="true">Expires</th>
                </tr>            
            </thead>
            <tbody>
            @foreach($locked as $q)
                        <tr>
                            <td>
                                @if($q->quest_type_id == 1)
                                    <a href="{!! URL::to('quest/attempt/response/'.$q->id) !!}">{!! $q->name !!}</a>            
                                @endif
                                @if($q->quest_type_id == 2)
                                    {!! $q->name !!}
                                @endif
                                @if($q->quest_type_id == 3)
                                    <a href="{!! URL::to('quest/watch/'.$q->id) !!}">{!! $q->name !!}</a>                    
                                @endif
                                @if($q->quest_type_id == 4)
                                    <a href="{!! URL::to('quest/attempt/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 5)
                                    <a href="{!! URL::to('quest/attempt/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 6)
                                    <a href="{!! URL::to('quest/attempt/group/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 7)
                                    <a href="{!! URL::to('quest/attempt/group/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                            </td>
                            <td>
                                {!! $q->skills()->sum('amount') !!}
                            </td>
                            <td>{!! $q->course->name !!}</td>
                            <td>
                                @if($q->expires_at)
                                {!! date('m-d-Y', strtotime($q->expires_at)) !!}
                                @else
                                Never
                                @endif
                            </td>
                        </tr>
            @endforeach
            </tbody>
        </table>
    @endif







        </div>
      </div>
    <div class="tile is-parent is-vertical is-4">
        <div class="tile is-child">
            <h3 class="title">Current Level</h3>
            <h2 class="subtitle">{!! $current_level->name !!}</h2>
            <progress class="progress is-large is-success" value="{!! $total_points !!}" min="{!! $current_level->amount !!}" max="{!! $next_level->amount !!}">{!! $total_points !!}</progress>

            @if(count($skills) > 1)
                @foreach($skills as $skill)
                    <p><strong>{!! $skill['name'] !!}</strong> <span class="is-pulled-right">{!! $skill['amount'] !!}</span></p>
                @endforeach
                <hr/>
                <p><strong>Total</strong> <span class="is-pulled-right">{!! $total_points !!}</span></p>
            @else
                <p><strong>{!! $skill[0]['name'] !!}</strong> <span class="is-pulled-right">{!! $skill[0]['amount'] !!}</span></p>
            @endif
            </div>
    </div>
</div>
</section>
@endsection

@section('after-scripts-end')
    <script>
    $('.predictive').click(function() {
        addToPrediction($(this));

    });

    function addToPrediction(o) {
        o.unbind();
        o.removeClass( "btn-success predictive");
        o.addClass("btn-danger");
        o.text("Remove");
        o.parent().parent().children().eq(1).addClass('add-to-total');
        o.parent().parent().addClass("success");
        o.click(function() {
            removeFromPrediction(o);
        });
        calculatePrediction();
    }

    function removeFromPrediction(o) {
        o.unbind();
        o.removeClass("btn-danger");
        o.addClass("btn-success");
        o.text("Add");
        o.parent().parent().children().eq(1).removeClass('add-to-total');
        o.parent().parent().removeClass("success");
        o.click(function() {
            addToPrediction(o);
        });
        calculatePrediction();
    }

    function calculatePrediction() {

        var earned = parseInt($("#earned-points").text());
        var used = parseInt($("#used-points").text());

        $(".add-to-total").each(function( index ) {
            earned += parseInt($(this).text());
        });
        $(".add-to-total").each(function( index ) {
            used += parseInt($(this).text());
        });

        $("#potential-total").text(earned);
        $("#all-points").text(used);
     
        for(var i = 0; i < levels.length; i++) {
            if(earned >= levels[i].amount) {
                $("#predicted-level").text(levels[i].name);
            }
        }
    }

    </script>
@stop