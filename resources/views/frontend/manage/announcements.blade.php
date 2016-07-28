@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Announcements</h2>
    </div>
</div>


<div class="row">
        <div class="col-lg-9">
            <h5>Headline</h5>
        </div>
        <div class="col-lg-3">
            <h5>Actions</h5>
        </div>

        <div class="col-lg-12">
             <ul class="list-unstyled list">
                <li>
                    <div class="row">
                        <div class="col-lg-9 announcement">
                            {{ link_to('manage/announcement/1', 'Sally Fields') }}
                        </div>

                        <div class="col-lg-3 grade">
                            [STICKY] / [DELETE]
                        </div>
 
                    </div>
                </li>

                <li>
                    <div class="row">
                        <div class="col-lg-9 announcement">
                            {{ link_to('manage/announcement/1', 'Sally Fields') }}
                        </div>

                        <div class="col-lg-3 grade">
                            [STICKY] / [DELETE]
                        </div>
 
                    </div>
                </li>

                <li>
                    <div class="row">
                        <div class="col-lg-9 announcement">
                            {{ link_to('manage/announcement/1', 'Sally Fields') }}
                        </div>

                        <div class="col-lg-3 grade">
                            [STICKY] / [DELETE]
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