@extends('frontend.layouts.master')

@section('content')
<h2>Feedback for {!! $quest->name !!}</h2>
    <div class="row">
        <div class="col-lg-9">
            @if($quest->quest_type_id == 1)
                {!! $attempt->submission !!}
                @if($files)
                    <h6>Attached Files</h6>
                    @foreach($files as $file)
                        {!! link_to('public/uploads/' . $file->name, $file->name, ['class' => 'btn btn-default']) !!}
                    @endforeach
                @endif
            @endif

            @if($quest->quest_type_id == 4)
              <a href="{{ $attempt->url }}" data-iframely-url>{{ $attempt->url }}</a>
            @endif

        </div>
        <div class="col-lg-3">
            <div class="col-lg-9">
                Listening Skill
            </div>
            
            <div class="col-lg-3">
                10/15
            </div>

            <div class="col-lg-9">
                Speaking Skill
            </div>
            
            <div class="col-lg-3">
                15/20
            </div>
            <div class="col-lg-12">
                <hr/>
            </div>
            <div class="col-lg-9">
                Total Points
            </div>
            
            <div class="col-lg-3">
                25/35
            </div>


        </div>  
    </div>
            @if($positive)
                <h4>What Your Peers Liked</h4>
                @foreach($positive as $feedback)            
                    <div class="col-lg-12">
                        <h6>{!! $feedback->from_user_id !!}</h6>
                        {!! $feedback->note !!} <a class="btn btn-default pull-right" href="#" role="button"><span class="glyphicon glyphicon-heart"></span></a>
                    </div>
                @endforeach
            @endif
            @if($negative)
                <h4>Suggestions From Your Peers</h4>
                @foreach($negative as $feedback)
                    <div class="col-lg-12">
                        <h6>{!! $feedback->from_user_id !!}</h6>
                        {!! $feedback->note !!} <a class="btn btn-default pull-right" href="#" role="button"><span class="glyphicon glyphicon-heart"></span></a>

                    </div>    
                @endforeach
            @endif
            <div class="col-lg-12">
                <h4>From The Professor</h4>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. <a class="btn btn-default pull-right" href="#" role="button"><span class="glyphicon glyphicon-heart"></span></a></p>
            </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop