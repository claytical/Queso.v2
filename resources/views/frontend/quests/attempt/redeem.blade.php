@extends('frontend.layouts.master')

@section('content')
<section class="hero is-bold is-light is-medium" id="quest_attempt">
    <div class="hero-body">
        <div class="container is-fluid">        
            {!! Form::open(array('url' => 'quest/redeem', 'class' => 'form', 'id' => 'redeem-form')) !!}

            <h2 class="title">Instant Credit Redemption</h2>
            <h3 class="subtitle">Enter the code to get points</h3>

            <div class="tile">
                <div class="tile is-parent">
                    <div class="tile is-child">
                            <div id="reader" style="width:250px;height:250px">
                             </div>


                            <div class="field has-addons">
                              <p class="control">
                            {!! Form::text('code', '', ['class' => 'input is-large', 'id' => 'code']); !!}

                              </p>
                              <p class="control">
                                {!! Form::submit('Submit', ['class' => 'button is-primary is-large']) !!}
                              </p>
                            </div>
                    </div>
                </div>
            </div>
            
            {!! Form::close() !!}

        </div>
    </div>
</section>



@endsection

@section('after-scripts-end')
{{ Html::script('js/vendor/qrcode/jsqrcode-combined.min.js') }}
{{ Html::script('js/vendor/qrcode/html5-qrcode.js') }}

    <script>
$('#reader').html5_qrcode(function(data){
        $('#code').val(data);
        $('#reader').html5_qrcode_stop();
        $('#redeem-form').submit();
    },
    function(error){
        //show read errors 
    }, function(videoError){
        $('#qr_instructions').hide();
        $('#reader').hide();
        //the video stream could be opened
    }
);

    </script>
@stop