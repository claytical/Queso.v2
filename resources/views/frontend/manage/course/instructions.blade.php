@extends('frontend.layouts.master')

@section('content')

    <div class="col-lg-12">
        <h2>Your Course Has Been Created!</h2>
        <p class="lead">All that's left is to invite the students and create some quests!</p>
        <h4>Quests</h4>
        <p>Nulla vitae elit libero, a pharetra augue. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Aenean lacinia bibendum nulla sed consectetur.</p>
        <h4>Resources</h4>
        <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas faucibus mollis interdum. Nullam quis risus eget urna mollis ornare vel eu leo.</p>
        <h4>Announcements</h4>
        <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Sed posuere consectetur est at lobortis. Aenean lacinia bibendum nulla sed consectetur. Maecenas faucibus mollis interdum. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>


    </div>
    <div class="col-lg-12">
        {{ link_to('dashboard', 'Go to Dashboard', ['class' => 'btn btn-default btn-block']) }}
    </div>
@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop