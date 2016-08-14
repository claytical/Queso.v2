@extends('frontend.layouts.master')

@section('content')

<h2>Settings</h2>

    <div class="col-lg-12">
        <div class="col-lg-6">
            {{ Form::model($user, ['route' => 'frontend.user.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

            {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-4 control-label']) }}
                      
            {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
            
            @if ($user->canChangeEmail())

                {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}

            @endif
        </div>
        <div class="col-lg-6">           
            {{ Form::label('email_notifications', "Email Notifications", ['class' => 'col-md-4 control-label']) }}

            {{ Form::checkbox('email_notifications', 1) }}
            {{ Form::select('default_course', array("HI", "HELLO"), session('current_course')) }}

            {{ Form::submit(trans('labels.general.buttons.save'), ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>

@endsection