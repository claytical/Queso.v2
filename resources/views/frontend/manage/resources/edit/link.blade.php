@extends('frontend.layouts.master')

@section('content')
{!! Form::open(['url' => 'manage/resources/update', 'id'=>'resource-create-form', 'class' => '']) !!}
    {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
    {{ Form::hidden('resource_type', 2, ['id' => 'resource_type']) }}

<section class="hero" id="create_resource">
  <div class="hero-body">
    <div class="container is-fluid">
            <div class="tile">
                <div class="tile is-8 is-parent">
                  <div class="tile is-child">
                  <!-- Title and Description -->                
                    <div class="field">
                      <p class="control">
                        {{ Form::input('text', 'title', $resource->title, ['class' => 'input is-large', 'placeholder' => 'Title for Resource', 'id' => 'resource_title']) }}
                      </p>
                    </div>

                    <div class="field">
                      <p class="control">
                       {{ Form::input('text', 'link', $resource->link, ['class' => 'input is-large', 'placeholder' => 'http://www.example.com/cool-stuff', 'id' => 'link']) }}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="tile is-4 is-parent">
                    <div class="tile is-child notification">
                      <h4 class="subtitle">Category</h4>
                        <div class="field">
                          <p class="control">
                            {{ Form::input('text', 'tag', $resource->tag, ['class' => 'input', 'placeholder' => 'Category Name', 'id' => 'tag']) }}
                          </p>
                        </div>                      
                    </div>
                </div>
              </div>
        <button data-type="submit" class="button is-primary is-pulled-right is-large" type="submit">Create Link</button>

    </div>
  </div>
</section>
{!! Form::close() !!}

@endsection

@section('after-scripts-end')

@stop