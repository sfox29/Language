@extends('layouts.blog')
@section('header')
<a href="{{url('/')}}">Back to overview</a>
<h2>
Create a Blog
</h2>
@stop
@section('content')
	<div class="relative">
	{!! Form::model($blog, ['url' => '/blogs/'. $blog->blog_id]) !!}
	<p>Blog Name: {!! Form::text('blog_name') !!} </p>
	<p>Blog Description: {!! Form::text('blog_description') !!}  </p>
	{!! Form::submit('Save Blog', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
	</div>
@stop