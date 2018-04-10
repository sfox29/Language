@extends('layouts.blog')
@section('header')
<a href="{{url('/posts/' . $comment->comment_post_id)}}">Back to Post</a>
<h2>
{{ $comment->comment_title }}	
</h2>
@stop
@section('content')
<div class="nav">
<img src="{{ URL::to('/') }}/img/sam.jpg" alt="Sam's picture" width="130" height="150"/>
<br/>&nbsp<br/>
{!! Form::open(array('url' => 'comments/' . $comment->comment_id . '/edit', 'class' => 'pull-left')) !!}
				  {!! Form::hidden('_method', 'GET') !!}
                  {!! Form::submit('Edit this Comment', array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
<br/>&nbsp<br/>
{!! Form::open(array('url' => 'comments/' . $comment->comment_id, 'class' => 'pull-left')) !!}
                   {!! Form::hidden('_method', 'DELETE') !!}
                   {!! Form::submit('Delete this Comment', array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
<br/>&nbsp<br/>
{!! Form::open(array('url' => 'posts/' . $comment->comment_post_id, 'class' => 'pull-left')) !!}
                   {!! Form::hidden('_method', 'GET') !!}
                   {!! Form::submit("View this Post", array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
</div>
<div class="relative">
	<p>{{ $comment->comment_text }} </p>	
</div>	
@stop