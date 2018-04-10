@extends('layouts.master')

@section('header')
<a href="{{url('/comments')}}">Back to overview</a>
<h2>
Update a Comment
</h2>
@stop
@section('content')
	<div class="relative">
	{!! Form::model($comment, array('route' => array('comments.update', $comment->comment_id), 'method' => 'PUT')) !!}
	{!! Form::model($comment, ['url' => '/comments/'. $comment->comment_id]) !!}
	<input type="hidden" name="comment_user_id" value="<?php echo $username;?>"/>
	<table class="item">
	<tr><td><strong>Comment Title</strong></td><td><input name="comment_title" value="<?php echo $comment->comment_title;?>"/></td></tr>
	<tr><td><strong>Text</strong></td><td><textarea name="comment_text" rows="4" cols="50"><?php echo $comment->comment_text; ?></textarea></td></tr>	
	<tr><td><strong>Post</strong></td><td>{!! Form::select('comment_post_id', $posts, $comment->comment_post_id, ['class' => 'form-control', 'style="width: 400px"']) !!}</td></tr>
	</table>
	</br>
	{!! Form::submit('Update Comment', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
	</div>
@stop