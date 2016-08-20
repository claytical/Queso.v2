@extends('frontend.layouts.master')

@section('content')
<h2>Progress</h2>

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
                {!! $total_points !!}
            </div>
    </div>

</div>
<h3>Quests Completed</h3>
        <div class="col-lg-12">

            @foreach($quests as $quest)
                <div class="col-lg-6">
                    <h4>{!! $quest['quest']->name !!} </h4>
                    {!! $quest['quest']->instructions !!}
                    <h5>Submitted {!! date('m-d-Y', strtotime($quest['quest']->created_at)) !!}</h5>

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
    </script>
@stop