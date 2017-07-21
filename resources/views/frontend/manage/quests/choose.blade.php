@extends('frontend.layouts.master')

@section('content')

<section class="section dark-section">
    <div class="columns">
        <div class="column is-2">
        @include('frontend.includes.admin')
        </div>
        <div class="column">
          <div class="box">
            <h1 class="title headline is-uppercase">New Quest</h1>
            <h2 class="subtitle">What kind of quest is this?</h2>
              <div class="tile is-ancestor">              
                <div class="tile is-parent">
                  <article class="tile is-child">
                    <p class="title headline is-uppercase">Response</p>
                    <p class="subtitle">Students write a response directly on Queso</p>
                    <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/response/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-link"></i>
                      </span>
                      <span>Response Quest</span>
                    </a>                  
                  </article>
                </div>            
                <div class="tile is-parent">
                  <article class="tile is-child">
                    <p class="title headline is-uppercase">Video</p>
                    <p class="subtitle">Receive points for watching a YouTube video through Queso</p>
                    <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/video/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                      </span>
                      <span>Video Quest</span>
                    </a>                  
                  </article>
                </div>
                <div class="tile is-parent">
                  <article class="tile is-child">
                    <p class="title headline is-uppercase">Activity</p>
                    <p class="subtitle">Assign points for things that happen outside of Queso</p>
                    <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/activity/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-trophy" aria-hidden="true"></i>
                      </span>
                      <span>Activity Quest</span>
                    </a>                  
                  </article>
                </div>
              </div>
              <div class="tile is-ancestor">
                <div class="tile is-parent">
                  <article class="tile is-child">
                    <p class="title headline is-uppercase">Link</p>
                    <p class="subtitle">Students submit a link of their work to Queso</p>
                    <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/link/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-link"></i>
                      </span>
                      <span>Link Quest</span>
                    </a>                  
                  </article>
                </div>
                <div class="tile is-parent">
                  <article class="tile is-child">
                    <p class="title headline is-uppercase">File</p>
                    <p class="subtitle">Students upload a file to Queso</p>
                    <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/upload/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-link"></i>
                      </span>
                      <span>Upload Quest</span>
                    </a>                  
                  </article>
                </div>
                <div class="tile is-parent">
                  <article class="tile is-child">
                    <p class="title headline is-uppercase">Group Link</p>
                    <p class="subtitle">One student submits a link behalf of a group of students</p>
                    <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/link/group/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                      </span>
                      <span>Group Link Quest</span>
                    </a>                  
                  </article>
                </div>

                <div class="tile is-parent">
                  <article class="tile is-child">
                    <p class="title headline is-uppercase">Group File</p>
                    <p class="subtitle">One student submits a link behalf of a group of students</p>
                    <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/upload/group/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                      </span>
                      <span>Group File Quest</span>
                    </a>                  
                  </article>
                </div>
              </div>
            </div>
        </div>
  </div>
</section>





@endsection

@section('after-scripts-end')

@stop