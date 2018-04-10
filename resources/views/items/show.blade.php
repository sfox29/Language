@extends('layouts.master')

@section('header')
<table class="selectors"><tr><td>
{!! Form::open(array('action' => 'ItemsController@index', 'method' => 'get', 'class' => 'pull-right')) !!}
	                  {!! Form::submit('List Items', array('class' => 'btn btn-primary')) !!}
	{!! Form::close() !!}
</td><td>&nbsp</td><td>
{!! Form::open(array('url' => 'items/' . $item->item_id . '/edit', 'class' => 'pull-right')) !!}
                   {!! Form::hidden('_method', 'GET') !!}
                  {!! Form::submit('Edit this Item', array('class' => 'btn btn-warning')) !!}
{!! Form::close() !!}
</td><td>&nbsp</td><td>
{!! Form::open(array('url' => 'items/' . $item->item_id, 'class' => 'pull-right')) !!}
                   {!! Form::hidden('_method', 'DELETE') !!}
                   {!! Form::submit('Delete this Item', array('class' => 'btn btn-warning')) !!}
{!! Form::close() !!}
</td></tr></table>
@stop
@section('content')
<div class="top">
<table class="item"><tr><td><strong>Lemma:</strong> {{ $item->item_lemma }}</td><td><strong>Id: </strong>{{ $item->item_id}}</tr>
<tr><td width="280px"><strong>Class: </strong>{{ $item->item_class }}</td><td width="280px"><strong>Subclass:</strong> {{ $item->item_subclass }}</td></tr>
<tr><td><strong>Form Class:</strong> {{ $item->item_formclass }}</td><td>&nbsp</td></tr>
	@if ( $item->item_class == 'noun')<tr style="display: none">
		@else <tr>
			@endif
<td><strong>TAM:</strong> {{ $item->item_tam }}</td><td><strong>Person:</strong> {{ $item->item_person }}</td></tr><tr><td><strong>Gender:</strong> {{ $item->item_gender }}</td>
<td><strong>Number:</strong> {{ $item->item_number }}</td></tr><tr><td><strong>Case:</strong> {{ $item->item_nomcase }}</td><td><strong>Polarity:</strong> {{ $item->item_polarity }}</td></tr>
<tr><td colspan="2"><strong>Meaning: </strong> {{ $item->item_meaning }}</td></tr>
<tr><td colspan="2"><strong>Notes: </strong> {{ $item->item_notes }}</td></tr>
<tr><td colspan="2"><strong>Etymology: </strong> {{ $item->item_etymology }}</td></tr>
<tr><td colspan="2"><strong>Related to: </strong> {{ $item->item_related_to }}</td></tr>
<tr><td>	
 	@if ($item->item_language_id)
	<strong>Language: </strong>{{$language_name}}</a>	
	@endif
	</td><td>
 	@if ($item->item_type)
		@if ($item->item_type == 1)
			<strong>Type: </strong>Lexical Item
		@endif
		@if ($item->item_type == 2)
			<strong>Type: </strong>Pattern
		@endif
	@endif
	</td></tr></table>
</div>
@stop
