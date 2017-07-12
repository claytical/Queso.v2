@extends('frontend.layouts.master')

@section('content')

<section class="hero is-dark is-bold">
  <div class="hero-body">
    <div class="container is-fluid">
      <h1 class="title">
        Your Course Has Been Created!
      </h1>
      <h2 class="subtitle">All that's left is to invite the students and create some quests!</h2>

        <div class="tile is-ancestor">
          <div class="tile is-4">
            <div class="tile">
              <div class="tile is-parent is-vertical">
                
                <article class="tile is-child notification is-primary">
                  <p class="title">Quests</p>
                  <p class="subtitle">Some people call them assignments, we call them quests. From the management page, you can create new quests for your students to complete.</p>

                {{ link_to('dashboard', 'Create Quest', ['class' => 'button is-primary is-medium']) }}

                </article>
              </div>
              
            </div>
            
          </div>

        <div class="tile is-4">
            <div class="tile">
              <div class="tile is-parent is-vertical">
                
                <article class="tile is-child notification is-primary">
                  <p class="title">Resources</p>
                  <p class="subtitle">Have something to share with students? Resources will be added to the sidebar as you create them. If you consolidate multiple resources into a category, they'll be aggregated.</p>
                {{ link_to('dashboard', 'Create Resource', ['class' => 'button is-primary is-medium']) }}

                </article>
              </div>
              
            </div>
            
          </div>

        <div class="tile is-4">
            <div class="tile">
              <div class="tile is-parent is-vertical">
                
                <article class="tile is-child notification is-warning">
                  <p class="title">Announcements</p>
                  <p class="subtitle">Want to let your students know what's happening? Announcements go straight to the dashboard.</p>
                {{ link_to('dashboard', 'Create Announcement', ['class' => 'button is-primary is-medium']) }}

                </article>
              </div>
              
            </div>
            
          </div>
          
        </div>

    </div>
  </div>
</section>



@endsection

@section('after-scripts-end')
@stop