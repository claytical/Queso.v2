@if($quest->quest_type_id == 1)
    {!! $attempt->submission !!}
@endif

@if($quest->quest_type_id == 4)
    {!! $attempt->url !!}
@endif


<a href="http://queso.cc/{!! $link !!}">Click to Grade</a>