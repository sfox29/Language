@extends('layouts.master')

@section('header')
<a href="{{url('/')}}">Back to overview</a>
<h2>
Create a Language
</h2>
@stop
@section('content')
	{!! Form::model($language, ['url' => '/languages/'. $language->language_id]) !!}
	<p>Language Name: {!! Form::text('language_name') !!} </p>
	<p>Language Description: {!! Form::text('language_description') !!}  </p>
	<div class="family">
	Language Family: &nbsp <select name="language_family_id">
	@foreach ($families as $family)		
			<option value="{{ $family->family_id }}">{{ $family->family_name }}</option>
	@endforeach
	</select>
	</div>
	<p></p>
	{!! Form::submit('Save Language', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop