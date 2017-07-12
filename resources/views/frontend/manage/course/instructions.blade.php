@extends('frontend.layouts.master')

@section('content')

<section class="hero is-dark is-bold">
  <div class="hero-body">
    <div class="container is-fluid">
      <h1 class="title">
        Your Course Has Been Created!
      </h1>
      <h2 class="subtitle">All that's left is to invite the students and create some quests!</h2>
        <h4>Quests</h4>
        <p>Some people call them assignments, we call them quests. From the management page, you can create new quests for your students to complete.</p>
        <h4>Resources</h4>
        <p>Have something to share with students? Resources will be added to the sidebar as you create them. If you consolidate multiple resources into a category, they'll be aggregated.</p>
        <h4>Announcements</h4>
        <p>Want to let your students know what's happening? Announcements go straight to the dashboard.</p>
        {{ link_to('dashboard', 'Go to Dashboard', ['class' => 'button is-primary is-large']) }}
    </div>
  </div>
</section>



@endsection

@section('after-scripts-end')
@stop