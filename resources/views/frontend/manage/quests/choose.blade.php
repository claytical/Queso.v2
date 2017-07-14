@extends('frontend.layouts.master')

@section('content')

<section class="hero is-light is-bold" id="choose_quest">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">
        New Quest
      </h1>
        <h2 class="subtitle">What kind of quest is this?</h2>

            <div class="tile is-ancestor">
              <div class="tile is-parent">
                <article class="tile is-child box">
                  <p class="title">Online Submission</p>
                  <p class="subtitle">Students send a link or upload a file to Queso</p>
                  <a class="button is-large is-fullwidth is-outlined" href="{!! URL::to('manage/quest/create/submission/'.$course_id)!!}">
                    <span class="icon">
                      <i class="fa fa-link"></i>
                    </span>
                    <span>Create Submission</span>
                  </a>                  
                </article>
              </div>
              <div class="tile is-parent">
                <article class="tile is-child box">
                  <p class="title">Group Work</p>
                  <p class="subtitle">One submission through Queso on behalf of a group of students</p>
                  <a class="button is-large is-fullwidth is-outlined" href="{!! URL::to('manage/quest/create/group_submission/'.$course_id)!!}">
                    <span class="icon">
                      <i class="fa fa-users" aria-hidden="true"></i>
                    </span>
                    <span>Create Group Work</span>
                  </a>                  
                </article>
              </div>
            </div>
            <div class="tile is-ancestor">              
              <div class="tile is-parent">
                <article class="tile is-child box">
                  <p class="title">Video</p>
                  <p class="subtitle">Receive points for watching a YouTube video through Queso</p>
                  <a class="button is-large is-fullwidth is-outlined" href="{!! URL::to('manage/quest/create/video/'.$course_id)!!}">
                    <span class="icon">
                      <i class="fa fa-youtube-play" aria-hidden="true"></i>
                    </span>
                    <span>Create Video</span>
                  </a>                  
                </article>
              </div>
              <div class="tile is-parent">
                <article class="tile is-child box">
                  <p class="title">Class Activity</p>
                  <p class="subtitle">Assign points for things that happen outside of Queso</p>
                  <a class="button is-large is-fullwidth is-outlined" href="{!! URL::to('manage/quest/create/activity/'.$course_id)!!}">
                    <span class="icon">
                      <i class="fa fa-trophy" aria-hidden="true"></i>
                    </span>
                    <span>Create Activity</span>
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