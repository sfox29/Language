@extends('layouts.blog')
@section('header')
<a href="{{url('/blogs')}}">Back to overview</a>
<h2>
{{ $blog->blog_name }}	
</h2>
{{ $blog->blog_description }}
@stop
@section('content')
<div class="nav">
<img src="{{ URL::to('/') }}/img/sam.jpg" alt="Sam's picture" width="130" height="160"/>
<br/><br/>	
{!! Form::open(array('url' => 'blogs/' . $blog->blog_id . '/edit', 'class' => 'pull-left')) !!}
                  {!! Form::hidden('_method', 'GET') !!}
                  {!! Form::submit('Edit this Blog', array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
</br></br>
{!! Form::open(array('url' => 'blogs/' . $blog->blog_id, 'class' => 'pull-left')) !!}
                  {!! Form::hidden('_method', 'DELETE') !!}
                  {!! Form::submit('Delete this Blog', array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
</br></br>
{!! Form::open(array('url' => 'posts/create?blog_id=' . $blog->blog_id, 'class' => 'pull-left')) !!}
                  {!! Form::hidden('_method', 'GET') !!}
                  {!! Form::submit('Create a Post', array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
</div>
	<div class="relative">	
	<table class="relative">	
	@foreach ($posts as $post)
			<tr><td style="vertical-align:top; width:700px">
			<a href="{{ url('posts/'.$post->post_id)}}">
			<strong>{{ $post->post_name}}</strong></a> {{ $post->post_text}} <strong>Topic: </strong>{{ $post->post_topic}}</td></tr>
			<tr><td>&nbsp</td></tr>		
	@endforeach
</div>
@stop