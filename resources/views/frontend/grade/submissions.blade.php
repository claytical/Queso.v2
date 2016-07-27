@extends('frontend.layouts.master')

@section('content')
<h2>Ungraded Submissions</h2>

        <div class="col-lg-12">
            <ul class="list-unstyled list">
                <li>
                    <h4>{{ link_to('quest/1/attempt/submission', 'Submission Quest') }}</h4>                  
                    <p>Submitted 00/00/0000 by Student Name</p>
                </li>

                <li>
                    <h4>{{ link_to('quest/1/attempt/submission', 'Link Quest') }}</h4>                  
                    <p>Submitted 00/00/0000 by Student Name</p>
                </li>

                <li>
                    <h4>{{ link_to('quest/1/attempt/submission', 'Feedback Quest') }}</h4>                  
                    <p>Submitted 00/00/0000 by Student Name</p>
                </li>

            </ul>
        </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop