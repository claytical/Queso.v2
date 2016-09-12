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
                        data-toggle="modal" data-target="#myModal"
                            @if($quest->quest_type_id == 1)
                                <h4>{{ link_to('quest/'.$quest->id.'/attempt/submission', $quest->name, ['data-toggle' => 'modal', 'data-target' => '#quest-' . $quest->id]) }}</h4>
                            @endif
                            @if($quest->quest_type_id == 2)
                                <h4>{{ $quest->name }}</h4>
                            @endif
                            @if($quest->quest_type_id == 3)
                                <h4>{{ link_to('quest/'.$quest->id.'/watch', $quest->name) }}</h4>
                            @endif

                            @if($quest->quest_type_id == 4)
                                <h4>{{ link_to('quest/'.$quest->id.'/attempt/link', $quest->name) }}</h4>
                            @endif
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
                    
                    @if($quest->quest_type_id == 1)
                        {{ link_to('quest/'.$quest->id.'/attempt/submission', 'Attempt', ['class' => 'btn btn-primary']) }}
                    @endif

                    @if($quest->quest_type_id == 3)
                        {{ link_to('quest/'.$quest->id.'/watch', 'Watch', ['class' => 'btn btn-primary']) }}
                    @endif
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->    
    @endforeach

@else
    <p>There are no available quests.</p>
@endif

@if($locked)
<h2>Quests Requiring Higher Skill Levels</h2>
        <div class="col-lg-12">

            @foreach($locked as $quest)
                <div class="row">
                    <div class="col-lg-12">
                            <h4>{{ $quest->name }}</h4>
                            <h5>{!! $quest->skills()->sum('amount') !!} Points</h5>

                    </div>
                    <div class="col-lg-12">
                        <p>{!! $quest->instructions !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
@endif

@if(!$revisable->isEmpty())
<h2>Quests That Can Be Revised for More Points</h2>
    
    <div class="col-lg-12">
        @foreach($revisable as $quest)

            <div class="row">
                <div class="col-lg-9">
                    <h4>{{ link_to('quest/'.$quest->id.'/revise', $quest->name) }}</h4>
                    <h5>{!! $quest->skills()->sum('amount') !!} Points</h5>
                    @if($quest->expires_at)
                    <h6>Due by {!! date('m-d-Y', strtotime($quest->expires_at)) !!}</h6>
                    @endif
                </div>
                <div class="col-lg-12">
                    {!! $quest->instructions !!}
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop