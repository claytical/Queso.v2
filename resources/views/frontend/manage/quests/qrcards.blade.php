@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <h2>[QUEST] Redemption Codes{{ link_to('manage/quest/1/qrcards', 'Print Cards', ['class' =>'btn btn-default btn-xs pull-right']) }}</h2>
</div>

<div class="col-lg-3">
	<h4>QUEST NAME</h4>
	<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=UMCCONBGUCQNR">
</div>
<div class="col-lg-3">
	<h4>QUEST NAME</h4>
	<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=UMCCONBGUCQNR">
</div>
<div class="col-lg-3">
	<h4>QUEST NAME</h4>
	<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=UMCCONBGUCQNR">
</div>
<div class="col-lg-3">
	<h4>QUEST NAME</h4>
	<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=UMCCONBGUCQNR">
</div>
<div class="col-lg-3">
	<h4>QUEST NAME</h4>
	<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=UMCCONBGUCQNR">
</div>
<div class="col-lg-3">
	<h4>QUEST NAME</h4>
	<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=UMCCONBGUCQNR">
</div>
<div class="col-lg-3">
	<h4>QUEST NAME</h4>
	<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=UMCCONBGUCQNR">
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop