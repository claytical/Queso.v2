@extends('frontend.layouts.master')

@section('content')
<h2>Quest Name</h2>
        <div class="col-lg-12">
            <div class="row">
                <iframe src="https://player.vimeo.com/video/171365895?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
            <div class="row">
                {!! Form::open(array('url' => 'quest/watched')) !!}
                @foreach($skills as $skill)
                <div class="progress skill-{!! $skill->id !!}">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="{!! $skill->pivot->amount !!}" style="width:0%;"></div>
                </div>
                {!! Form::hidden('skill[]', 0, ['id' => 'skill-'.$skill->id]) !!}
                {!! Form::hidden('skill_id[]', $skill->id, ['id' => 'v-skill-'.$skill->id]) !!}

                @endforeach
                {!! Form::submit('Get Points', ['class' => 'btn btn-primary btn-submit', 'disabled' => '']) !!}
                {!! Form::close() !!}
            </div>
        </div>

@endsection

@section('after-scripts-end')
@stop