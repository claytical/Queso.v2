@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Quests {{ link_to('manage/quest/create', 'New Quest', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>

@if(!$quests->isEmpty())
    <table class="table table-hover">
            <thead>
                <th>Quest</th>
                <th></th>
                <th></th>
            </thead>
                @foreach($quests as $quest)
                    <tr>
                        <td>{{ link_to('manage/quest/'.$quest->id, $quest->name) }}</td>
                        <td></td>
                        <td>
                            <div class="pull-right">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                  <li>{{ link_to('manage/quest/'.$quest->id, 'Edit') }}</li>
                                    <li>{{ link_to('quest/'.$quest->id.'/attempt/submission', 'View as Student')}}</li>
                                  @if($quest->instant)
                                    <li><a href="{!! url('manage/quest/'.$quest->id.'/qrcards');!!}" target="_blank"><span class="glyphicon glyphicon-qrcode"></span> QR Code Sheet</a></li>
                                  @endif
                                    <li><a href="{!! url('manage/quest/'.$quest->id.'/clone');!!}"><span class="glyphicon glyphicon-copy"></span> Clone</a></li>
                                    <li><a href="{!! url('manage/quest/'.$quest->id.'/delete');!!}"><span class="glyphicon glyphicon-trash"></span> Delete</a></li>
                                  </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
    </table>
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