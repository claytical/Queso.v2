<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />

        <title>@yield('title', app_name())</title>

        @yield('meta')

        <!-- Styles -->
        @yield('before-styles-end')


        <!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Gentium+Basic|Open+Sans" rel="stylesheet">
        <!-- front loading scripts -->
    </head>
    <body>

		@section('content')
		
			<h2>{!! $quest->name !!} Redemption Codes</h2>

			@foreach($codes as $code)
				<div style="width: 30%; min-height: 200px">
					<h4>{!! $quest->name !!}</h4>
					<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=UMCCONBGUCQNR">
					<h5>{!! $code->code !!}</h5>
				</div>
			@endforeach

		@endsection

@section('after-scripts-end')
    </body>
</html>
@stop