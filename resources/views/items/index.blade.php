@extends('layouts.master')

@section('header')

<h2>
	
	<table class="top"><tr><td width="600px">
	All Items</td><td>
	<a href="{{ url('items/create')}}" class="btn btn-primary pull-right">Add a new item</a>
	</td><td>&nbsp</td><td>
	<a href="{{ url('languages')}}" class="btn btn-warning pull-right">List Languages</a>
	</td><td>&nbsp</td><td>
	<a href="{{ url('families')}}" class="btn btn-warning pull-right">List Families</a>
	</td></tr></table>		
</h2>
@stop
@section('content')
<div class="selectors">
{!! Form::open(array('action' => 'ItemsController@index', 'method' => 'get')) !!}
<table><tr><td>
<strong>Language</strong> {!! Form::select('select_language_id', [null =>' '] + $languages, $setLanguage, ['class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
</td><td>
<strong>Type</strong> {!! Form::select('select_item_type', [null =>' '] + $types, $setType, ['class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
</td><td>
<strong>Class</strong> {!! Form::select('select_item_class', [' ' =>' '] + $classes, $setClass, ['class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
</td><td>
<strong>Subclass</strong> {!! Form::select('select_item_subclass', [' ' =>' '] + $subclasses, $setSubclass, ['class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
</td><td>
<strong>Formclass</strong> {!! Form::select('select_item_formclass', [' ' =>' '] + $formclasses, $setFormclass, ['class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}</td><td>
<strong>TAM</strong> {!! Form::select('select_item_tam', [' ' =>' '] + $tams, $setTam, ['class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}</td>
</tr></table>
{!! Form::close() !!}
</div>
<div class="item">
<table class="item"><tr><th width="220px">Item</th><th width="120px">Class</th><th width="120px">Subclass</th><th width="120px">Formclass</th><th width="120px">TAM</th><th width="100px">Person</th><th width="100px">Gender</th><th width="100px">Number</th><th width="120px">Case</th><th width="100px">Polarity</th><th width="300px">Meaning</th><th width="150px">Language</th></tr>
@foreach ($items as $item)
<tr><td><a href="{{ url('items/'.$item->item_id)}}"><strong>{{ $item->item_lemma}}</strong></a></td>
<td>{{ $item->item_class}}</td>
<td>{{ $item->item_subclass}}</td>
<td>{{ $item->item_formclass}}</td>
<td>{{ $item->item_tam}}</td>
<td>{{ $item->item_person}}</td>
<td>{{ $item->item_gender}}</td>
<td>{{ $item->item_number}}</td>
<td>{{ $item->item_nomcase}}</td>
<td>{{ $item->item_polarity}}</td>
<td>{{ $item->item_meaning}}</td>
<td>{{ $item->language_name}}</td>
</tr>
@endforeach	
</table>
</div>

@stop