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


            <div class="columns">
              <div class="column is-3">
                <h3 class="subtitle headline is-uppercase">Response</h3>
              </div>
              <div class="column is-3">
                <p>Students write a response directly on Queso</p>
              </div>
              <div class="column is-3">
                <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/response/'.$course_id)!!}">
                  <span class="icon">
                    <i class="fa fa-link"></i>
                  </span>
                  <span>Response Quest</span>
                </a> 
              </div>
            </div>

            <div class="columns">
              <div class="column is-3">
                <h3 class="subtitle headline is-uppercase">Video</h3>
              </div>
              <div class="column is-3">
                <p>Receive points for watching a YouTube video through Queso</p>
              </div>
              <div class="column is-3">
                  <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/video/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                      </span>
                      <span>Video Quest</span>
                    </a> 
              </div>
            </div>

            <div class="columns">
              <div class="column is-3">
                <h3 class="subtitle headline is-uppercase">Activity</h3>
              </div>
              <div class="column is-3">
                <p>Assign points for things that happen outside of Queso</p>
              </div>
              <div class="column is-3">
                  <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/activity/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-trophy" aria-hidden="true"></i>
                      </span>
                      <span>Activity Quest</span>
                    </a>
              </div>
            </div>

            <div class="columns">
              <div class="column is-3">
                <h3 class="subtitle headline is-uppercase">Link</h3>
              </div>
              <div class="column is-3">
                <p>Students submit a link of their work to Queso</p>
              </div>
              <div class="column is-3">
                  <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/link/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-link"></i>
                      </span>
                      <span>Link Quest</span>
                    </a>
              </div>
            </div>

            <div class="columns">
              <div class="column is-3">
                <h3 class="subtitle headline is-uppercase">File</h3>
              </div>
              <div class="column is-3">
                <p>Students upload a file to Queso</p>
              </div>
              <div class="column is-3">
                  <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/upload/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-link"></i>
                      </span>
                      <span>Upload Quest</span>
                    </a>
              </div>
            </div>

            <div class="columns">
              <div class="column is-3">
                <h3 class="subtitle headline is-uppercase">Group Link</h3>
              </div>
              <div class="column is-3">
                <p>One student submits a link behalf of a group of students</p>
              </div>
              <div class="column is-3">
                  <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/link/group/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                      </span>
                      <span>Group Link Quest</span>
                    </a>
              </div>
            </div>
                 
            <div class="columns">
              <div class="column is-3">
                <h3 class="subtitle headline is-uppercase">Group File</h3>
              </div>
              <div class="column is-3">
                <p>One student submits a link behalf of a group of students</p>
              </div>
              <div class="column is-3">
                  <a class="button is-large is-fullwidth is-primary" href="{!! URL::to('manage/quest/create/upload/group/'.$course_id)!!}">
                      <span class="icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                      </span>
                      <span>Group File Quest</span>
                    </a>
                </div>
              </div>
          </div>
      </div>
  </div>
</section>

@endsection

@section('after-scripts-end')

@stop