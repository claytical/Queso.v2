@extends('frontend.layouts.master')

@section('content')
@if($quests->isEmpty())

    <section class="hero is-dark is-bold is-large">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Quests
          </h1>
            <h2 class="subtitle">Quests are completed by students to gain points.</h2>

            <a href="{!! URL::to('manage/quest/create/'.$course_id) !!}" class="button is-pulled-right is-primary is-large">Make a Quest</a>
        </div>
      </div>
    </section>
@else
    <section class="hero is-dark is-bold">
      <div class="hero-body">
        <div class="container">
            <a href="{!! URL::to('manage/quest/create/'.$course_id) !!}" class="button is-pulled-right is-primary is-large">New Quest</a>
            <h1 class="title">Quests</h1>
        </div>
      </div>
    </section>

@endif


@if(!$quests->isEmpty())
<section class="section">
    <div class="columns">
        <div class="column is-2">
            <aside class="menu">
              <ul class="menu-list">
                <li><a class="{{ Active::pattern('manage/quests/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/quests/'.$course_id) !!}">Quests</a></li>
                <li><a class="{{ Active::pattern('manage/resources/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/resources/'.$course_id) !!}">Resources</a></li>
                <li><a class="{{ Active::pattern('manage/announcements/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/announcements/'.$course_id) !!}">Announcements</a></li>
              </ul>
              <p class="menu-label">
                Course Management
              </p>
              <ul class="menu-list">
                <li><a class="{{ Active::pattern('manage/course/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/course/'.$course_id) !!}">Information</a></li>
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
            <th>Quest</th>
            <th>Type</th>
            <th>Due Date</th>
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
      @foreach($quests as $quest)
          <tr>
            <td>{!! $quest->name !!}</td>
            <td>
                @if($quest->quest_type_id == 1)
                  Response
                @endif
                @if($quest->quest_type_id == 2)
                  Activity
                @endif
                @if($quest->quest_type_id == 3)
                  Video
                @endif
                @if($quest->quest_type_id == 4)
                  Link
                @endif            
                @if($quest->quest_type_id == 5)
                  File Upload
                @endif            
                @if($quest->quest_type_id == 6)
                  Group File Upload
                @endif            
                @if($quest->quest_type_id == 7)
                  Group Link
                @endif            

            </td>
            <td>
              @if($quest->expires_at)
              {!! date('m-d-Y', strtotime($quest->expires_at)) !!}
              @else
                Anytime
              @endif
            </td>
            <td>
              <a class="button is-small" href="{!! url('manage/quest/'.$quest->id);!!}">Edit</a>
              <a class="button is-small" href="{!! url('quest/'.$quest->id.'/attempt/submission');!!}">View</a>
              <a class="button is-small" href="{!! url('manage/quest/'.$quest->id.'/clone');!!}">Clone</a>

              @if($quest->instant)
                <a class="button is-small" href="{!! url('manage/quest/'.$quest->id.'/qrcards');!!}">QR Code Sheet</a>
              @endif
              <a class="button is-small is-danger" href="{!! url('manage/quest/'.$quest->id.'/delete');!!}">Delete</a>
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

@stop