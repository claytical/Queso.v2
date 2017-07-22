@extends('frontend.layouts.master')

@section('content')
<section class="hero is-dark is-medium">
    <div class="hero-body">
        <div class="container is-fluid">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Form::open(['route' => 'auth.password.reset', 'class' => 'form-horizontal']) }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'label']) }}
                        <div class="field">
                            <p class="control">
                            {{ Form::input('email', 'email', null, ['class' => 'input', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                            </p>
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'label']) }}
                        <div class="field">
                            <p class="control">
                            {{ Form::input('password', 'password', null, ['class' => 'input', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                            </p>
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('password_confirmation', trans('validation.attributes.frontend.password_confirmation'), ['class' => 'label']) }}
                        <div class="field">
                            <p class="control">
                            {{ Form::input('password', 'password_confirmation', null, ['class' => 'input', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) }}
                            </p>
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="field">
                            <p>
                            {{ Form::submit(trans('labels.frontend.passwords.reset_password_button'), ['class' => 'button is-primary is-large']) }}
                            </p>
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    {{ Form::close() }}

                </div><!-- panel body -->

            </div><!-- panel -->
</section>
@endsection