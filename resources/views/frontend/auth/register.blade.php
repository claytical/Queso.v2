@extends('frontend.layouts.guest')

@section('content')
<section class="hero is-dark is-medium">
    <div class="hero-body">
        <div class="container is-fluid">
        {{ Form::open(['route' => 'auth.register', 'class' => 'form-horizontal']) }}

            <div class="tile">
                <div class="tile is-6 is-parent is-vertical">
                    <div class="tile is-child">

                </div>
                <div class="tile is-6 is-parent">
                    <div class="tile is-child notification is-primary">
                    <p class="title">Login</p>
                      {{ Form::open(['route' => 'auth.login', 'class' => '']) }}
                      
                        <div class="field">                      
                            {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'label']) }}
                            <p class="control">
                            {{ Form::input('name', 'name', null, ['class' => 'input is-large', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
                            </p>
                        </div>
                        <div class="field">
                            {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'label']) }}

                            <p class="control has-icons-left has-icons-right">
                            {{ Form::input('email', 'email', null, ['class' => 'input is-large', 'placeholder' => trans('validation.attributes.frontend.email')]) }}

                          <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                          </span>
                          <span class="icon is-small is-right">
                            <i class="fa fa-warning"></i>
                          </span>
                        </p>
                        <p class="help is-danger is-hidden">This email is invalid</p>
                      </div>


                      <div class="field">
                        {{ Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'label']) }}

                        <p class="control has-icons-left has-icons-right">
                          {{ Form::input('password', 'password', null, ['class' => 'input', 'placeholder' => trans('validation.attributes.frontend.password')]) }}          
                          <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                          </span>
                          <span class="icon is-small is-right">
                            <i class="fa fa-warning"></i>
                          </span>
                        </p>
                      </div>

                      <div class="field">
                        {{ Form::label('password_confirmation', trans('validation.attributes.frontend.password_confirmation'), ['class' => 'label']) }}

                        <p class="control has-icons-left has-icons-right">
                          {{ Form::input('password', 'password_confirmation', null, ['class' => 'input', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) }}          
                          <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                          </span>
                          <span class="icon is-small is-right">
                            <i class="fa fa-warning"></i>
                          </span>
                        </p>
                      </div>

                    @if (config('access.captcha.registration'))
                        <div class="field">
                                {!! Form::captcha() !!}
                                {{ Form::hidden('captcha_status', 'true') }}
                        </div><!--form-group-->
                    @endif


                        {{ Form::submit(trans('labels.frontend.auth.register_button'), ['class' => 'button is-primary is-inverted is-outlined is-large']) }}

                      {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('after-scripts-end')
    @if (config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@stop