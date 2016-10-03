@if($quest->quest_type_id == 1)
    {!! $attempt->submission !!}
@endif

@if($quest->quest_type_id == 4)
    {!! $attempt->url !!}
@endif


<a href="http://queso.cc/{{!! $notice->url !!}">Click to Grade</a>