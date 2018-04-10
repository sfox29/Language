@extends('layouts.master')

@section('header')
<a href="{{url('/')}}">Back to overview</a>
<h2>
Create a Family
</h2>
@stop
@section('content')
	{!! Form::model($family, ['url' => '/families/'. $family->family_id]) !!}
	<p>Family Name: {!! Form::text('family_name') !!} </p>
	<p>Family Description: {!! Form::text('family_description') !!}  </p>
	{!! Form::submit('Save Family', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop