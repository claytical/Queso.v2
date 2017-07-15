@extends('frontend.layouts.master')

@section('content')
{!! Form::open(['url' => 'manage/resources/create', 'id'=>'resource-create-form', 'class' => 'msf']) !!}
                    {{ Form::hidden('quest_type_id', 1, ['id' => 'submission_type_id']) }}
                    {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
                    {{ Form::hidden('submissions_allowed', true, ['id' => 'submissions_allowed']) }}
                    {{ Form::hidden('uploads_allowed', false, ['id' => 'uploads_allowed']) }}
                    {{ Form::hidden('groups', false, ['id' => 'groups_allowed']) }}
                    {{ Form::hidden('instant', false, ['id' => 'instant_allowed']) }}

<section class="hero" id="create_resource">
  <div class="hero-body">
    <div class="container is-fluid">
        <div class="msf-header">
          <div class="has-text-centered">
            <div class="columns">
              <div class="msf-step column"><i class="fa fa-info"></i> <p>Information</p></div>
              <div class="msf-step column"><i class="fa fa-paperclip"></i><p>File Attachments</p></div>
            </div>
          </div>
        </div>
        <div class="msf-content">
        <div class="msf-view">
            <div class="tile">
                <div class="tile is-8 is-parent">
                  <div class="tile is-child">
                  <!-- Title and Description -->                
                    <div class="field">
                      <p class="control">
                        {{ Form::input('text', 'title', null, ['class' => 'input is-large', 'placeholder' => 'Title for Resource', 'id' => 'resource_title']) }}
                      </p>
                    </div>

                    <div class="field">
                      <p class="control">
                        {!! Form::textarea('description', null, ['class' => 'input', 'placeholder' => 'Content goes here...', 'files' => false, 'id' => 'description']) !!}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="tile is-4 is-parent">
                    <div class="tile is-child notification">
                      <h4 class="subtitle">Allow Revisions</h4>
                        <div class="field">
                          <p class="control">
                            {{ Form::input('text', 'tag', null, ['class' => 'input', 'placeholder' => 'Category', 'id' => 'tag']) }}
                          </p>
                        </div>                      
                    </div>
                </div>
              </div>
            </div>
            <div class="msf-view">

             <div class="tile">
                  <div class="tile is-6 is-parent">
                    <div class="tile is-child">
                        <div id="resource_upload" class="dropzone"></div>
                    </div>
                  </div>

                  <div class="tile is-6 is-parent">
                      <div class="tile is-child notification">
                        <h4 class="subtitle">Attached Files</h4>
                          <div id="attached_files">
                            <p id="no_attached_files">No files have been attached yet.</p>
                          </div>
                      </div>
                  </div>
                </div>

            </div>
          </div>
          <div class="msf-navigation">
                <button data-type="back" class="button is-large msf-nav-button" type="button">Previous</button>
                <button data-type="next" class="button is-large msf-nav-button" type="button">Next</button>
                <button data-type="submit" class="button msf-nav-button is-primary is-large" type="submit">Create Content</button>
          </div>
    </div>
  </div>
</section>
{!! Form::close() !!}



























<label for="link">Embedded Link</label>
   	{{ Form::input('text', 'link', null, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch?q=AAAAAAA', 'id' => 'link']) }}
</div>


    {!! Form::close() !!}

@endsection

@section('after-scripts-end')

    {{ Html::script('js/manage.resource.files.js')}}


    $(".msf:first").multiStepForm({
        activeIndex: 0,
        hideBackButton : false,
        validate: {
          rules: {
            name: "required",
            description: "required"
          }
        }
    });
    </script>

















    <script>

    </script>
@stop