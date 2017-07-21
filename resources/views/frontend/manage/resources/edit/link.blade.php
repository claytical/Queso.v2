@extends('frontend.layouts.master')

@section('content')
{!! Form::open(['url' => 'manage/resource/update', 'id'=>'resource-form', 'class' => '']) !!}
    {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
    {{ Form::hidden('resource_type', 2, ['id' => 'resource_type']) }}
    {{ Form::hidden('id', $resource->id, ['id' => 'resource_id']) }}
    

<section class="section dark-section" id="create_resource">
    <div class="container is-fluid">
            <div class="tile">
                <div class="tile is-2 is-parent">
                  @include('frontend.includes.admin')
                </div>

                <div class="tile is-6 is-parent">
                  <div class="tile is-child box">
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
                    <div class="tile is-child box">
                      <h4 class="subtitle">Category</h4>
                        <div class="field">
                          <p class="control">
                            {{ Form::input('text', 'tag', $resource->tag, ['class' => 'input is-large', 'placeholder' => 'Category Name', 'id' => 'tag']) }}
                          </p>
                        </div>      
                        <div class="field">
                        <p class="control">
                          <button data-type="submit" class="button is-primary is-fullwidth is-large" type="submit">Update Link</button>
                        </p>
                        </div>                
                    </div>
                </div>
              </div>

  </div>
</section>
{!! Form::close() !!}

@endsection

@section('after-scripts-end')

@stop