@extends('frontend.layouts.master')

@section('content')
    {!! Form::open(['url' => 'manage/announcements/create', 'id'=>'quest-create-form']) !!}
<div class="col-lg-12">
    <h2>Create Announcement</h2>
</div>

<div class="col-lg-9">
	<div class="form-group">
    	{{ Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Adventure Awaits!', 'id' => 'headline']) }}
	</div>
    {!! Form::textarea('body', null, ['class' => 'field', 'files' => true]) !!}
                    {!! Form::checkbox('sticky', 1) !!} Sticky

</div>


<div class="col-lg-3">
                    {!! Form::submit('Post', ['class' => 'btn btn-primary btn-lg btn-block']) !!}

</div>
                    {!! Form::close() !!}
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop