@extends('layouts.master')

@section('header')
<a href="{{url('/')}}">Back to overview</a>
<h2>
Update a Language
</h2>
@stop
@section('content')
	{!! Form::model($language, array('route' => array('languages.update', $language->language_id), 'method' => 'PUT')) !!}
	{!! Form::model($language, ['url' => '/languages/'. $language->language_id]) !!}
	{!! Form::label('name','Language Name');!!} {!! Form::text('language_name') !!} </p>
	{!! Form::label('description','Language Description');!!} {!! Form::text('language_description') !!}  </p>	
	{!! Form::label('numberofspeakers', 'Number of Speakers'); !!} {!! Form::number('language_speakers')!!}</p>
	{!! Form::label('family','Family');!!} {!! Form::select('language_family_id', $families, $language->language_family_id, ['class' => 'form-control', 'style="width: 400px"']) !!}
	</br>
	{!! Form::submit('Update Language', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop