@extends('frontend.layouts.master')

@section('content')
<section class="section">
    <a href="{!! URL::to('quest/redeem') !!}" class="is-pulled-right button is-medium is-primary is-outlined">Instant Credit</a>
    <h1 class="title">Available Quests</h1>
    @if($unlocked)
        <table class="table">
            <thead>
                <tr>
                    <th data-field="name" 
                    data-sortable="true">Quest</th>
                    <th data-field="points" 
                    data-sortable="true">Points</th>
                    <th data-field="course">Course</th>
                    <th data-field="expiration" 
                    data-sortable="true">Expires</th>
                </tr>            
            </thead>
            <tbody>

            @foreach($unlocked as $q)
                        <tr>
                            <td>
                                @if($q->quest_type_id == 1)
                                    <a href="{!! URL::to('quest/attempt/response/'.$q->id) !!}">{!! $q->name !!}</a>            
                                @endif
                                @if($q->quest_type_id == 2)
                                    {!! $q->name !!}
                                @endif
                                @if($q->quest_type_id == 3)
                                    <a href="{!! URL::to('quest/watch/'.$q->id) !!}">{!! $q->name !!}</a>                    
                                @endif
                                @if($q->quest_type_id == 4)
                                    <a href="{!! URL::to('quest/attempt/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 5)
                                    <a href="{!! URL::to('quest/attempt/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 6)
                                    <a href="{!! URL::to('quest/attempt/group/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 7)
                                    <a href="{!! URL::to('quest/attempt/group/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                            </td>
                            <td>
                                {!! $q->skills()->sum('amount') !!}
                            </td>
                            <td>{!! $q->course->name !!}</td>
                            <td>
                                @if($q->expires_at)
                                {!! date('m/d/Y', strtotime($q->expires_at)) !!}
                                @else
                                Never
                                @endif
                            </td>
                        </tr>
            @endforeach

                </tbody>
            </table>
    @else
        <p>There are no available quests.</p>
    @endif

    @if(!$revisable->isEmpty())
    <h1 class="title">Quests That Can Be Revised for More Points</h1>
        <table class="table" data-toggle="table">
            <thead>
                <tr>
                    <th data-field="name" 
                    data-sortable="true">Quest</th>
                    <th data-field="points" 
                    data-sortable="true">Points</th>
                    <th>Course</th>
                    <th data-field="expiration" 
                    data-sortable="true">Expires</th>
                </tr>            
            </thead>
                <tbody>
                @foreach($revisable as $q)
                            <tr>
                                <td>
                                    @if($q->quest_type_id == 1)
                                        <a href="{!! URL::to('quest/revise/response/'.$q->id) !!}">{!! $q->name !!}</a>            
                                    @endif
                                    @if($q->quest_type_id == 4)
                                        <a href="{!! URL::to('quest/revise/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                    @endif
                                    @if($q->quest_type_id == 5)
                                        <a href="{!! URL::to('quest/revise/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                    @endif
                                    @if($q->quest_type_id == 6)
                                        <a href="{!! URL::to('quest/revise/group/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                    @endif
                                    @if($q->quest_type_id == 7)
                                        <a href="{!! URL::to('quest/revise/group/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                    @endif
                                </td>
                                <td>
                                    {!! $q->skills()->sum('amount') !!}
                                </td>
                                <td>{!! $q->course->name !!}</td>
                                <td>
                                    @if($q->expires_at)
                                    {!! date('m-d-Y', strtotime($q->expires_at)) !!}
                                    @else
                                    Never
                                    @endif
                                </td>
                            </tr>
                @endforeach
                    </tbody>
                </table>
    @endif

    @if($locked)
    <h1 class="title">Quests Requiring Higher Skill Levels</h1>
        <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
            <thead>
                <tr>
                    <th data-field="name" 
                    data-sortable="true">Quest</th>
                    <th data-field="points" 
                    data-sortable="true">Points</th>
                    <th>Course</th>
                    <th data-field="expiration" 
                    data-sortable="true">Expires</th>
                </tr>            
            </thead>
            <tbody>
            @foreach($locked as $q)
                        <tr>
                            <td>
                                @if($q->quest_type_id == 1)
                                    <a href="{!! URL::to('quest/attempt/response/'.$q->id) !!}">{!! $q->name !!}</a>            
                                @endif
                                @if($q->quest_type_id == 2)
                                    {!! $q->name !!}
                                @endif
                                @if($q->quest_type_id == 3)
                                    <a href="{!! URL::to('quest/watch/'.$q->id) !!}">{!! $q->name !!}</a>                    
                                @endif
                                @if($q->quest_type_id == 4)
                                    <a href="{!! URL::to('quest/attempt/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 5)
                                    <a href="{!! URL::to('quest/attempt/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 6)
                                    <a href="{!! URL::to('quest/attempt/group/upload/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                                @if($q->quest_type_id == 7)
                                    <a href="{!! URL::to('quest/attempt/group/link/'.$q->id) !!}">{!! $q->name !!}</a>
                                @endif
                            </td>
                            <td>
                                {!! $q->skills()->sum('amount') !!}
                            </td>
                            <td>{!! $q->course->name !!}</td>
                            <td>
                                @if($q->expires_at)
                                {!! date('m-d-Y', strtotime($q->expires_at)) !!}
                                @else
                                Never
                                @endif
                            </td>
                        </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</section>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop