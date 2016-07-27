@extends('frontend.layouts.master')

@section('content')
<h2>Available Quests</h2>

        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <h4>{{ link_to('quest/1/attempt/submission', 'Submission Quest') }}</h4>
                    <h5>00 Points, Due by 00/00/000</h5>
                </div>
                <div class="col-lg-12">
                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h4>{{ link_to('quest/1/attempt/link', 'Link Quest') }}</h4>
                    <h5>00 Points, Due by 00/00/000</h5>
                </div>
                <div class="col-lg-12">
                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <h4>{{ link_to('quest/1/watch', 'Watch Video Quest') }}</h4>
                    <h5>00 Points, Due by 00/00/000</h5>
                </div>
                <div class="col-lg-12">
                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                </div>
            </div>

        </div>

<h2>Quests That Can Be Revised for More Points</h2>
   

            <div class="row">
                <div class="col-lg-9">
                    <h4>{{ link_to('quest/1/revise/submission', 'Submission Quest') }}</h4>
                    <h5>00 Points, Due by 00/00/000</h5>
                </div>
                <div class="col-lg-12">
                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                </div>
            </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop