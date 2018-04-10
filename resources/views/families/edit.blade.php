@extends('layouts.master')

@section('header')
<a href="{{url('/')}}">Back to overview</a>
<h2>
Update a Family
</h2>
@stop
@section('content')
	{!! Form::model($family, array('route' => array('families.update', $family->family_id), 'method' => 'PUT')) !!}
	{!! Form::model($family, ['url' => '/families/'. $family->family_id]) !!}
	{!! Form::label('name','Family Name');!!} {!! Form::text('family_name') !!} </p>
	{!! Form::label('description','Family Description');!!} {!! Form::text('family_description') !!}  </p>	
	</br>
	{!! Form::submit('Update Family', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop