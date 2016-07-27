@extends('frontend.layouts.master')

@section('content')
<h2>In Class Work</h2>

        <div class="col-lg-12">
            <div id="quest-list">
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
                    <li><a href="#" class="sort" data-sort="category">Category</a></li>
                  </ul>
                </div>              
            </div>
            <div class="col-lg-12">
                  
                  

                <ul class="list-unstyled list">
                    <li>
                        <div class="row">
                            <div class="col-lg-4 quest">
                                {{ link_to('quest/1/attempt/submission', 'Submission Quest') }}
                            </div>

                            <div class="col-lg-4 category">
                                Prototypes
                            </div>

                            <div class="col-lg-4">
                            10/15
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="row">
                            <div class="col-lg-4 quest">
                                {{ link_to('quest/1/attempt/submission', 'Link Quest') }}
                            </div>

                            <div class="col-lg-4 category">
                                Prototypes
                            </div>

                            <div class="col-lg-4">
                            6/15
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-lg-4 quest">
                                {{ link_to('quest/1/attempt/submission', 'Feedback Quest') }}
                            </div>

                            <div class="col-lg-4 category">
                                Research Paper
                            </div>

                            <div class="col-lg-4">
                            2/15
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