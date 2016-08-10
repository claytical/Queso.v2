@extends('frontend.layouts.master')

@section('content')
<h2>{!! $quest->name !!}</h2>
        <div class="col-lg-12">
            <div id="player" class="col-md-9"></div>
            <div id="player" class="col-md-3">
                {!! Form::open(array('url' => 'quest/watched')) !!}
                @foreach($skills as $skill)
                <div class="progress skill-{!! $skill->id !!}">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="{!! $skill->pivot->amount !!}" style="width:0%;"></div>
                </div>
                {!! Form::hidden('skill[]', 0, ['id' => 'skill-'.$skill->id]) !!}
                {!! Form::hidden('skill_id[]', $skill->id, ['id' => 'v-skill-'.$skill->id]) !!}

                @endforeach
                {!! Form::submit('Get Points', ['class' => 'btn btn-primary btn-submit', 'disabled' => '']) !!}
                {!! Form::close() !!}
            </div>
        </div>

@endsection

@section('after-scripts-end')
    <script>
      var tag = document.createElement('script');
        
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          width: '100%',
          videoId: '{!! $quest->youtube_id !!}',
          playerVars: {'controls': 0, 'autoplay': 0},
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
//        event.target.playVideo();
        var checkinTime = player.getDuration();
        setInterval(checkin, checkinTime);

      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      function checkin() {
          var pct = (player.getCurrentTime()/player.getDuration());

          @foreach($skills as $skill)
            var amount = pct * {!! $skill->pivot->amount !!};
            $('#skill-{!! $skill->id !!}').val(amount);
          @endforeach
          $('.progress-bar').attr('style', 'width: '+(pct*100)+'%');
          if (pct >= .99) {
            $('.btn-submit').prop('disabled', false);
          }
      }

      var done = false;

      function onPlayerStateChange(event) {

      }

      function stopVideo() {
        player.stopVideo();
      }    
    </script>
@stop