@extends('layouts.master')

@section('header')
@if (isset($family))
	<a href="{{ url('/')}}">Back to the overview</a>
@endif
<h2>
	<table class="top"><tr><td width="600px">
	
	All @if (isset($family)) {{ $family->family_name}} @endif Languages</td><td>
		<a href="{{ url('languages/create')}}" class="btn btn-primary pull-right">Add a new language</a>
		</td><td>&nbsp</td><td>
		<a href="{{ url('items')}}" class="btn btn-warning pull-right">List Items</a>
		</td><td>&nbsp</td><td>
		<a href="{{ url('families')}}" class="btn btn-warning pull-right">List Families</a>
		</td></tr></table>		
	</h2>
@stop
@section('content')
<table class="item"><tr><th style="padding:2px; width:180px;">Language Name</th><th style="padding:2px; width:180px;">Language Description</th><th style="text-align:right">Number of Speakers</tr>
@foreach ($languages as $language)
<tr><td><a href="{{ url('languages/'.$language->language_id)}}">
<strong>{{ $language->language_name}}</strong></a></td><td width="620px">{{ $language->language_description}}</td><td style="text-align:right;">{{ number_format($language->language_speakers) }}</td></tr>		
@endforeach
</table>
@stop