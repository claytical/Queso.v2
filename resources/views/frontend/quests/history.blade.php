@extends('frontend.layouts.master')

@section('content')
<h2>Progress</h2>
<div style="display:none">
    @foreach($idz as $k)
    {!! $k !!}
    @endforeach

</div>
<div class="col-lg-12">
    <div class="col-lg-6">
    <h4>{!! $current_level->name !!}</h4>
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="{!! $total_points !!}" aria-valuemin="{!! $current_level->amount !!}" aria-valuemax="{!! $next_level->amount !!}" style="width: {!! $percentage !!}%;">


            <span class="sr-only"></span>
          </div>
        </div>
    </div>

    <div class="col-lg-6">
        @foreach($skills as $skill)
            <div class="col-lg-6">
                {!! $skill['name'] !!}
            </div>
            <div class="col-lg-6">
                {!! $skill['amount'] !!}
            </div>
        @endforeach
            <div class="col-lg-6">
                Total
            </div>
            <div class="col-lg-6">
                <span id="earned-points">{!! $total_points !!}</span> / <span id="used-points">{!! $total_potential !!}</span>
            </div>
    </div>

    <div class="col-lg-12">
        <a class="btn btn-primary pull-right" role="button" data-toggle="collapse" href="#availableQuests" aria-expanded="false" aria-controls="availableQuests">
          Grade Predictor
        </a>
        <hr/>
        <div class="collapse" id="availableQuests">
            <div class="col-lg-12">
            <h4>Predicted Level</h4>
            <h5 id="predicted-level">{!! $current_level->name !!}</h5>
            <span id="potential-total">{!! $total_points !!}</span> / <span id="all-points">{!! $total_potential !!}</span>
            </div>
            <table class="table table-hover">
                <th>Quest</th>
                <th>Points Available</th>
                <th></th>
                <tbody>
                @foreach($available_quests as $quest)
                    <tr>
                        <td>{!! $quest->name !!} </td>
                        <td class="amount">{!! $quest->skills()->sum('amount') !!}</td>
                        <td><button class="btn btn-success predictive pull-right btn-xs">Add</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
<h3>Quests Completed</h3>
        <div class="col-lg-12">

            @foreach($quests as $quest)
                <div class="col-lg-6">
                    <h4>{!! $quest['quest']->name !!} </h4>
                    <h5>Submitted {!! date('m-d-Y', strtotime($quest['quest']->created_at)) !!}</h5>
                    {!! $quest['quest']->instructions !!}

                    @if($quest['revisions'])
                    <h6>Revision History</h6>
                        <ul>
                        @foreach($quest['revisions'] as $revision)
                            <li>{!! date('m-d-Y', strtotime($revision->created_at)) !!}</li>
                        @endforeach
                        </ul>
                    @endif
                </div>

                <div class="col-lg-6">
                    <h5></h5>
                        @foreach($quest['skills'] as $skill)
                            <div class="col-lg-6">
                                {!! $skill->name!!}
                            </div>
                            <div class="col-lg-6">
                                {!! $skill->pivot->amount !!}
                            </div>
                        @endforeach
                        @if(!$quest['earned'])
                            <div class="col-lg-12 col-lg-offset-6">
                                <span class="label label-warning">Grade Pending</span>
                            </div>
                        @else
                            <hr/>
                            <div class="col-lg-6">
                                Total
                            </div>

                            <div class="col-lg-6">
                                {!! $quest['earned'] !!} / {!! $quest['available'] !!}
                            </div>

                        @endif
                </div>
            @endforeach
 
         </div>

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