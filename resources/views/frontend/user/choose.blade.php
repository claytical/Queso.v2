@extends('frontend.layouts.unassigned')

@section('content')
<h2>Choose Your Destiny</h2>
<p class="lead">
    Before we begin, are you a student looking to add a class or an instructor looking to create one?
</p>
    
<div class="col-lg-6">
    {{ link_to('course/join', 'Student', ['class' => 'btn btn-default btn-block']) }}
</div>

<div class="col-lg-6">
    {{ link_to('course/create', 'Instructor', ['class' => 'btn btn-default btn-block']) }}
</div>
@endsection