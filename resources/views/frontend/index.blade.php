@extends('frontend.layouts.guest')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-home"></i> {{ trans('navs.general.home') }}
                </div>

                <div class="panel-body">
                    {{ trans('strings.frontend.welcome_to', ['place' => app_name()]) }}
                </div>
            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!--row-->
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop