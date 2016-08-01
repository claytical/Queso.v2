@extends('frontend.layouts.unassigned')

@section('content')
    <div class="col-lg-12">
        <h2>Skills</h2>
        <p>Skills allow you to evaluate quests. You can set thresholds of points for specific skills before specific quests are able to be attempted by a student. The combined totals of each skill will be used to assign levels.</p>

        <p>If you prefer to not use sets of skills, you can create just one skill. For example, "Points" or "XP."</p>
               {!! Form::open(['url' => 'course/add/skill', 'class' => '', 'id' => 'add-skill']) !!}
               
               {{ Form::input('text', 'skill', null, ['class' => 'form-control', 'placeholder' => 'Skill Name', 'id' => 'skill_name']) }}
                {!! Form::submit('Add Skill', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}
                {!! var_dump($skills) !!}
        <ul id="skills">
            @foreach($skills as $skill)
               <li>{!! $skill->name !!}</li>
            @endforeach
        </ul>
    </div>
    <div class="col-lg-12">
        {{ link_to('course/add/levels', 'Continue to Levels', ['class' => 'btn btn-default btn-block']) }}
    </div>



@endsection

@section('after-scripts-end')
    <script>
// prepare the form when the DOM is ready 
    var options = { 
        target:        '#skills',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse,  // post-submit callback 
        dataType: 'json'
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
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
    console.log("submitting new skill with URL: " + queryString);
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return false; 
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
    $('#skills').append("<li>" + responseText.name + "</li>");
    console.log(responseText);
} 


    </script>
@stop