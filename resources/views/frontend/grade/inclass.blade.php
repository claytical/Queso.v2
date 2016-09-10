@extends('frontend.layouts.master')

@section('content')

<h2>In Class Activities</h2>
@if(!$quests->isEmpty())
    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
        <thead>
            <tr>
                <th data-field="name" 
            data-sortable="true">Quest</th>
                <th data-field="category" 
            data-sortable="true">Category</th>
                <th data-field="completion" 
            data-sortable="true">Completion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quests as $quest)
            <tr>
                <td>{{ link_to('grade/activity/'.$quest->id, $quest->name) }}</td>
                <td></td>
                <td>{!! $quest->users()->count() !!} / {!! $users !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="lead">There are no in class quests available.</p>
@endif
@endsection

@section('after-scripts-end')
    <script>

    </script>
@stop