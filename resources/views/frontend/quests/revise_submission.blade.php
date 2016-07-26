@extends('frontend.layouts.master')

@section('content')
<h2>Quest Name</h2>

        <div class="col-lg-12">
            <div class="row">
                <h4>Points Available</h4>
                <h6>Due 00/00/000, First Submitted 00/00/00</h6>
                <h6>You received 00 points for the last submission</h6>
<!-- Flip Through Previous Submissions and Feedback -->
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>

                {!! Form::open(array('url' => 'quest/revise')) !!}
        
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