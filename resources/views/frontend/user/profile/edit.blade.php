@extends('frontend.layouts.master')

@section('content')

<h2>Settings</h2>

    <div class="col-lg-12">
            {{ Form::model($user, ['route' => 'frontend.user.profile.update', 'class' => 'form', 'method' => 'PATCH']) }}
            <div class="col-lg-6">
                <div class="form-group">
                {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'control-label']) }}                      
                {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
                </div>
            </div>
            @if ($user->canChangeEmail())
            <div class="col-lg-6">
                <div class="form-group">
                    {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                    {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                </div>
            </div>
            @endif
<!--
        <div class="col-lg-6">
            <div class="checkbox">
                <label>
                {{ Form::checkbox('email_notifications', 1) }}
                Email Notifications</label>
            </div>

        </div>
-->
        <div class="col-lg-6">
            <div class="form-group">
                <label>Default Course</label>
                {{ Form::select('default_course_id', Form::courseList(), $user->default_course_id, ['class' => 'selectpicker', 'id' => 'course_dropdown']) }}
            </div>

            {{ Form::submit(trans('labels.general.buttons.save'), ['class' => 'btn btn-primary pull-right']) }}

        </div>

        <div class="col-lg-6">
            <h5>Gravatar</h5>
            <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            <p>Gravatars are used across the internet. To update or create yours, go to <a href="https://en.gravatar.com/" target="_blank">Gravatar.com</a></p>
        </div>

            {{ Form::close() }}
    </div>
@endsection