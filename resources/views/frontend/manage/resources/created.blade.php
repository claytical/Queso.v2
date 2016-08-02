@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <h2>Resource Created!</h2>
</div>
<p>Your resource is now available to students.</p>
@if($html)
	{{ $html }}
@endif

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop