@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Resources {{ link_to('manage/resources/create', 'New Resource', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>


<div class="row">
        <div class="col-lg-9">
            <h5>Name</h5>
        </div>
        <div class="col-lg-3">
            <h5>Category</h5>
        </div>
        <div class="col-lg-3">

        </div>

        <div class="col-lg-12">
             <ul class="list-unstyled list">
                <li>
                    <div class="row">
                        <div class="col-lg-6 name">
                            {{ link_to('manage/resource/1', 'Handout #1') }}
                        </div>

                        <div class="col-lg-3 category">
                            Handouts
                        </div>

                        <div class="col-lg-3">
                            {{ link_to('manage/resource/1/delete', 'Delete', ['class'=> 'btn btn-danger']) }}
                        </div>
 
                    </div>
                </li>

                <li>
                    <div class="row">
                        <div class="col-lg-6 name">
                            {{ link_to('manage/resource/1', 'Handout #2') }}
                        </div>
                        <div class="col-lg-3 category">
                            Handouts
                        </div>
                        <div class="col-lg-3">
                            {{ link_to('manage/resource/1/delete', 'Delete', ['class'=> 'btn btn-danger']) }}
                        </div>
 
                    </div>
                </li>

                <li>
                    <div class="row">
                        <div class="col-lg-6 name">
                            {{ link_to('manage/resource/1', 'Syllabus') }}

                        </div>
                        <div class="col-lg-3 category">
                        </div>

                        <div class="col-lg-3">
                            {{ link_to('manage/announcement/1/delete', 'Delete', ['class'=> 'btn btn-danger']) }}
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