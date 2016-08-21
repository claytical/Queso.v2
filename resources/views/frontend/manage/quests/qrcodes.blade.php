@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
	{{ link_to('manage/quest/'.$quest->id.'/qrcards', 'Print Cards', ['class' =>'btn btn-default btn-lg pull-right', '_target' => 'blank']) }}    
    <h2>{!! $quest->name !!} Redemption Codes</h2>
</div>
<div class="col-md-12">
@if(!$unused_codes->isEmpty())	
	<h3>Unused Codes</h3>
	@foreach($unused_codes as $code)
	  <div class="col-md-3">
	  <h5>{!! $code->code !!}</h5>
	  </div>
	@endforeach
@endif
</div>

<div class="col-md-12">
@if(!$used_codes->isEmpty())
	<h3>Used Codes</h3>
	@foreach($used_codes as $code)
	  <div class="col-md-3">
	  <h5>{!! $code->code !!}</h5>
	  <h6>{!! $code->user()->name !!}</h6>
	  </div>
	@endforeach
@endif
</div>
 
<div class="col-lg-12">
	 {!! Form::open(array('url' => 'manage/quest/qrcodes')) !!}
	 {!! Form::hidden('quest_id', $quest->id) !!}
<h4>Generate Codes</h4>
	<div class="input-group">
    {{ Form::input('number', 'new_codes', null, ['class' => 'form-control', 'placeholder' => '0', 'id' => 'redemption_codes']) }}
               <span class="input-group-btn">
			      {!! Form::submit('Generate', ['class' => 'btn btn-primary']) !!}
                </span>            
    </div>
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop