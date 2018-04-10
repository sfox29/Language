@extends('layouts.blog')
@section('header')
@if (isset($blog))
	<a href="{{ url('/')}}">Back to the overview</a>
@else
	</br>
@endif
<h2>All Blogs</h2>
@stop
@section('content')
<div class="nav">
<a href="{{ url('blogs/create')}}" class="btn btn-primary pull-left">Add a new blog</a>
<br/><br/>
<a href="{{ url('posts')}}" class="btn btn-success pull-left">List Posts</a>
</div>
<div class="relative">
<table class="item"><tr><th style="padding:2px; width:180px;">Blog Name</th><th style="padding:2px; width:180px;">Blog Description</th><th style="padding:2px; width:180px;">Count of Posts</th></tr>
@foreach ($blogs as $blog)
<tr><td style="padding:2px; width:180px;"><a href="{{ url('blogs/'.$blog->blog_id)}}">
<strong>{{ $blog->blog_name}}</strong></a></td><td style="padding:2px; width:180px;">{{ $blog->blog_description}}</td><td style="padding:2px; width:180px;"> {{ $blog->post_count}}</td></tr>		
@endforeach
</table>
</div>
@stop