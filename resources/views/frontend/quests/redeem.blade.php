@extends('frontend.layouts.master')

@section('content')
<h2>Redeem Instant Credit</h2>

        <div class="col-lg-12">
            <div class="row">
                <p id="instructions">You can hold the QR code up to your webcam to scan it, or enter the redemption code manually if you prefer.</p>
                {!! Form::open(array('url' => 'quest/redeem', 'class' => 'form form-inline', 'id' => 'redeem-form')) !!}
        
                <div id="reader" style="width:250px;height:250px">
                 </div>
                {!! Form::text('code', '', ['class' => 'form-control', 'id' => 'code']); !!}
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
            
        </div>

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