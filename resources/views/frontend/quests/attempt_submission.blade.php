@extends('frontend.layouts.master')

@section('content')
<h2>Quest Name</h2>

        <div class="col-lg-12">
            <div class="row">
                <h4>Points Available</h4>
                <h6>Due 00/00/000</h6>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                {!! Form::open(array('url' => 'quest/submit')) !!}
        
                {!! Form::textarea('notes', null, ['class' => 'field', 'files' => true]) !!}
                {!! Form::file('image') !!}
                {!! Form::submit('Submit') !!}

                {!! Form::close() !!}
            </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop