@extends('layouts.master')

@section('header')
@if (isset($comment))
	<a href="{{ url('/posts')}}">Back to the overview</a>
@endif
<h2>
	<table class="top"><tr><td width="600px">
	
	All @if (isset($post)) {{ $post->post_name}} @endif Comments</td><td>
		<a href="{{ url('comments/create')}}" class="btn btn-primary pull-right">Add a new comment</a>
		</td><td>&nbsp</td><td>
		<a href="{{ url('posts')}}" class="btn btn-warning pull-right">List Posts</a>
		</td><td>&nbsp</td><td>
		<a href="{{ url('blogs')}}" class="btn btn-warning pull-right">List Blogs</a>
		</td></tr></table>		
	</h2>
@stop
@section('content')
<div class="relative">
<table class="item"><tr><th style="padding:2px; width:180px;">Comment Title</th><th style="padding:2px; width:180px;">Comment  Text</th><th style="text-align:right">Post</tr>
@foreach ($comments as $comment)
<tr><td><a href="{{ url('comments/'.$comment->comment_id)}}">
<strong>{{ $comment->comment_title}}</strong></a></td><td width="620px">{{ $comment->comment_title}}</td><td style="text-align:right;">{{($comment->post_name) }}</td></tr>		
@endforeach
</table>
</div>
@stop