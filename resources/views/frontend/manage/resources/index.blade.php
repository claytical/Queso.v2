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
        @include('frontend.includes.admin')
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