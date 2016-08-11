@extends('frontend.layouts.master')

@section('content')
<h2>Progress</h2>

        <div class="col-lg-12">

            @foreach($quests as $quest)
                <div class="row">
                    <h4>{!! $quest['quest']->name !!} </h4>
                    <h5>Submitted {!! $quest['quest']->created_at !!}</h5>
                    {!! $quest['quest']->instructions !!}

                    @if($quest['revisions'])
                    <h6>Revisions</h6>
                        <ul>
                        @foreach($quest['revisions'] as $revision)
                            <li>{!! $revision->created_at !!}</li>
                        @endforeach
                        </ul>
                    @endif


                    <h6>00/00 Points <span class="label label-primary">Type / Revisable</span></h6>
                    <a class="btn btn-default pull-right" href="#" role="button">View</a>
                </div>
            @endforeach
 
         </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop