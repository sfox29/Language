@extends('layouts.blog')
@section('header')
@if (isset($blog))
	<a href="{{ url('/')}}">Back to the overview</a>
@endif
<h2>All @if (isset($blog)) {{ $blog->blog_name}} @endif Posts</h2>
@stop
@section('content')
<div class="nav">
<img src="{{ URL::to('/') }}/img/sam.jpg" alt="Sam's picture" width="130" height="160"/>
<br/><br/>	
<a href="{{ url('posts/create')}}" class="btn btn-primary pull-right">Add a new post</a>
<br/><br/>
<a href="{{ url('comments')}}" class="btn btn-success pull-right">List Comments</a>
<br/><br/>
<a href="{{ url('blogs')}}" class="btn btn-success pull-right">List Blogs</a>
</div>	
<div class="relative">
<table class="item"><tr><th style="padding:2px; width:180px;">Post Name</th><th style="padding:2px; width:180px;">Post Text</th><th style="text-align:right">Topic</tr>
@foreach ($posts as $post)
<tr><td><a href="{{ url('posts/'.$post->post_id)}}">
<strong>{{ $post->post_name}}</strong></a></td><td width="620px">{{ $post->post_text}}</td><td style="text-align:right;">{{($post->post_topic) }}</td></tr>		
@endforeach
</table>
</div>
@stop