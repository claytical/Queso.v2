@extends('frontend.layouts.master')

@section('content')
<h2>Resource Category Name</h2>
<div class="pull-right">
    {{ Form::select('default_course', array('1' => 'Date Posted', '2' => 'Name'), '2') }}
</div>
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <h4>Resource Name</h4>
                    <h5>Posted 00/00/000</h5>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Maecenas faucibus mollis interdum.</p>
                    <div>
                        EMBEDLY CARD GOES HERE
                    </div>

                    <h6>Attached Files</h6>

                    <a href="#" class="btn btn-default">filename.pdf</a>         
                    <a href="#" class="btn btn-default">filename.pdf</a>
                    <a href="#" class="btn btn-default">filename.pdf</a>
                </div>

                <div class="col-lg-12">
                    <h4>Resource Name</h4>
                    <h5>Posted 00/00/000</h5>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Maecenas faucibus mollis interdum.</p>
                    <div>
                        EMBEDLY CARD GOES HERE
                    </div>

                    <h6>Attached Files</h6>

                    <a href="#" class="btn btn-default">filename.pdf</a>         
                    <a href="#" class="btn btn-default">filename.pdf</a>
                    <a href="#" class="btn btn-default">filename.pdf</a>
                </div>

                <div class="col-lg-12">
                    <h4>Resource Name</h4>
                    <h5>Posted 00/00/000</h5>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Maecenas faucibus mollis interdum.</p>
                    <div>
                        EMBEDLY CARD GOES HERE
                    </div>

                    <h6>Attached Files</h6>

                    <a href="#" class="btn btn-default">filename.pdf</a>         
                    <a href="#" class="btn btn-default">filename.pdf</a>
                    <a href="#" class="btn btn-default">filename.pdf</a>
                </div>
            
            </div>

        </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop