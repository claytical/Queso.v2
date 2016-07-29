@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
        <h2>Quest Name Cloned</h2>
        {{ link_to('manage/quest/clone', 'Clone Again', ['class' => 'btn btn-default btn-lg']) }}
</div>


@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop