@extends('frontend.layouts.master')

@section('content')
<section class="section">

<div class="tile is-ancestor">
      <div class="tile is-parent is-vertical is-8">
        <div class="tile is-child">

            <h2 class="title">Available Quests</h2>

            <table class="table">
                <th>Quest</th>
                <th>Points Available</th>
                <th></th>
                <tbody>
                @foreach($available_quests as $quest)
                    <tr>
                        <td>{!! $quest->name !!} </td>
                        <td class="amount">{!! $quest->skills()->sum('amount') !!}</td>
                        <td><button class="button is-small">Add</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h2 class="title">Completed Quests</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th data-field="name" 
                        data-sortable="true">Quest</th>
                        <th data-field="revisions" 
                        data-sortable="true">Revisions</th>
                        <th data-field="points"
                        data-sortable="true">Points</th>
                        <th data-field="submitted" 
                        data-sortable="true">Submitted On</th>
                    </tr>            
                </thead>
                <tbody>
                    @foreach($quests as $quest)
                    <tr>
                        <td>
                        @if($quest['earned'])
                            {{ link_to('quest/' . $quest['quest']->id . '/feedback', $quest['quest']->name) }}
                        @else
                            {!! $quest['quest']->name !!}
                        @endif
                        <br/>
                                <em>{!! $quest['quest']->instructions !!}</em>
                            </td>
                        <td>
                            @if($quest['revisions'])
                                {!! count($quest['revisions']) !!}
                            @else
                                None
                            @endif
                        </td>
                        <td>

                            @foreach($quest['skills'] as $skill)
                                <p><strong>{!! $skill->name!!}</strong> <span class="is-pulled-right">{!! $skill->pivot->amount !!}</span></p>
                            @endforeach
                            
                            @if(!$quest['earned'])
                              <p><em>Pending</em></p>
                            @else
                                <progress class="progress is-small is-success" value="{!! $quest['earned'] !!}" min="0" max="{!! $quest['available'] !!}">{!! $quest['earned'] !!}</progress>                              
                            @endif
                        </td>
                        <td>{!! date('m/d/Y', strtotime($quest['quest']->created_at)) !!}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>          
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
            
            <h2 class="subtitle">Predicted Level</h2>
            <h5 id="predicted-level">{!! $current_level->name !!}</h5>
            <span id="potential-total">{!! $total_points !!}</span> / <span id="all-points">{!! $total_potential !!}</span>


            <a class="button is-medium is-fullwidth is-info" role="button" data-toggle="collapse" href="#availableQuests" aria-expanded="false" aria-controls="availableQuests">Grade Predictor</a>

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