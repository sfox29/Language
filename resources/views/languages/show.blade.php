@extends('layouts.master')
<style>
div.relative {
    position: relative;
    left: 50px;
}
div.top {
    font-size: 16px;
}
</style>
@section('header')
<a href="{{url('/')}}">Back to overview</a>
<h2>
{{ $language->language_name }}	
</h2>
<table><tr><td>
{!! Form::open(array('url' => 'languages/' . $language->language_id . '/edit', 'class' => 'pull-left')) !!}
                   {!! Form::hidden('_method', 'GET') !!}
                  {!! Form::submit('Edit this Language', array('class' => 'btn btn-warning')) !!}
{!! Form::close() !!}
</td><td>&nbsp</td><td>
{!! Form::open(array('url' => 'languages/' . $language->language_id, 'class' => 'pull-left')) !!}
                   {!! Form::hidden('_method', 'DELETE') !!}
                   {!! Form::submit('Delete this Language', array('class' => 'btn btn-warning')) !!}
{!! Form::close() !!}
</td>
<td>&nbsp</td><td>
{!! Form::open(array('url' => 'items', 'method' => 'get', 'class' => 'pull-left')) !!}
{!! Form::hidden('select_language_id', $language->language_id) !!}
{!! Form::submit("Show this Language's Items", array('class' => 'btn btn-warning')) !!}
{!! Form::close() !!}
</td></tr></table>
@stop
<div class="top">
@section('content')
	<p>Language Name: {{ $language->language_name }} </p>
	<p>Language Description: {{ $language->language_description }} </p>
	<p>Number of Speakers: {{ number_format($language->language_speakers) }}</p>
	
 	@if ($language->language_family_id)
		Family: {{$family_name}}</a>	
	@endif
	</p>
</div>	
@stop