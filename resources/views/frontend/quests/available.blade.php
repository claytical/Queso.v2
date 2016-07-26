@extends('frontend.layouts.master')

@section('content')
<h2>Available Quests</h2>

        <div class="col-lg-12">

            <div class="row">
                <h4>Submission Quest</h4>
                <h6>Due by 00/00/000</h6>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                <h6>00 Points</h6>
                {{ link_to('quest/1/attempt/submission', 'Do It') }}
            </div>

            <div class="row">
                <h4>Link Quest</h4>
                <h6>Due by 00/00/000</h6>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                <h6>00 Points</h6>
                {{ link_to('quest/1/attempt/link', 'Do It') }}
            </div>

            <div class="row">
                <h4>Watch Video Quest</h4>
                <h6>Due by 00/00/000</h6>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                <h6>00 Points</h6>
                {{ link_to('quest/1/watch', 'Watch') }}
            </div>

        </div>

<h2>Quests That Can Be Revised for More Points</h2>
   

        <div class="col-lg-12">
            <div class="row">
                <h4>Submission Quest</h4>
                <h6>Due 00/00/000</h6>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                <h6>00 Points</h6>
                {{ link_to('quest/1/revise/submission', 'Revise It') }}
            </div>
    </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop