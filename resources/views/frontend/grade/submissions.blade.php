@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <div class="row">
        <h2>Ungraded Submissions</h2>
    </div>
</div>

        <div class="col-lg-12">
            <div id="submission-list">
            <div class="col-lg-9">
              <input class="form-control search" placeholder="Search" />
            </div>
            <div class="col-lg-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="#" class="sort" data-sort="submission">Quest Name</a></li>
                    <li><a href="#" class="sort" data-sort="date">Date</a></li>
                    <li><a href="#" class="sort" data-sort="student">Student Name</a></li>
                  </ul>
                </div>              
            </div>
            <div class="col-lg-12">
                  
                  

                <ul class="list-unstyled list">
                    @foreach($lists as $list)
                    <li>
                    {!! var_dump($list['attempt']) !!}
                        @if($list['type'] == 1)
                            <h4 class="submission">{{ link_to('grade/submission/', $list['quest']) }}</h4>
                        @endif
                        <p>Submitted <span class="date"></span> by <span class="student">{!! $list['student'] !!}</span></p>
                    </li>
                    @endforeach
                </ul>
            </div>
            </div>
        </div>

@endsection

@section('after-scripts-end')
    <script>
        var submission_list_options = {
        valueNames: [ 'submission', 'date', 'student' ]
    };

    var hackerList = new List('submission-list', submission_list_options);
    </script>
@stop