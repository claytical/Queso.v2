@extends('frontend.layouts.master')

@section('content')

@if(!$quests->isEmpty())

<section class="section">
    <div class="columns">
        <div class="column is-2">
        @include('frontend.includes.admin')
        </div>
        <div class="column">
            <h1 class="title">Assign Activity Credit</h1>

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
</section>
@else
    <section class="hero is-dark is-bold is-large">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Assign Activity Credit
          </h1>
            <h2 class="subtitle">There are no activities available to assign credit for.</h2>

            <a href="{!! URL::to('manage/quest/create/activity'.$course_id) !!}" class="button is-pulled-right is-primary is-large">Create Activity Quest</a>
        </div>
      </div>
    </section>
@endif



















<h2>Activity Credit</h2>

@if(!$quests->isEmpty())
    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
        <thead>
            <tr>
                <th data-field="name" 
            data-sortable="true">Quest</th>
                <th data-field="category" 
            data-sortable="true">Category</th>
                <th data-field="completion" 
            data-sortable="true">Completion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quests as $quest)
            <tr>
                <td>{{ link_to('grade/activity/'.$quest->id, $quest->name) }}</td>
                <td></td>
                <td>{!! $quest->users()->count() !!} / {!! $users !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="lead">There are no in class quests available.</p>
@endif
@endsection

@section('after-scripts-end')
    <script>
        </script>
@stop