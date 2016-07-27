@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <h2>Quests <a href="#" class="btn btn-primary btn-lg pull-right">New Quest</a></h2>
</div>
<hr/>

<div class="col-lg-12">

    <div class="col-lg-9">
        <div class="col-lg-6">
            <h6>Quest Name</h6>
        </div>
        <div class="col-lg-3">
            <h6>Category</h6>
        </div>
         <ul class="list-unstyled list">
                            <li>
                                <div class="row">
                                    <div class="col-lg-6 quest">
                                        {{ link_to('quest/1/attempt/submission', 'Submission Quest') }}
                                    </div>

                                    <div class="col-lg-3 category">
                                        Prototypes
                                    </div>
                                </div>
                            </li>
 
                            <li>
                                <div class="row">
                                    <div class="col-lg-6 quest">
                                        {{ link_to('quest/1/attempt/submission', 'Link Quest') }}
                                    </div>

                                    <div class="col-lg-3 category">
                                        Prototypes
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="row">
                                    <div class="col-lg-6 quest">
                                        {{ link_to('quest/1/attempt/submission', 'Video Quest') }}
                                    </div>

                                    <div class="col-lg-3 category">
                                        Prototypes
                                    </div>
                                </div>
                            </li>
        </ul>
    </div>

    <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Filter Options</div>
                        <div class="panel-body">
                            <div class="btn-group btn-block">
                              <button type="button" class="btn-block btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Category <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href="#" class="sort" data-sort="submission">Prototypes</a></li>
                                <li><a href="#" class="sort" data-sort="date">Research Papers</a></li>
                              </ul>
                            </div>   
                                <h5>Requirements</h5>
                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label for="skill1" class="col-sm-2 control-label">Skill #1</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="skill1">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="skill2" class="col-sm-2 control-label">Skill #2</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="skill2">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="skill2" class="col-sm-2 control-label">Skill #2</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="skill2">
                                        </div>
                                      </div>

                                      <button class="btn btn-default btn-block">Filter</button>

                                    </form> 



                        </div>
                </div>

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