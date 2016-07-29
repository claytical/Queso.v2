@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Quests {{ link_to('manage/quest/create', 'New Quest', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>


<div class="row">
        <div class="col-lg-9">
            <h5>Quest Name</h5>
        </div>
        <div class="col-lg-3">
            <h5>Category</h5>
        </div>
        <div class="col-lg-12">
             <ul class="list-unstyled list">
                <li>
                    <div class="row">
                        <div class="col-lg-9 quest">
                            {{ link_to('quest/1/attempt/submission', 'Submission Quest') }}
                        </div>

                        <div class="col-lg-3 category">
                            Prototypes
                        </div>
                    </div>
                </li>

                <li>
                    <div class="row">
                        <div class="col-lg-9 quest">
                            {{ link_to('quest/1/attempt/submission', 'Link Quest') }}
                        </div>

                        <div class="col-lg-3 category">
                            Prototypes
                        </div>
                    </div>
                </li>

                <li>
                    <div class="row">
                        <div class="col-lg-9 quest">
                            {{ link_to('quest/1/attempt/submission', 'Video Quest') }}
                        </div>

                        <div class="col-lg-3 category">
                            Prototypes
                        </div>
                    </div>
                </li>
            </ul>
    </div>
</div>


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