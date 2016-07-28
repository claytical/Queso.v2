@extends('frontend.layouts.master')

@section('content')

<div class="col-lg-9">
    <h2>Quest Name, Student Name</h2>
    <h4>Submitted 00/00/0000</h4>
</div>
<div class="col-lg-3">
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#information">More Information</button>
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Original <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="#">Revision #1</a></li>
    <li><a href="#">Revision #2</a></li>
  </ul>
</div>              
</div>
<div class="modal fade" id="information" tabindex="-1" role="dialog" aria-labelledby="information">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="information">Quest Information</h4>
      </div>
      <div class="modal-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#description" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
            <li role="presentation"><a href="#previous_feedback" aria-controls="profile" role="tab" data-toggle="tab">Previous Feedback</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="description">Donec id elit non mi porta gravida at eget metus. Sed posuere consectetur est at lobortis. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec sed odio dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla.
</div>
            <div role="tabpanel" class="tab-pane" id="previous_feedback">
                <blockquote>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                  <footer>Someone famous in <cite title="Source Title">Joan Ridley</cite></footer>
                </blockquote>

                <blockquote>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                  <footer>Someone famous in <cite title="Source Title">Michael Scott</cite></footer>
                </blockquote>

            </div>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <div class="col-lg-12">
<!--            <div><div style="width: 100%; height: 0px; position: relative; padding-bottom: 56.2493%;"><iframe src="//player.vimeo.com/video/176459945?byline=0&badge=0&portrait=0&title=0" frameborder="0" allowfullscreen style="width: 100%; height: 100%; position: absolute;"></iframe></div></div>-->
        <p>Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Maecenas faucibus mollis interdum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla. Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>

        <p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod. Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper.</p>

        <p>
        Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Curabitur blandit tempus porttitor. Donec id elit non mi porta gravida at eget metus.
        </p>
        <h6>Attached Files</h6>
        <a href="#" class="btn btn-default">filename.pdf</a>         
        <a href="#" class="btn btn-default">filename.pdf</a>
        <a href="#" class="btn btn-default">filename.pdf</a>

 
        <h4>Peer Feedback</h4>
        <h5>Positives</h5>
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <footer>Someone famous in <cite title="Source Title">Joan Ridley</cite></footer>
        </blockquote>

        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <footer>Someone famous in <cite title="Source Title">Michael Scott</cite></footer>
        </blockquote>

        <h5>Areas for Improvement</h5>

        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <footer>Someone famous in <cite title="Source Title">Joan Ridley</cite></footer>
        </blockquote>

        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <footer>Someone famous in <cite title="Source Title">Michael Scott</cite></footer>
        </blockquote>

        <h4>Feedback to Student</h4>
            {!! Form::open(array('url' => 'grade/confirm')) !!}

        <div class="row">
            <div class="col-lg-9">
                {!! Form::textarea('liked', null, ['class' => 'field', 'files' => true]) !!}
            </div>
            <div class="col-lg-3">
                <div class="col-lg-6">
                    <label>Skill #1</label>
                </div>
                <div class="col-lg-6">
                    <input type="number" class="form-control" id="skill1">
                </div>

                <div class="col-lg-6">
                    <label>Skill #2</label>
                </div>
                <div class="col-lg-6">
                    <input type="number" class="form-control" id="skill2">
                </div>

                <div class="col-lg-6">
                    <label>Skill #3</label>
                </div>
                <div class="col-lg-6">
                    <input type="number" class="form-control" id="skill3">
                </div>

                <hr/>

                <div class="col-lg-12">
                    <div class="pull-right">
                            <span>xx</span> / 50
                    </div>
                </div>

                  <div class="col-lg-12">
                        <button type="button" class="btn btn-default btn-block">Grade</button>

                  </div>
            </div>


        </div>
        {!! Form::close() !!}

    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop