@extends('layouts.master')

@section('header')
<a href="{{url('/')}}">Back to overview</a>
<h2>
Create a Language
</h2>
@stop
@section('content')
	{!! $errors->first('language_name') !!} 
	{!! $errors->first('language_speakers') !!} 
	{!! Form::model($language, ['url' => '/languages/'. $language->language_id]) !!}
	{!! Form::label('name','Language Name');!!} {!! Form::text('language_name') !!} </p>
	{!! Form::label('description','Language Description');!!} {!! Form::text('language_description') !!}  </p>	
	{!! Form::label('numberofspeakers', 'Number of Speakers'); !!} {!! Form::number('language_speakers')!!}</p>
	{!! Form::label('family','Family');!!} {!! Form::select('language_family_id', $families, null, ['class' => 'form-control', 'style="width: 400px"']) !!}
	</br>
	{!! Form::submit('Save Language', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop