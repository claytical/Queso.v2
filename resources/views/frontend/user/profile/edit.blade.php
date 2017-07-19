@extends('frontend.layouts.master')

@section('content')
<section class="hero is-bold is-light" id="profile-edit">
    <div class="hero-body">
        <div class="container is-fluid">        

        <h1 class="title">Account Settings</h1>
            {{ Form::model($user, ['route' => 'frontend.user.profile.update', 'class' => 'form', 'method' => 'PATCH']) }}

            <div class="field">
              {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'label']) }}
              <p class="control">
                {{ Form::input('text', 'name', null, ['class' => 'input is-large', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
              </p>
            </div>

                                   
                
            @if ($user->canChangeEmail())
                <div class="field">
                {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'label']) }}
                  <p class="control">
                     {{ Form::input('email', 'email', null, ['class' => 'input', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                  </p>
                </div>                   
            @endif
            <div class="field">
                <p class="control">
                {{ Form::checkbox('email_notifications', 1) }}
                Email Notifications</label>
                </p>
            </div>
            <div class="field">
                {{ Form::submit(trans('labels.general.buttons.save'), ['class' => 'btn btn-primary pull-right']) }}
            </div>
            {{ Form::close() }}
    </div>
@endsection