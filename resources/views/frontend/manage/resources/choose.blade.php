@extends('frontend.layouts.master')

@section('content')


<section class="section">
    <div class="columns">
        <div class="column is-2">
        @include('frontend.includes.admin')
        </div>
        <div class="column">
          <h1 class="title">New Resource</h1>
          <h2 class="subtitle">What kind of resource is this?</h2>

            <div class="tile is-ancestor">              
              <div class="tile is-parent">
                <article class="tile is-child box">
                  <p class="title">Link</p>
                  <p class="subtitle">A link that's shown with a preview card</p>
                  <a class="button is-large is-fullwidth is-outlined" href="{!! URL::to('manage/resource/create/link/'.$course_id)!!}">
                    <span class="icon">
                      <i class="fa fa-link"></i>
                    </span>
                    <span>Create Link</span>
                  </a>                  
                </article>
              </div>            
              <div class="tile is-parent">
                <article class="tile is-child box">
                  <p class="title">Content</p>
                  <p class="subtitle">Custom text with optional file attachments</p>
                  <a class="button is-large is-fullwidth is-outlined" href="{!! URL::to('manage/resource/create/content/'.$course_id)!!}">
                    <span class="icon">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </span>
                    <span>Create Content</span>
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