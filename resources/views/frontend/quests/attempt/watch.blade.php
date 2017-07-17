@extends('frontend.layouts.master')

@section('content')
<section class="hero is-bold is-light" id="quest_attempt">
    <div class="hero-body">
        <div class="container is-fluid">        
            {!! Form::open(array('url' => 'quest/watched')) !!}
            {!! Form::hidden('quest_id', $quest->id) !!}
            {!! Form::hidden('user_id', access()->user()->id) !!}

            <h2 class="title">{!! $quest->name !!}</h2>
            <h3 class="subtitle">{!! $quest->instructions !!}</h3>

            <div class="tile">
                <div class="tile is-parent">
                    <div class="tile is-child">
                        <div id="player"></div>
                    </div>
                    <div class="is-4 is-child box">
                      @foreach($skills as $skill)
                        <h4>{!! $skill->name !!}</h4>
                        <progress class="progress is-success skill-{!! $skill->id !!}" value="0" max="{!! $skill->pivot->amount !!}">0</progress>                        
                        {!! Form::hidden('skills[]', 0, ['id' => 'skill-'.$skill->id]) !!}
                        {!! Form::hidden('skill_id[]', $skill->id, ['id' => 'v-skill-'.$skill->id]) !!}
                      @endforeach
                      {!! Form::submit('Claim Points', ['class' => 'button is-primary is-large submit-button', 'disabled' => '']) !!}

                    </div>
                </div>
            </div>
            
            {!! Form::close() !!}

        </div>
    </div>
</section>


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
          width: '99%',
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
            $('.progress.skill-{!! $skill->id !!}').attr('value', amount);

          @endforeach

          if (pct >= .99) {
            $('.submit-button').prop('disabled', false);
            @foreach($skills as $skill)
                $('#skill-{!! $skill->id !!}').val({!! $skill->pivot->amount !!});
            @endforeach
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