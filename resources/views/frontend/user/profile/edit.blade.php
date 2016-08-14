@extends('frontend.layouts.master')

@section('content')

<h2>Settings</h2>

    <div class="col-lg-12">
            {{ Form::model($user, ['route' => 'frontend.user.profile.update', 'class' => 'form', 'method' => 'PATCH']) }}
            <div class="form-group">
            {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'control-label']) }}                      
            {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
            </div>

            @if ($user->canChangeEmail())
                <div class="form-group">
                    {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                    {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                </div>
            @endif
            <div class="checkbox">
                <label>
                {{ Form::checkbox('email_notifications', 1) }}
                Email Notifications</label>
            </div>
            <div class="form-group">
                {{ Form::label('default_course', "Default Course", ['class' => 'control-label']) }}                      

                {{ Form::select('default_course', Form::courseList(), $user->default_course_id, ['class' => 'selectpicker', 'id' => 'course_dropdown'])) }}
            </div>
            {{ Form::submit(trans('labels.general.buttons.save'), ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
    </div>
@endsection