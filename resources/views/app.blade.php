<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patient Record System</title>
	
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<script src="{{ asset('/js/app.js') }}"></script>

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}" tabindex="-1">PRS</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}" tabindex="-1">Home</a></li>
					<li><a href="{{ url('/drp') }}" tabindex="-1">DRP</a></li>
					<li class="dropdown">
                        <a href="#" tabindex="-1" class="dropdown-toggle" data-toggle="dropdown">Statistic <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/statistic/pad') }}" tabindex="-1">PAD</a></li>
                            <li><a href="{{ url('/statistic/pad/med') }}" tabindex="-1">PAD Med</a></li>
                            <li><a href="{{ url('/statistic/apache_ii') }}" tabindex="-1">Apache II (By Type)</a></li>
                            <li><a href="{{ url('/statistic/apache_ii/year') }}" tabindex="-1">Apache II (By Year)</a></li>
                            <li><a href="{{ url('/statistic/apache_ii/outliner') }}" tabindex="-1">Apache II (Outliner)</a></li>
                        </ul>
                    </li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}" tabindex="-1">Login</a></li>
						<li><a href="{{ url('/auth/register') }}" tabindex="-1">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}" tabindex="-1">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
	@yield('content')
	</div>
	
	@yield('footer')
</body>
</html>
