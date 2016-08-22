@extends('frontend.layouts.master')

@section('content')

    <div class="col-lg-12">
        <h2>Your Course Has Been Created!</h2>
        <p class="lead">All that's left is to invite the students and create some quests!</p>
        <h4>Quests</h4>
        <p>Some people call them assignments, we call them quests. From the management page, you can create new quests for your students to complete.</p>
        <h4>Resources</h4>
        <p>Have something to share with students? Resources will be added to the sidebar as you create them. If you consolidate multiple resources into a category, they'll be aggregated.</p>
        <h4>Announcements</h4>
        <p>Want to let your students know what's happening? Announcements go straight to the dashboard.</p>


    </div>
    <div class="col-lg-12">
        {{ link_to('dashboard', 'Go to Dashboard', ['class' => 'btn btn-default btn-block']) }}
    </div>
@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop