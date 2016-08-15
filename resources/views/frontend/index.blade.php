@extends('frontend.layouts.guest')

@section('page-header')

@endsection


@section('content')
<h1></h1>

<div class="col-lg-12">
    <div class="col-lg-6">  
        <h2>Queso</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Etiam porta sem malesuada magna mollis euismod. </p>
    </div>

    <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                        <div class="panel-body">
                        {{ Form::open(['route' => 'auth.login', 'class' => 'form-horizontal']) }}
                            <div class="form-group">
                                {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                                        </div><!--col-md-6-->
                            </div><!--form-group-->

                            <div class="form-group">
                                {{ Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    {{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                                </div><!--col-md-6-->
                            </div><!--form-group-->

                            @if (isset($captcha) && $captcha)
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        {!! Form::captcha() !!}
                                        {{ Form::hidden('captcha_status', 'true') }}
                                    </div><!--col-md-6-->
                                </div><!--form-group-->
                            @endif

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('remember') }} {{ trans('labels.frontend.auth.remember_me') }}
                                        </label>
                                    </div>
                                </div><!--col-md-6-->
                            </div><!--form-group-->

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {{ Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-primary', 'style' => 'margin-right:15px']) }}

                                    {{ link_to('password/reset', trans('labels.frontend.passwords.forgot_password')) }}
                                </div><!--col-md-6-->
                            </div><!--form-group-->

                            {{ Form::close() }}
                            </div>
                        </div>
        </div>
</div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop