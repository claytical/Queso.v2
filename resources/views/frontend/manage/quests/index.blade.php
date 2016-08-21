@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Quests {{ link_to('manage/quest/create', 'New Quest', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>

@if(!$quests->isEmpty())
<div class="row">
        <div class="col-lg-9">
            <h5>Quest Name</h5>
        </div>
        <div class="col-lg-3">
            <h5></h5>
        </div>
        <div class="col-lg-12">
             <ul class="list-unstyled list">

                @foreach($quests as $quest)
                <li>
                    <div class="row extra-top-padding">
                        <div class="col-lg-6 quest">
                            {{ link_to('manage/quest/'.$quest->id, $quest->name) }}
                        </div>

                        <div class="col-lg-3 category">
                            
                        </div>
                        <div class="col-lg-3">

                            <div class="btn-group">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                              @if($quest->instant)
                                <li><a href="{!! url('manage/quest/'.$quest->id.'/qrcards');!!}"><span class="glyphicon glyphicon-qrcode"></span> QR Code Sheet</a></li>

                              @endif
                                <li><a href="{!! url('manage/quest/'.$quest->id.'/clone');!!}"><span class="glyphicon glyphicon-copy"></span> Clone</a></li>
                                <li><a href="{!! url('manage/quest/'.$quest->id.'/delete');!!}"><span class="glyphicon glyphicon-trash"></span> Delete</a></li>
                              </ul>
                            </div>
                        </div>                         
                    </div>
                </li>
                @endforeach
            </ul>
    </div>
</div>
@else
<p class="lead">There are currently no quests.</p>
@endif


@endsection

@section('after-scripts-end')
    <script>
  /*      var quest_list_options = {
        valueNames: [ 'submission', 'date', 'student' ]
    };
*/
//    var hackerList = new List('submission-list', submission_list_options);
    </script>
@stop