@extends('frontend.layouts.master')

@section('content')

<div class="col-lg-9">
    <h2>Quest Name, Student Name</h2>
    <h4>Submitted 00/00/0000</h4>
</div>
<div class="col-lg-3">
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default">More Information</button>
</div>              
</div>
    <div class="col-lg-12">
            <div><div style="width: 100%; height: 0px; position: relative; padding-bottom: 56.2493%;"><iframe src="//player.vimeo.com/video/176459945?byline=0&badge=0&portrait=0&title=0" frameborder="0" allowfullscreen style="width: 100%; height: 100%; position: absolute;"></iframe></div></div>
 
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
 
    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop