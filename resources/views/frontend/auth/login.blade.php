@extends('frontend.layouts.guest')

@section('page-header')

@endsection


@section('content')
<section class="hero is-dark is-medium">
    <div class="hero-body">
        <div class="container is-fluid">
            <div class="tile">
                <div class="tile is-6 is-parent is-vertical">
                    <div class="tile is-child">
                        <img class="" src="https://queso.nerdlab.miami/img/logo_long.png" alt="Queso: A Gameful Learning Management System">                            
                  </div>
                  <div class="tile is-child">
                
                      <p class="subtitle">Queso is a classroom management system with a gameful twist. Using concepts from game design the focus is on being simple, intuitive and engaging.</p>
                      <p class="subtitle">Queso is open source and free to use.</p>
                      <a href="{!! URL::to('register')!!}" class="button is-inverted is-outlined is-large is-primary">Create an Account</a>      

                  </div>
                </div>
                <div class="tile is-6 is-parent">
                    <div class="tile is-child notification is-primary">
                    <p class="title">Login</p>
                      {{ Form::open(['route' => 'auth.login', 'class' => '']) }}
                      
                      <div class="field">
                        {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'label']) }}
                        <p class="control has-icons-left has-icons-right">
                          {{ Form::input('email', 'email', null, ['class' => 'input', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
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
                        <p class="help is-danger is-hidden">This email is invalid</p>
                      </div>

                      <div class="field is-horizontal">
                        <div class="field-body">
                          <div class="field">
                            <div class="control">
                              <label class="checkbox">
                                  {{ Form::checkbox('remember') }} 
                                  {{ trans('labels.frontend.auth.remember_me') }}
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{ Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'button is-primary is-inverted is-outlined is-large']) }}
                      {{ Form::close() }}
                      <a href="{!! URL::to('password/reset')!!}" class="is-button is-link is-pulled-right">{!! trans('labels.frontend.passwords.forgot_password') !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop