@extends('layouts.blog')
@section('header')
<a href="{{url('/posts')}}">Back to overview</a>
<h2>
{{ $post->post_name }}	
</h2>
@if (Session::has ('success'))<p>{{ Session::get('success')}}</p>@endif
@stop
@section('content')
<div class="nav">
<img src="{{ URL::to('/') }}/img/sam.jpg" alt="Sam's picture" width="130" height="150"/>
<br/>&nbsp<br/>
{!! Form::open(array('url' => 'posts/' . $post->post_id . '/edit', 'class' => 'pull-left')) !!}
				  {!! Form::hidden('_method', 'GET') !!}
                  {!! Form::submit('Edit this Post', array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
<br/>&nbsp<br/>&nbsp
{!! Form::open(array('url' => 'posts/' . $post->post_id, 'class' => 'pull-left')) !!}
                   {!! Form::hidden('_method', 'DELETE') !!}
                   {!! Form::submit('Delete this Post', array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
<br/>&nbsp<br/>
{!! Form::open(array('url' => 'comments/create?select_post_id=' . $post->post_id, 'class' => 'pull-left')) !!}
                   {!! Form::hidden('_method', 'GET') !!}
                   {!! Form::submit("Add a Comment", array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
<br/>&nbsp<br/>
{!! Form::open(array('url' => 'blogs/' . $post->post_blog_id, 'class' => 'pull-left')) !!}
                   {!! Form::hidden('_method', 'GET') !!}
                   {!! Form::submit("View this Blog", array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
</div>
<div class="relative">
	<p>{{ $post->post_text }} </p>
	@if($created_at > ' ')
	<p><strong>Created on:</strong> {{ $created_at }} <strong>by </strong>{{$post->post_user_id}}
	@endif	
 	@if ($post->post_blog_id)
		<strong>in blog:</strong> {{$blog_name}}</a>	
	@endif
	</p>
	<p><strong>Topic:</strong> {{ $post->post_topic }}</p>
	
	<table class="relative"><tr><th style="padding:2px; width:120px;">Comment Title</th><th style="padding:2px; width:180px;">Comment  Text</th></tr>
	@foreach ($comments as $comment)
	<tr><td><a href="{{ url('comments/'.$comment->comment_id)}}">
	<strong>{{ $comment->comment_title}}</strong></a></td><td width="520px">{{ $comment->comment_text}}</td></tr>		
	@endforeach
	</table>	
</div>	
@stop