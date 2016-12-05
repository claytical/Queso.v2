@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Quests {{ link_to('manage/quest/create', 'New Quest', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>

@if(!$quests->isEmpty())
    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
            <thead>
                <th data-field="name" data-sortable="true">Quest</th>
                <th data-field="type" data-sortable="true">Type</th>
                <th data-field="actions" data-sortable="false"></th>
            </thead>
                @foreach($quests as $quest)
                    <tr>
                        <td>{{ link_to('manage/quest/'.$quest->id, $quest->name) }}</td>
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
                        <td>
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
                                    <li><a data-toggle="modal" data-target="#quest-{!! $quest->id !!}" href="#"><span class="glyphicon glyphicon-trash"></span> Delete</a></li>
                                  </ul>
                                </div>
                        </td>
                    </tr>
                @endforeach
    </table>

    @foreach($quests as $quest)
        <div class="modal fade" tabindex="-1" role="dialog" id="quest-{!! $quest->id !!}">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! $quest->name !!}</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete this quest?</p>
                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   {{ link_to('manage/quest/'.$quest->id.'/delete', 'Delete', ['class' => 'btn btn-danger']) }}
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->    

    @endforeach
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