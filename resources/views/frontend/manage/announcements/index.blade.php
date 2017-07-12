@extends('frontend.layouts.master')

@section('content')

@if($announcements->isEmpty())

    <section class="hero is-dark is-bold is-large">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Announcements
          </h1>
            <h2 class="subtitle">There are currently no announcements. When you create an announcement, it will show up on the dashboard for all students to see.</h2>

            <a href="{!! URL::to('manage/announcement/create') !!}" class="button is-pulled-right is-primary">Make an Announcement</a>
        </div>
      </div>
    </section>
@else
    <section class="hero is-dark is-bold">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Announcements
          </h1>

            <a href="{!! URL::to('manage/announcement/create') !!}" class="button is-pulled-right is-primary">New Announcement</a>
        </div>
      </div>
    </section>

@endif


@if(!$announcements->isEmpty())

    @foreach($announcements as $announcement)
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">{!! $announcement->title !!}</p>
            <a class="card-header-icon">
              <span class="icon">
                <i class="fa fa-angle-down"></i>
              </span>
            </a>
          </header>
          <div class="card-content">
            <div class="content">
            {!! $announcement->body !!}
              <br>
              <small>{!! date('m-d-Y', strtotime($announcement->created_at)) !!}</small>
            </div>
          </div>
          <footer class="card-footer">
            @if($announcement->sticky)
                <a class="card-footer-item" href="{!! url('manage/announcement/'.$announcement->id.'/hide');!!}"> Hide</a>
            @else
                <a class="card-footer-item" href="{!! url('manage/announcement/'.$announcement->id.'/show');!!}"> Show</a>
            @endif

            <a class="card-footer-item" href="{!! URL::to('manage/announcement/' . $announcement->id) !!}">Edit</a>
            <a class="card-footer-item" href="{!! URL::to('manage/announcement/' . $announcement->id . '/delete') !!}">Delete</a>
          </footer>
        </div>

     @endforeach
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