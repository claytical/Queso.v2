@extends('frontend.layouts.master')

@section('content')
@if($resources->isEmpty())

    <section class="hero is-dark is-bold is-large">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Resources
          </h1>
            <h2 class="subtitle">Resources are available for all students in your course.</h2>

            <a href="{!! URL::to('manage/resources/create/'.$course_id) !!}" class="button is-large is-pulled-right is-primary">Create Resource</a>
        </div>
      </div>
    </section>
@else
    <section class="hero is-dark is-bold">
      <div class="hero-body">
        <div class="container">
            <a href="{!! URL::to('manage/resources/create/'.$course_id) !!}" class="button is-large is-pulled-right is-primary">New Resource</a>
            <h1 class="title">Resources</h1>
        </div>
      </div>
    </section>

@endif


@if(!$resources->isEmpty())
<section class="section">
    <div class="columns">
        <div class="column is-2">
            <aside class="menu">
              <ul class="menu-list">
                <li><a class="{{ Active::pattern('manage/quests/'.$course->id, 'is-active') }}" href="{!! URL::to('manage/quests/'.$course->id) !!}">Quests</a></li>
                <li><a class="{{ Active::pattern('manage/resources/'.$course->id, 'is-active') }}" href="{!! URL::to('manage/resources/'.$course->id) !!}">Resources</a></li>
                <li><a class="{{ Active::pattern('manage/announcements/'.$course->id, 'is-active') }}" href="{!! URL::to('manage/announcements/'.$course->id) !!}">Announcements</a></li>
              </ul>
              <p class="menu-label">
                Course Management
              </p>
              <ul class="menu-list">
                <li><a class="{{ Active::pattern('manage/course/'.$course->id, 'is-active') }}" href="{!! URL::to('manage/course/'.$course->id) !!}">Information</a></li>
                <li><a>Students</a></li>
                <li><a>Teams</a></li>
                <li><a>Skills</a></li>
                <li><a>Levels</a></li>
              </ul>
            </aside>
        </div>
        <div class="column">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Tag</th>
          <th>Type</th>
          <th></th>
        </tr>
      </thead>
      <!--
      <tfoot>
        <tr>
          <th>Headline</th>
          <th>Date</th>
          <th></th>
        </tr>
      </tfoot>
      -->
      <tbody>
    @foreach($resources as $resource)

        <tr>
          <td>{!! $resource->title !!}</td>
          <td>{!! $resource->tag !!}</td>
          <td>
            @if($resource->link)
              Link
            @else
              Content
            @endif
          </td>
          <td>            
            @if($resource->link)
              <a class="button is-small" href="{!! URL::to('manage/resource/link/edit/' . $resource->id) !!}">Edit</a>

            @else
              <a class="button is-small" href="{!! URL::to('manage/resource/content/edit/' . $resource->id) !!}">Edit</a>
            @endif

            <a class="button is-small is-danger" href="{!! URL::to('manage/resource/delete/' . $resource->id) !!}">Delete</a>
            </td>
        </tr>
     @endforeach

      </tbody>
    </table>
    </div>
  </div>
</section>
@endif

@endsection

@section('after-scripts-end')
    <script>
  /*      var quest_list_options = {
        valueNames: [ 'submission', 'date', 'student' ]
    };
*/
//    var hackerList = new List('submission-list', submission_list_options);
    </script>
@stop