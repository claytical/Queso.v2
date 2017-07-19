@extends('frontend.layouts.master')

@section('content')
@if($lists)
    <section class="section">
        <div class="columns">
            <div class="column is-2">
              @include('frontend.includes.admin')
            </div>
            <div class="column">
                <h1 class="title">Ungraded Quests</h1>

                <table class="table">
                  <thead>
                    <tr>
                      <th>Quest</th>
                      <th>Student</th>
                      <th>Date Submitted</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($lists as $list)
                        @if($list['attempt'])
                        <tr>
                            <td>{{ link_to('grade/quest/'.$list['quest_id'].'/'.$list['attempt']->id, $list['quest']) }}</td>
                            <td>{!! $list['student'] !!}</td>
                            <td>{!! date('m/d/Y', strtotime($list['attempt']->created_at)) !!}</td>
                        </tr>
                        @endif
                    @endforeach
                  </tbody>
                </table>
        </div>
      </div>
    </section>
@else
    <section class="section">
        <div class="columns">
            <div class="column is-2">
              @include('frontend.includes.admin')
            </div>
            <div class="column">

              <div class="container">
                  <h1 class="title">Ungraded Quests</h1>
                  <h2 class="subtitle">There are no quests to grade.</h2>
              </div>
            </div>
      </div>
    </section>
@endif


@endsection

@section('after-scripts-end')

@stop