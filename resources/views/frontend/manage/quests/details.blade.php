@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <h2>Quest Details</h2>
</div>
{!! var_dump($data) !!}
<div class="col-lg-9">

    <div>

      <!-- Nav tabs -->
      <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
        <li role="presentation"><a href="#skills" aria-controls="skills" role="tab" data-toggle="tab">Skills</a></li>
        <li role="presentation"><a href="#thresholds" aria-controls="thresholsd" role="tab" data-toggle="tab">Thresholds</a></li>
        <li role="presentation"><a href="#files" aria-controls="files" role="tab" data-toggle="tab">Files</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            {{ Form::input('text', 'name', $quest->name, ['class' => 'form-control', 'placeholder' => 'A New Adventure', 'id' => 'quest_title']) }}

            {!! Form::textarea('description', $quest->instructions, ['class' => 'field']) !!}

        </div>
        <div role="tabpanel" class="tab-pane" id="skills">
            SKILL SET

        </div>
        <div role="tabpanel" class="tab-pane" id="thresholds">
            THRESHOLDS
        </div>
        <div role="files" class="tab-pane" id="files">
                    {!! Form::open(['url' => 'dropzone/uploadFiles', 'class' => 'dropzone', 'files'=>true, 'id'=>'my-awesome-dropzone']) !!}
                    {!! Form::close() !!}
        </div>
      </div>

    </div>


</div>

<div class="col-lg-3">
    <h4>Options</h4>


<!-- VIDEO -->
    {{ Form::input('text', 'quest_url', null, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch/?q=AAAAAAAA', 'id' => 'quest_url']) }}
<!-- GENERALIZED -->
    {{ Form::input('date', 'expiration', null, ['class' => 'form-control', 'id' => 'quest_expiration']) }}
    
<!-- ACTIVITY -->
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">
            Instant Credit
          </label>
        </div>
<!-- LINK OR SUBMISSION -->
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">
            Peer Feedback
          </label>
        </div>
<!-- SUBMISSION -->
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">
            Revisions
          </label>
        </div>

<!-- GENERALIZED -->

    {!! Form::submit('Update', ['class' => 'btn btn-primary btn-lg btn-block']) !!}

</div>



@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop