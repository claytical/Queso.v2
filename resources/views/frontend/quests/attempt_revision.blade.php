@extends('frontend.layouts.master')

@section('content')
        <div class="col-lg-12">
            <div class="col-lg-9">
                <h2>{!! $quest->name !!}</h2>
                {!! $quest->instructions !!}
                {!! Form::open(array('url' => 'quest/submit', 'class' => 'form-inline')) !!}
                {!! Form::hidden('revision', $previous_attempt->revision + 1) !!}
                {!! Form::hidden('quest_id', $quest->id) !!}
                <div class="form-group">
                    @if($quest->quest_type_id == 1)
                        {!! Form::textarea('submission', $previous_attempt->submission); !!}
                    @endif
                    @if($quest->quest_type_id == 4)
                        {!! Form::text('link', null); !!}
                    @endif

                </div>

                {!! Form::submit('Submit Revision', ['class' => 'btn btn-default']) !!}

                {!! Form::close() !!}
            </div>
            <div class="col-lg-3">
            <ul class="list-unstyled">
                @foreach($skills as $index => $skill)
                    <li>
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <h4>Current Grade</h4>
                            </div>
                            <div class="col-lg-6">
                                {!! $skill->name !!}
                            </div>
                            <div class="col-lg-6">                                
                                {!! $existing_skills[$index]->pivot->amount !!} / {!! $skill->pivot->amount !!}
                            </div>
                        </div>
                    </li>
                @endforeach
                    <li role="separator" class="divider"></li>
                    <li>
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                            Points Total
                            </div>
                            <div class="col-lg-6">
                               {!! $existing_skills->sum('amount') !!} / {!! $quest->skills()->sum('amount') !!}
                            </div>
                        </div>
                    </li>
            </ul>
                @if($quest->expires_at)
                <h4>Due {!! $quest->expires_at !!}</h4>
                @endif


            </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    Dropzone.options.myAwesomeDropzone = {
    init: function() {
        this.on("successmultiple", function(file, response){
            response.forEach(function(entry) {
                console.log(entry);
            });
        });
    },
    parallelUploads: 10000,
    method: "post",
    addRemoveLinks: false,
    uploadMultiple: true,
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    url: '/dropzone/uploadFiles'
};
    </script>
@stop