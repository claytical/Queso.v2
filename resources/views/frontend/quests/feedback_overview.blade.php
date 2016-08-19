@extends('frontend.layouts.master')

@section('content')
            <div class="col-lg-6">
                <h2>Feedback Received</h2>
                    @if($feedback_received)
                        @foreach($feedback_received as $received)
                            @if($received->fulfilled > 0)
                                <h4>{{ link_to('quest/'.$received->quest_id.'/feedback', $received->quest_name) }}</h4>
                                @if($received->fulfilled == 1)
                                    <p>{!! $received->fulfilled !!} peer has submitted feedback!</p>
                                @else
                                    <p>{!! $received->fulfilled !!} peers have submitted feedback!</p>
                                @endif
                            @else
                                <h4>{!! $received->quest_name !!}</h4>
                                <p>No one has submitted feedback yet.</p>
                            @endif

                            @if($received->pending > 0)
                                <h5>Waiting On</h5>
                                    <ul class="list-unstyled">
                                    @foreach($received->requests as $request)
                                        <li>{!! $request->sender->name!!}</li>                                
                                    @endforeach
                                    </ul>
                            @endif
                        @endforeach
                    @else
                        <p>You haven't received any feedback...</p>                        
                    @endif
            </div>

            <div class="col-lg-6">
                <h2>Feedback Requested</h2>
                @if($feedback_requested)
                    @foreach($feedback_requested as $request)
                        <h4>{!! $request->quest_name !!}</h4>
                        <ul class="list-unstyled">
                            @foreach($request->requests as $req)
                                <li>{{ link_to('review/'.$request->quest_id.'/'.$req->sender->id.'/'.$req->revision, $req->sender->name) }}</li>
                            @endforeach
                        </ul>      
                    @endforeach
                @else
                    <p>You haven't requested any feedback yet</p>
                @endif
                </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop