@extends('frontend.layouts.master')

@section('content')
<section class="section dark-section" id="quest_attempt">
    <div class="box">
        <div class="container is-fluid">        
            {!! Form::open(array('url' => 'quest/redeem', 'class' => 'form', 'id' => 'redeem-form')) !!}

            <h2 class="title headline is-uppercase">Instant Credit Redemption</h2>
            <h3 class="subtitle">Enter the code to get points or hold the QR code up to your camera</h3>

            <div class="tile">
                <div class="tile is-parent">
                    <div class="tile is-child">
                            <div id="reader" style="width: 250px; height: 250px; margin: auto;">
                             </div>

                            <div class="field has-addons">
                              <p class="control is-expanded">
                            {!! Form::text('code', '', ['class' => 'input is-large', 'id' => 'code', 'placeholder' => 'Enter Code Here']); !!}

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