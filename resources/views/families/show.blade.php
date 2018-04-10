@extends('layouts.master')
@section('header')
<a href="{{url('/families')}}">Back to overview</a>
<h2>
{{ $family->family_name }}	
</h2>
<table class="buttons"><tr><td>
{!! Form::open(array('url' => 'families/' . $family->family_id . '/edit', 'class' => 'pull-left')) !!}
                  {!! Form::hidden('_method', 'GET') !!}
                  {!! Form::submit('Edit this Family', array('class' => 'btn btn-warning')) !!}
{!! Form::close() !!}
</td><td>&nbsp</td><td>
{!! Form::open(array('url' => 'families/' . $family->family_id, 'class' => 'pull-left')) !!}
                  {!! Form::hidden('_method', 'DELETE') !!}
                  {!! Form::submit('Delete this Family', array('class' => 'btn btn-warning')) !!}
{!! Form::close() !!}
</td></tr></table>
@stop
@section('content')
<div class="top">
	<strong>Family Name: </strong>{{ $family->family_name }} </br>
	<strong>Family Description: </strong>{{ $family->family_description }} </br></br>
</div>	
	<div class="relative">	
	<table class="relative"><tr><th style="width:180px">Language Name</th><th style="width:450px">Language Description</th><th style="width:120px; text-align:right;">Number of Speakers</th></tr>		
	@foreach ($languages as $language)
			<tr><td>
			<a href="{{ url('languages/'.$language->language_id)}}">
			<strong>{{ $language->language_name}}</strong></td><td> {{ $language->language_description}}</a></td><td style="text-align:right;">{{ number_format($language->language_speakers) }}</td></tr>
		
	@endforeach
</div>
@stop