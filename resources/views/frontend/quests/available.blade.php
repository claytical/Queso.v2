@extends('frontend.layouts.master')

@section('content')
<h2>Available Quests</h2>

        <div class="col-lg-12">

        @foreach($unlocked as $quest)
            <div class="row">
                <div class="col-lg-12">
                    @if($quest->quest_type_id == 1)
                        <h4>{{ link_to('quest/'.$quest->id.'/attempt/submission', $quest->name) }}</h4>
                    @endif
                    @if($quest->quest_type_id == 2)
                        <h4>{{ $quest->name }}</h4>
                    @endif
                    @if($quest->quest_type_id == 3)
                        <h4>{{ link_to('quest/'.$quest->id.'/watch', $quest->name) }}</h4>
                    @endif

                    @if($quest->quest_type_id == 4)
                        <h4>{{ link_to('quest/'.$quest->id.'/attempt/link', $quest->name) }}</h4>
                    @endif
                    <h5>{!! $quest->skills()->sum('amount') !!} Points, Due by ....</h5>
                </div>
                <div class="col-lg-12">
                    <p>{!! $quest->instructions !!}</p>
                </div>
            </div>
        @endforeach
        </div>
<h2>Locked Quests</h2>
        <div class="col-lg-12">

            @foreach($locked as $quest)
                <div class="row">
                    <div class="col-lg-12">
                            <h4>{{ $quest->name }}</h4>
                            <h5>{!! $quest->skills()->sum('amount') !!} Points</h5>

                    </div>
                    <div class="col-lg-12">
                        <p>{!! $quest->instructions !!}</p>
                    </div>
                </div>
            @endforeach
        </div>

<h2>Quests That Can Be Revised for More Points</h2>
    
    <div class="col-lg-12">
        @foreach($revisable as $quest)

            <div class="row">
                <div class="col-lg-9">
                    <h4>{{ link_to('quest/'.$quest->id.'/revise', $quest->name) }}</h4>
                    <h5>{!! $quest->skills()->sum('amount') !!} Points, Due by 00/00/000</h5>
                </div>
                <div class="col-lg-12">
                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop