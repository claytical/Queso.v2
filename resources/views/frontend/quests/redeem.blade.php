@extends('frontend.layouts.master')

@section('content')
<h2>Redeem Instant Credit</h2>

        <div class="col-lg-12">
            <div class="row">
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                {!! Form::open(array('url' => 'quest/redeem', 'class' => 'form form-inline')) !!}
        
                {!! Form::text('code', ''); !!}
                {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-lg btn-block']) !!}

                {!! Form::close() !!}
            </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop