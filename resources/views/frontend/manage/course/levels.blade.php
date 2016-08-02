@extends('frontend.layouts.unassigned')

@section('content')

    <div class="col-lg-12">
        <h2>Levels</h2>
        <p>You probably want more than one level. Traditionally, most classes require over 60% to get a D. That means most of your students will have an F for the majority of the class and make great progress towards the end of the course. To encourage motivation, try creating levels in between levels that correspond to letter grades.</p>

        <div id="levels">
            @foreach($levels as $level)
                    {!! $level->name !!}
                    {!! Form::open(['url' => 'course/remove/level', 'class' => 'remove-level']) !!}
                    {!! Form::hidden('level', $level->id) !!}
                    {!! Form::submit('Remove', ['class' => 'btn btn-danger btn-xs pull-right']) !!}                           
                    {!! Form::close() !!}
            @endforeach
        </div>
    </div>

    <div class="col-lg-12">
        {!! Form::open(['url' => 'course/add/level', 'class' => 'form-inline', 'id' => 'add-level']) !!}
          <div class="form-group">
            <label for="skill">Level Name</label>
                {{ Form::input('text', 'level', null, ['class' => 'form-control', 'placeholder' => 'Level Name', 'id' => 'level_name']) }}
          </div>
          <div class="form-group">
          </div>
            {!! Form::submit('Add Level', ['class' => 'btn btn-primary btn-lg']) !!}
            {!! Form::close() !!}


    </div>


    <div class="col-lg-12">
        {{ link_to('course/instructions', 'Finish!', ['class' => 'btn btn-default btn-block']) }}
    </div>
@endsection

@section('after-scripts-end')
    <script>
// prepare the form when the DOM is ready 
    var options = { 
        target:        '#skills',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse,  // post-submit callback 
        dataType: 'json',
        clearForm: true
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
    // bind to the form's submit event 
$( "#add-skill" ).submit(function( event ) {
//          alert( "Handler for .submit() called." );
 //           event.preventDefault();       // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        $(this).ajaxSubmit(options); 
 
        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false; 
    }); 

// pre-submit callback 
function showRequest(formData, jqForm, options) { 

    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
} 
 
// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
 
    // if the ajaxSubmit method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
 
    // if the ajaxSubmit method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
    $('#skills').append("<div class='row'>" + responseText.name + "<form method='POST' action='course/remove/level'><input name='level' type='hidden' value='" + responseText.id + "'><input class='btn btn-danger btn-xs pull-right' type='submit' value='Remove'></form></div>");
    console.log(responseText);
}  
    </script>
@stop