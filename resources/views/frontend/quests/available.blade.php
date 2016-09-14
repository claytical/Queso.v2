@extends('frontend.layouts.master')

@section('content')

<h2>Available Quests</h2>
@if($unlocked)
    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
        <thead>
            <tr>
                <th data-field="name" 
                data-sortable="true">Quest</th>
                <th data-field="points" 
                data-sortable="true">Points</th>
                <th data-field="expiration" 
                data-sortable="true">Expires</th>
            </tr>            
        </thead>
            <tbody>

                @foreach($unlocked as $quest)
                    <tr>
                        <td>
                            {{ link_to('#', $quest->name, ['data-toggle' => 'modal', 'data-target' => '#quest-' . $quest->id]) }}
                        </td>
                        <td>
                            {!! $quest->skills()->sum('amount') !!}
                        </td>
                        <td>
                            @if($quest->expires_at)
                            {!! date('m-d-Y', strtotime($quest->expires_at)) !!}
                            @else
                            Never
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @foreach($unlocked as $quest)

        <div class="modal fade" tabindex="-1" role="dialog" id="quest-{!! $quest->id !!}">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! $quest->name !!}</h4>
              </div>
              <div class="modal-body">
                <p>{!! $quest->instructions !!}</p>
                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    @if($quest->quest_type_id == 1)
                        {{ link_to('quest/'.$quest->id.'/attempt/submission', 'Attempt', ['class' => 'btn btn-primary']) }}
                    @endif

                    @if($quest->quest_type_id == 3)
                        {{ link_to('quest/'.$quest->id.'/watch', 'Watch', ['class' => 'btn btn-primary']) }}
                    @endif

                    @if($quest->quest_type_id == 4)
                        {{ link_to('quest/'.$quest->id.'/attempt/link', 'Attempt', ['class' => 'btn btn-primary']) }}
                    @endif

              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->    
    @endforeach

@else
    <p>There are no available quests.</p>
@endif

@if(!$revisable->isEmpty())
<h2>Quests That Can Be Revised for More Points</h2>
    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
        <thead>
            <tr>
                <th data-field="name" 
                data-sortable="true">Quest</th>
                <th data-field="points" 
                data-sortable="true">Points</th>
                <th data-field="expiration" 
                data-sortable="true">Expires</th>
            </tr>            
        </thead>
            <tbody>
        @foreach($revisable as $quest)
                    <tr>
                        <td>
                            {{ link_to('#', $quest->name, ['data-toggle' => 'modal', 'data-target' => '#quest-' . $quest->id]) }}
                        </td>
                        <td>
                            {!! $quest->skills()->sum('amount') !!}
                        </td>
                        <td>
                            @if($quest->expires_at)
                            {!! date('m-d-Y', strtotime($quest->expires_at)) !!}
                            @else
                            Never
                            @endif
                        </td>
                    </tr>
        @endforeach
                </tbody>
            </table>

    @foreach($revisable as $quest)

        <div class="modal fade" tabindex="-1" role="dialog" id="quest-{!! $quest->id !!}">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! $quest->name !!}</h4>
              </div>
              <div class="modal-body">
                <p>{!! $quest->instructions !!}</p>
                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{ link_to('quest/'.$quest->id.'/revise', 'Revise', ['class' => 'btn btn-primary']) }}
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->    
    @endforeach




@endif

@if($locked)
<h2>Quests Requiring Higher Skill Levels</h2>
    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
        <thead>
            <tr>
                <th data-field="name" 
                data-sortable="true">Quest</th>
                <th data-field="points" 
                data-sortable="true">Points</th>
                <th data-field="expiration" 
                data-sortable="true">Expires</th>
            </tr>            
        </thead>
        <tbody>
            @foreach($locked as $quest)
                    <tr>
                        <td>
                            {{ link_to('#', $quest->name, ['data-toggle' => 'modal', 'data-target' => '#quest-' . $quest->id]) }}
                        </td>
                        <td>
                            {!! $quest->skills()->sum('amount') !!}
                        </td>
                        <td>
                            @if($quest->expires_at)
                            {!! date('m-d-Y', strtotime($quest->expires_at)) !!}
                            @else
                            Never
                            @endif
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
    @foreach($locked as $quest)

        <div class="modal fade" tabindex="-1" role="dialog" id="quest-{!! $quest->id !!}">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! $quest->name !!}</h4>
              </div>
              <div class="modal-body">
                <p>{!! $quest->instructions !!}</p>
                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->    
    @endforeach

@endif

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop