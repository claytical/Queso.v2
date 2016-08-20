@extends('frontend.layouts.guest')

@section('page-header')

@endsection


@section('content')

<div class="col-lg-12">
    <div class="col-lg-9">
        <img src="img/queso_logo.png" title="Queso" height=150>
    </div>
    <div class="col-lg-3">
    </div>
</div>
<div class="col-lg-12">
    <div class="col-lg-4">
        <h3>What's Queso?</h3>
        
        <p>Queso is a classroom management system for gameful classrooms. We help you take your existing classroom and reshape it using concepts from game design. This is not about points, badges, and leaderboards. This is about increasing student engagement through gameful design. You can use Queso for your class without "gamifying" it. It's simple and intuitive for creating an engaging class in the 21st century.</p>
    </div>

    <div class="col-lg-4">
        <h3>This Looks Different!</h3>
        <p>This is a brand new beta version of Queso. If you'd like to access your existing class, <a href="http://class.conque.so">head on over here</a>.</p>
    </div>
    <div class="col-lg-4">
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