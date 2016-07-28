@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <h2>Update Announcement</h2>
</div>

<div class="col-lg-9">
    {!! Form::open(['url' => 'manage/announcement/update', 'id'=>'announcement-update-form']) !!}
    {{ Form::input('text', 'headline', null, ['class' => 'form-control', 'placeholder' => 'Adventure Awaits!', 'id' => 'headline']) }}
    {!! Form::textarea('description', null, ['class' => 'field', 'files' => true]) !!}

</div>


<div class="col-lg-3">
                    {!! Form::checkbox('sticky', 1)} Sticky
                    {!! Form::submit('Post', ['class' => 'btn btn-primary btn-lg btn-block']) !!}

                    {!! Form::close() !!}
</div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop