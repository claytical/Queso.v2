@extends('frontend.layouts.master')

@section('content')

@if(!$quests->isEmpty())

<section class="section dark-section">
    <div class="columns">
        <div class="column is-2">
        @include('frontend.includes.admin')
        </div>
        <div class="column">
          <div class="box">
            <h1 class="title headline is-uppercase">Assign Activity Credit</h1>

            <table class="table">
              <thead>
                <tr>
                  <th>Quest</th>
                  <th>Completion</th>
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
                    <td>{!! $quest->users()->count() !!} / {!! $users !!}</td>
                    <td><a class="button is-small" href="{!! url('grade/activity/'.$quest->id);!!}">Select</a></td>
                </tr>
             @endforeach

              </tbody>
            </table>
          </div>
    </div>
  </div>
</section>
@else
    <section class="hero is-dark is-bold is-large">
      <div class="hero-body">
        <div class="container">
          <h1 class="title headline is-uppercase">
            Assign Activity Credit
          </h1>
            <h2 class="subtitle">There are no activities available to assign credit for.</h2>

            <a href="{!! URL::to('manage/quest/create/activity'.$course_id) !!}" class="button is-pulled-right is-primary is-large">Create Activity Quest</a>
        </div>
      </div>
    </section>
@endif
@endsection

@section('after-scripts-end')
    <script>
        </script>
@stop