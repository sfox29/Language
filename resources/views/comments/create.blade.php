@extends('layouts.master')

@section('header')
<a href="{{url('/comments')}}">Back to overview</a>
<h2>
Create a Comment
</h2>
@stop
@section('content')
	{!! $errors->first('comment_title') !!} 
	{!! $errors->first('comment_text') !!} 
	{!! Form::model($comment, ['url' => '/comments/'. $comment->comment_id]) !!}
	<input type="hidden" name="comment_user_id" value="<?php echo $username;?>"/>
	<table class="item">
	<tr><td><strong>Comment Title</strong></td><td><input name="comment_title" value="<?php echo $comment->comment_title;?>"/></td></tr>
	<tr><td><strong>Text</strong></td><td><textarea name="comment_text" rows="4" cols="50"><?php echo $comment->comment_text; ?></textarea></td></tr>	
	<tr><td><strong>Post</strong></td><td>{!! Form::select('comment_post_id', $posts, $postSelector, ['class' => 'form-control', 'style="width: 400px"']) !!}</td></tr>
	</table>
	</br>
	{!! Form::submit('Save Comment', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop