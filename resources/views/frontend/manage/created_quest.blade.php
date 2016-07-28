@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
        <h2>Quest Name Created</h2>
        {{ link_to('manage/quest/create', 'Create New Quest', ['class' => 'btn btn-default btn-lg']) }}
        {{ link_to('manage/quest/clone', 'Clone This Quest', ['class' => 'btn btn-default btn-lg']) }}

</div>


@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop