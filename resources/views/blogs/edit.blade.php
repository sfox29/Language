@extends('layouts.blog')
@section('header')
<a href="{{url('/blogs')}}">Back to overview</a>
<h2>
Update a Blog
</h2>
@stop
@section('content')
	<div class="relative">
	{!! Form::model($blog, array('route' => array('blogs.update', $blog->blog_id), 'method' => 'PUT')) !!}
	{!! Form::model($blog, ['url' => '/blogs/'. $blog->blog_id]) !!}
	{!! Form::label('name','Blog Name');!!} {!! Form::text('blog_name') !!} </p>
	{!! Form::label('description','Blog Description');!!} {!! Form::text('blog_description') !!}  </p>	
	</br>
	{!! Form::submit('Update Blog', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
	</div>
@stop