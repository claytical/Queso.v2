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

        <style>
			@media print
			{    
			    .no-print, .no-print *
			    {
			        display: none !important;
			    }
			}

			h2,h4,h5 {
				font-family: Open Sans, sans;
			}

			div {
				width: 30%;
				min-height: 302px;
				float: left;
				font-family: Gentium Basic;
				padding: 5px; 
				margin: 5px; 
				border: 1px dotted;
				text-align: center;
			}


        </style>
        <!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Gentium+Basic|Open+Sans" rel="stylesheet">
        <!-- front loading scripts -->
    </head>
    <body>
			<h2 class="no-print">{!! $quest->name !!} Redemption Codes</h2>

			@foreach($codes as $code)
				<div>
					<h4>{!! $quest->name !!}</h4>
					<img src=" https://api.qrserver.com/v1/create-qr-code/?size=130x130&amp;data={!! $code->code !!}">
					<h5>{!! $code->code !!}</h5>
				</div>
			@endforeach
    </body>
</html>