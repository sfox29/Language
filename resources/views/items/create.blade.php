@extends('layouts.master')

@section('header')
<a href="{{url('/items')}}">Back to overview</a>
<h2>
Create an Item
</h2>
@stop
@section('content')
	{!! $errors->first('item_lemma') !!} 
	{!! $errors->first('item_type') !!} 
	{!! Form::model($item, ['url' => '/items/'. $item->item_id]) !!}
	<table class="item"><tr><td>
	{!! Form::label('lemma','Lemma');!!}</td><td colspan="3"> {!! Form::text('item_lemma') !!} <td>
	</tr>
	<tr><td>
	{!! Form::label('class','Class');!!}</td><td> {!! Form::text('item_class') !!} 
	</td><td>
	{!! Form::label('class','Subclass');!!}</td><td>  {!! Form::text('item_subclass') !!}
	</td></tr><tr><td>	
	{!! Form::label('formclass','Formclass');!!}</td><td>  {!! Form::text('item_formclass') !!}
	</td><td>
	{!! Form::label('tam','TAM');!!}</td><td>  {!! Form::text('item_tam') !!}
	</td></tr><tr><td>	
	{!! Form::label('person','Person');!!}</td><td>  {!! Form::text('item_person') !!}
	</td><td>	
	{!! Form::label('gender','Gender');!!}</td><td>  {!! Form::text('item_gender') !!}
	</td></tr><tr><td>	
	{!! Form::label('number','Number');!!} </td><td> {!! Form::text('item_number') !!}
	</td><td>	
	{!! Form::label('case','Case');!!}</td><td>  {!! Form::text('item_nomcase') !!} 
	</td></tr><tr><td>	
	{!! Form::label('polarity','Polarity');!!}</td><td>  {!! Form::text('item_polarity') !!}
	</td><td>
	{!! Form::label('meaning','Meaning');!!} </td><td colspan="3"> {!! Form::text('item_meaning') !!}
	</td></tr><tr><td>	
	{!! Form::label('notes','Notes');!!}</td><td colspan="3"> {!! Form::text('item_notes') !!}
	</td></tr><tr><td>	
	{!! Form::label('etymology','Etymology');!!}</td><td colspan="3">  {!! Form::text('item_etymology') !!}
	</td></tr><tr><td>	
	{!! Form::label('related_to','Related to');!!}</td><td colspan="3">  {!! Form::text('item_related_to') !!}
	</td></tr><tr><td>	
	{!! Form::label('Type','Type');!!}</td><td> {!! Form::select('item_type', $types, null, ['class' => 'form-control', 'style="width: 300px"']) !!}</td><td>
	{!! Form::label('language','Language');!!}</td><td> {!! Form::select('item_language_id', $languages, null, ['class' => 'form-control', 'style="width: 300px"']) !!}
	</td></tr></table>
	</br>
	{!! Form::submit('Save Item', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop