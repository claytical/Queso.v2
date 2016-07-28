@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
        <h2>In Class Work</h2>
</div>
        <div class="col-lg-12">
            <div id="quest-list">
            <div class="col-lg-9">
              <input class="form-control search" placeholder="Search" />
            </div>
            <div class="col-lg-3">
                <div class="btn-group pull-right">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="#" class="sort" data-sort="quest">Quest Name</a></li>
                    <li><a href="#" class="sort" data-sort="category">Category</a></li>
                  </ul>
                </div>              
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Quest Name</h4>
                    </div>
                    <div class="col-lg-3">
                        <h4>Category</h4>
                    </div>
                    <div class="col-lg-3">
                        <h4>Completion Rates</h4>
                    </div>

                </div>                  
                  

                <ul class="list-unstyled list">
                    <li>
                        <div class="row">
                            <div class="col-lg-6 quest">
                                {{ link_to('grade/activity/1', 'Activity #1') }}
                            </div>

                            <div class="col-lg-3 category">
                                Prototypes
                            </div>

                            <div class="col-lg-3">
                                <span class="completion pull-right">
                                10/15
                                </span>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="row">
                            <div class="col-lg-6 quest">
                                {{ link_to('grade/activity/2', 'Activity #2') }}
                            </div>

                            <div class="col-lg-3 category">
                                Prototypes
                            </div>

                            <div class="col-lg-3">
                                <span class="completion pull-right">
                                6/15
                                </span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-lg-6 quest">
                                {{ link_to('grade/activity/{quest_id}', 'Activity #3') }}
                            </div>

                            <div class="col-lg-3 category">
                                Research Paper
                            </div>

                            <div class="col-lg-3">
                                <span class="completion pull-right">
                                    2/15
                                </span>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            </div>
        </div>

@endsection

@section('after-scripts-end')
    <script>
        var quest_list_options = {
        valueNames: [ 'quest', 'category' ]
    };

    var questList = new List('quest-list', quest_list_options);
    </script>
@stop