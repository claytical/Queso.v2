@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <h2>{!! $quest->name !!} Redemption Codes</h2>
	{{ link_to('manage/quest/'.$quest->id.'/qrcards', 'Print Cards', ['class' =>'btn btn-default btn-xs pull-right']) }}    
</div>
<div class="col-lg-12">
	 {!! Form::open(array('url' => 'manage/quest/qrcards')) !!}
	 {!! Form::hidden('quest_id', $quest->id) !!}
	 		<div class="form-group">
      			<label>Number of Codes to Generate</label>
            {{ Form::input('number', 'new_codes', null, ['class' => 'form-control', 'placeholder' => '0', 'id' => 'redemption_codes']) }}
                       <span class="input-group-btn">
					      {!! Form::submit('Generate', ['class' => 'btn btn-primary']) !!}
                        </span>            
            </div>
</div>
<h3>Unused Codes</h3>
<div class="col-md-12">
	@foreach($unused_codes as $code)
	  <div class="col-md-3">
	  <h5>{!! $code->code !!}</h5>
	  </div>
	@endforeach
</div>

<h3>Used Codes</h3>
<div class="col-md-12">
	@foreach($used_codes as $code)
	  <div class="col-md-3">
	  <h5>{!! $code->code !!}</h5>
	  <h6>{!! $code->user()->name !!}</h6>
	  </div>
	@endforeach
</div>
 

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop