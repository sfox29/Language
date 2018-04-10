<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8"/>
        <title>Languagebook</title>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/blogs.css')}}">
	</head>
    <body>
        <div class="container">
		@if (isset($username))<div class="username">Username: {{$username}} </div>@endif
		<div class="page-header">
			@yield('header') 
		</div>

			@yield('content')
        </div>
    </body>
</html>
