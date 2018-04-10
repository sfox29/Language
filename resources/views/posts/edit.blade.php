@extends('layouts.blog')
@section('header')
<a href="{{url('/posts')}}">Back to overview</a>
<h2>
Update a Post
</h2>
@stop
@section('content')
	<div class="relative">
	{!! Form::model($post, array('route' => array('posts.update', $post->post_id), 'method' => 'PUT')) !!}
	{!! Form::model($post, ['url' => '/posts/'. $post->post_id]) !!}
	<input type="hidden" name="post_user_id" value="<?php echo $username;?>"/>
	<table class="item">
	<tr><td><strong>Post Name</strong></td><td><input name="post_name" value="<?php echo $post->post_name;?>"/></td></tr>
	<tr><td><strong>Text</strong></td><td><textarea name="post_text" rows="8" cols="90"><?php echo $post->post_text; ?></textarea></td></tr>	
	<tr><td><strong>Topic</strong></td><td><input name="post_topic" value="<?php echo $post->post_topic;?>"/></td></tr>
	<tr><td><strong>Blog</strong></td><td>{!! Form::select('post_blog_id', $blogs, $post->post_blog_id, ['class' => 'form-control', 'style="width: 400px"']) !!}</td></tr>
	</table>	
	</br>
	{!! Form::submit('Update Post', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
	</div>
@stop