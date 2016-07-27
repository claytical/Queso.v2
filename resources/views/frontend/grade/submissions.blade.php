@extends('frontend.layouts.master')

@section('content')
<h2>Ungraded Submissions</h2>

        <div class="col-lg-12">
            <div id="submission-list">
              <input class="search" placeholder="Search" />
                  <button class="sort" data-sort="submission">
                    Sort by Quest Name
                  </button>
                  <button class="sort" data-sort="date">
                    Sort by Date
                  </button>
                  <button class="sort" data-sort="student">
                    Sort by Student Name
                  </button>

                <ul class="list-unstyled list">
                    <li>
                        <h4 class="submission">{{ link_to('quest/1/attempt/submission', 'Submission Quest') }}</h4>                  
                        <p>Submitted <span class="date">01/12/2016</span> by <span class="student">Gloria</span></p>
                    </li>

                    <li>
                        <h4 class="submission">{{ link_to('quest/1/attempt/submission', 'Link Quest') }}</h4>                  
                        <p>Submitted <span class="date">01/12/2015</span> by <span class="student">Sauron</span></p>
                    </li>

                    <li>
                        <h4 class="submission">{{ link_to('quest/1/attempt/submission', 'Feedback Quest') }}</h4>                  
                        <p>Submitted <span class="date">03/01/2016</span> by <span class="student">Adrian</span></p>
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