@extends('frontend.layouts.master')

@section('content')
<section class="hero is-dark is-medium">
    <div class="hero-body">
        <div class="container is-fluid">

                <h1 class="title headline is-uppercase">{{ trans('labels.frontend.passwords.reset_password_box_title') }}</h1>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Form::open(['route' => 'auth.password.email', 'class' => 'form-horizontal']) }}

                    <div class="form-group">
                        {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'label']) }}
                        <div class="field">
                            <p class="control">
                            {{ Form::input('email', 'email', null, ['class' => 'input', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                            </p>
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="field">
                            <p class="control">
                            {{ Form::submit(trans('labels.frontend.passwords.send_password_reset_link_button'), ['class' => 'button is-primary is-large']) }}
                            </p>
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    {{ Form::close() }}

                </div><!-- panel body -->

            </div><!-- panel -->

</section>
@endsection