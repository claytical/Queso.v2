@if($quest->quest_type_id == 1 && $quest->submissions)
    {!! $attempt->submission !!}
@endif

@if($quest->quest_type_id == 4)
    <a href="{!! $attempt->url !!}">Link to Attempt</a>
@endif


<a href="http://queso.cc/{!! $link !!}">Click to Grade</a>