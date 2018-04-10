<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8"/>
        <title>Languagebook</title>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/languages.css')}}">
	</head>
    <body>
        <div class="container">
		@if (isset($username))<div class="username">Username: {{$username}} </div>@endif
		<div class="page-header">
			@yield('header') 
		</div>
		@if (Session::has ('success'))
		<div class="alert alert-success">
			{{ Session::get('success')}}
			</div>
			@endif
			@yield('content')
        </div>
    </body>
</html>
