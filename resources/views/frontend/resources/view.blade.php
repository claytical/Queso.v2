@extends('frontend.layouts.master')

@section('content')
<h2>Resource Name, Singleton</h2>
<h4>Posted 00/00/0000</h4>
<div class="row">
        <div class="col-lg-12">
            <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
        </div>
        <div class="col-lg-12">
            <div>
                EMBEDLY CARD GOES HERE
            </div>

            <h6>Attached Files</h6>
            <a href="#" class="btn btn-default">filename.pdf</a>         
            <a href="#" class="btn btn-default">filename.pdf</a>
            <a href="#" class="btn btn-default">filename.pdf</a>
        </div>
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop