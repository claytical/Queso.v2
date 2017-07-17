@extends('frontend.layouts.master')

@section('content')

<section class="section">
    <div class="columns">
        <div class="column is-2">
        @include('frontend.includes.admin')
        </div>
        <div class="column">
            <a href="#" class="button is-pulled-right is-large" id="show_points">Show Points</a>
            <h1 class="title">Students</h1>

        @if(!$students->isEmpty())

            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email Address</th>
                  <th class="grades">Points</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ link_to('manage/student/'.$student->id, $student->name) }}</td>
                        <td><a href="mailto:{!! $student->email !!}">{!! $student->email !!}</td>
                        <td class="grades">{!! $student->skills()->where('course_id', '=', $course_id)->sum('amount') !!}</td>
                        <td>{{ link_to('manage/student/'.$student->id.'/leave', '', ['class' => 'delete']) }}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
        @else
        <p class="subtitle">There are currently no students enrolled in this course</p>
        @endif
        </div>
      </div>
</section>

@endsection

@section('after-scripts-end')
    <script>
    var showing_grades = false;
    $('#show_points').click(function() {
        $('.grades').toggle();
        showing_grades = !showing_grades;
        if(showing_grades) {
            $(this).text("Hide Points");
        }
        else {
            $(this).text("Show Points");
        }
    });

    $( document ).ready(function() {
        $(".grades").hide();
    });

    </script>
@stop