@extends('frontend.layouts.unassigned')

@section('content')

<div class="container is-fluid">
	<h1 class="title">Choose Your Destiny</h1>
	<p>Before we begin, are you a student looking to add a class or an instructor looking to create one?</p>

	<a class="button is-large" href="{!! URL::to('course/join') !!}">Student</a>

	<a class="button is-large" href="{!! URL::to('course/create') !!}">Instructor</a>

</div>
@endsection