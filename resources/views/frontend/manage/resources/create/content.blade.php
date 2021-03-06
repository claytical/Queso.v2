@extends('frontend.layouts.master')

@section('content')
{!! Form::open(['url' => 'manage/resources/create', 'id'=>'resource-form', 'class' => 'msf']) !!}
    {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
    {{ Form::hidden('resource_type', 1, ['id' => 'resource_type']) }}

<section class="section dark-section" id="create_resource">
    <div class="container is-fluid">
    <div class="columns">
        <div class="column is-2">
            @include('frontend.includes.admin')
        </div>

        <div class="column">

            <div class="box">
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
                                        <h4 class="subtitle">Category</h4>
                                        <div class="field">
                                            <p>Content with the same category is grouped together on a course resource page</p>
                                        </div>
                                        <div class="field">
                                            <p class="control">
                                                {{ Form::input('text', 'tag', null, ['class' => 'input', 'placeholder' => 'Category Name', 'id' => 'tag']) }}
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
                                        <div id="resource_uploads" class="dropzone"></div>
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
  </div>
</section>

{!! Form::close() !!}

@endsection

@section('after-scripts-end')

    {{ Html::script('js/manage.resource.files.js')}}

    <script>

    $(".msf:first").multiStepForm({
        activeIndex: 0,
        hideBackButton : false,
        validate: {
          rules: {
            title: "required"
          }
        }
    });
    </script>

@stop