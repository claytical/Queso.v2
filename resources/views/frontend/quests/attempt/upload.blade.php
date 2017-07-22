@extends('frontend.layouts.master')

@section('content')
<section class="section dark-section" id="attempt_">
        <div class="container is-fluid">        
            {!! Form::open(array('url' => 'quest/submit', 'id' => 'upload-quest')) !!}
            {!! Form::hidden('quest_id', $quest->id) !!}       
            {!! Form::hidden('revision', 0) !!}

            <div class="tile">

                <div class="tile is-parent is-4">
                    <div class="tile is-child box">
                        <div class="container is-fluid">
                            <h2 class="title headline is-uppercase">{!! $quest->name !!}</h2>
                            <h3 class="subtitle">{!! $quest->instructions !!}</h3>

                            <div id="submission_upload" class="dropzone"></div>                        
                        </div>
                    </div>
                </div>
                <div class="tile is-parent is-4 is-vertical">
                    <div class="tile is-child box">
                        <div class="container is-fluid">
                            <div id="attached_files">
                                <p id="no_attached_files">No files have been attached yet.</p>
                            </div>
                        </div>
                        <div class="container is-fluid">
                            {!! Form::submit('Submit', ['class' => 'button is-primary is-large is-pulled-right']) !!}
                        </div>
                    
                    </div>
                </div>
                
                <div class="tile is-4 is-parent">
                    <div class="tile is-child box">
                        @if($quest->expires_at)
                            <h4 class="title">Due {!! date('m-d-Y', strtotime($quest->expires_at)) !!}</h4>
                        @endif

                        @if(!$files->isEmpty())
                            <p class="subtitle">Attached Files</p>

                            @foreach($files as $file)
                                <a class="level-item" href="{!! URL::to('uploads/' . $file->name) !!}" title="{!! substr($file->name,5) !!}" download>
                                <span class="icon is-small"><i class="fa fa-paperclip"></i></span> 
                                {!! substr($file->name,5) !!}
                                </a>
                            @endforeach
                        @endif
                        <p class="subtitle">{!! $quest->skills()->sum('amount') !!} Points Available</p>
                            @foreach($skills as $skill)
                                {!! $skill->name !!} / 
                                {!! $skill->pivot->amount !!}
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
            {!! Form::close() !!}
</section>

@endsection

@section('after-scripts-end')
    {{ Html::script('js/upload.quest.files.js')}}

@stop