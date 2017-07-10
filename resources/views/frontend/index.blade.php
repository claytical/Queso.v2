@extends('frontend.layouts.guest')

@section('page-header')

@endsection


@section('content')

<div class="tile is-ancestor">
  <div class="tile is-6 is-parent">
    <div class="tile is-child box">
        <p class="title">Queso</p>
        <p>Queso is a classroom management system for gameful classrooms. We help you take your existing classroom and reshape it using concepts from game design. This is not about points, badges, and leaderboards. This is about increasing student engagement through gameful design. You can use Queso for your class without "gamifying" it. It's simple and intuitive for creating an engaging class in the 21st century.</p>      
    </div>
  </div>
  <div class="tile is-6 is-parent">
    <div class="tile is-child box">
      <p class="title">Login</p>
        {{ Form::open(['route' => 'auth.login', 'class' => '']) }}
        
        <div class="field">
            {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'label']) }}        
          <p class="control">
            {{ Form::input('email', 'email', null, ['class' => 'input', 'placeholder' => trans('validation.attributes.frontend.email')]) }}          
            <span class="icon is-small is-left">
              <i class="fa fa-envelope"></i>
            </span>
            <span class="icon is-small is-right">
              <i class="fa fa-check"></i>
            </span>
          </p>
        </div>

        <div class="field">
            {{ Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'label']) }}        
          <p class="control">
            {{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
            <span class="icon is-small is-left">
              <i class="fa fa-lock"></i>
            </span>
          </p>
        </div>

        <div class="field is-horizontal">
          <div class="field-body">
            <div class="field">
              <div class="control">
                <label class="checkbox">
                    {{ Form::checkbox('remember', ['class' => 'label']) }} 
                    {{ trans('labels.frontend.auth.remember_me') }}
                </label>
              </div>
            </div>
          </div>
        </div>
        {{ Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'button is-primary']) }}
        {{ Form::close() }}

        {{ link_to('password/reset', trans('labels.frontend.passwords.forgot_password', ['class' => 'button is-link'])) }}
    </div>
  </div>
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop