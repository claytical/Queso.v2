@extends('frontend.layouts.unassigned')

@section('content')

<section class="hero is-dark is-bold is-large">
  <div class="hero-body">
    <div class="container is-fluid">
      <h1 class="title">
        Choose Your Destiny
      </h1>
      <h2 class="subtitle">Before we begin, are you a student looking to add a class or an instructor looking to create one?</h2>
    
		<a class="button is-large" href="{!! URL::to('course/join') !!}">Student</a>

		<a class="button is-large" href="{!! URL::to('course/create') !!}">Instructor</a>

    </div>
  </div>
</section>
@endsection