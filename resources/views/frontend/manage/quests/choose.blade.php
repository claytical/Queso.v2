@extends('frontend.layouts.master')

@section('content')

<section class="hero is-dark is-bold" id="choose_quest">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">
        New Quest
      </h1>
        <h2 class="subtitle">What kind of quest is this?</h2>

            <div class="tile is-ancestor">
              <div class="tile is-parent">
                <article class="tile is-child notification is-dark">
                  <p class="title">Submission</p>
                  <p class="subtitle">Students send a link or upload a file to Queso</p>
                  <a class="button is-light is-large is-fullwidth is-outlined" href="{!! URL::to('manage/quest/create/submission/'.$course_id)!!}">
                    <span class="icon">
                      <i class="fa fa-link"></i>
                    </span>
                    <span>Create</span>
                  </a>                  
                </article>
              </div>
              <div class="tile is-parent">
                <article class="tile is-child notification is-dark">
                  <p class="title">Team Work</p>
                  <p class="subtitle">One student sends a link or uploads a file through Queso on behalf of a group of students</p>
                  <a class="button is-light is-large is-fullwidth is-outlined" href="{!! URL::to('manage/quest/create/group_submission/'.$course_id)!!}">
                    <span class="icon">
                      <i class="fa fa-users" aria-hidden="true"></i>
                    </span>
                    <span>Create</span>
                  </a>                  
                </article>
              </div>
              <div class="tile is-parent">
                <article class="tile is-child notification is-dark">
                  <p class="title">Video</p>
                  <p class="subtitle">A student watches a YouTube video through Queso and receives credit automatically</p>
                  <a class="button is-light is-large is-fullwidth is-outlined" href="{!! URL::to('manage/quest/create/video/'.$course_id)!!}">
                    <span class="icon">
                      <i class="fa fa-youtube-play" aria-hidden="true"></i>
                    </span>
                    <span>Create</span>
                  </a>                  
                </article>
              </div>
              <div class="tile is-parent">
                <article class="tile is-child notification is-dark">
                  <p class="title">Activity</p>
                  <p class="subtitle">Assign points for things that happen outside of Queso</p>
                  <a class="button is-light is-large is-fullwidth is-outlined" href="{!! URL::to('manage/quest/create/activity/'.$course_id)!!}">
                    <span class="icon">
                      <i class="fa fa-trophy" aria-hidden="true"></i>
                    </span>
                    <span>Create</span>
                  </a>                  
                </article>
              </div>
            </div>
    </div>
  </div>
</section>





@endsection

@section('after-scripts-end')

@stop