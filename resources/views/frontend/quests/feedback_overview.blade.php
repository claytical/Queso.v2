@extends('frontend.layouts.master')

@section('content')
<section class="section">
    <div class="tile">
      <div class="tile is-6 is-parent">
        <div class="tile is-child">
            <h3 class="title">Feedback Received</h3>
            <hr/>
            @if($feedback_received)
                @foreach($feedback_received as $received)
                    @if($received->fulfilled > 0)
                        <h4 class="subtitle">{{ link_to('quest/'.$received->quest_id.'/feedback', $received->quest_name) }}</h4>
                        @if($received->fulfilled == 1)
                            <p>{!! $received->fulfilled !!} peer has submitted feedback!</p>
                        @else
                            <p>{!! $received->fulfilled !!} peers have submitted feedback!</p>
                        @endif
                    @else
                        <h4 class="subtitle">{!! $received->quest_name !!}</h4>
                        <p>No one has submitted feedback yet.</p>
                    @endif

                    @if($received->pending > 0)
                        <p>{!! count($received->requests) !!} requests pending.</p>
                    @endif
                @endforeach
            @else
                <p>You have not received any feedback.</p>                        
            @endif

        </div>
      </div>
      <div class="tile is-6 is-parent">
        <div class="tile is-child">
            <h3 class="title">Awaiting Feedback</h3>
            <hr/>
                @if($feedback_requested)
                    @foreach($feedback_requested as $request)
                        <h4 class="subtitle">{!! $request->quest_name !!}</h4>
                            @foreach($request->requests as $req)
                                <p>{{ link_to('review/'.$request->quest_id.'/'.$req->sender->id.'/'.$req->revision, $req->sender->name) }}</p>
                            @endforeach
                    @endforeach
                @else
                    <p>You have not requested any feedback.</p>
                @endif

        </div>
      </div>

    </div>
    <div class="container is-fluid">

    </div>
</section>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop