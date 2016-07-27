@extends('frontend.layouts.master')

@section('content')
<h2>Ungraded Submissions</h2>

        <div class="col-lg-12">
            <div id="submission-list">
              <input class="search" placeholder="Search" />
                  <button class="sort" data-sort="name">
                    Sort
                  </button>
                <ul class="list-unstyled list">
                    <li>
                        <h4 class="submission">{{ link_to('quest/1/attempt/submission', 'Submission Quest') }}</h4>                  
                        <p>Submitted <span class="date">00/00/0000</span> by <span class="student">Student Name</span></p>
                    </li>

                    <li>
                        <h4 class="submission">{{ link_to('quest/1/attempt/submission', 'Link Quest') }}</h4>                  
                        <p>Submitted <span class="date">00/00/0000</span> by <span class="student">Student Name</span></p>
                    </li>

                    <li>
                        <h4 class="submission">{{ link_to('quest/1/attempt/submission', 'Feedback Quest') }}</h4>                  
                        <p>Submitted <span class="date">00/00/0000</span> by <span class="student">Student Name</span></p>
                    </li>

                </ul>
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