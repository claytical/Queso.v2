@extends('frontend.layouts.unassigned')

@section('content')

<section class="hero is-dark is-bold is-large">
  <div class="hero-body">
    <div class="container is-fluid">
      <h1 class="title">
        Join a Course
      </h1>
      <h2 class="subtitle">To join a class, you should have been given a registration code. Please enter it below.</h2>
        {!! Form::open(['url' => 'course/join', 'class' => '', 'id' => 'join-course']) !!}
            
        <div class="field has-addons">
          <p class="control">
            {{ Form::input('text', 'registration_code', null, ['class' => 'input is-large', 'placeholder' => 'Registration Code', 'id' => 'registration_code']) }}

          </p>
          <p class="control">
            {!! Form::submit('Join Course', ['class' => 'button is-large']) !!}  </p>
        </div>
            
        {!! Form::close() !!}
    </div>
  </div>
</section>


@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop