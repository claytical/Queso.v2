@extends('frontend.layouts.master')

@section('content')
<h2>Quest Name</h2>

        <div class="col-lg-12">
            <div class="row">
                <h4>40 Points Available</h4>

                    <div class="col-lg-12">
                        {!! $data->html !!}
                    </div>

                <p>The quest has been submitted to the instructor. If this is a revisable quest, you'll be able to submit a new version if you'd like more points. If this is a peer feedback quest, your team members will be notified so they can give you feedback.
                </p>
            </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop