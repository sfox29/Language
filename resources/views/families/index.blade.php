@extends('layouts.master')

@section('header')
@if (isset($family))
	<a href="{{ url('/')}}">Back to the overview</a>
@endif
<h2>
	<table class="top">
		<tr><td width="600px">	
	All Families</td><td>
		<a href="{{ url('families/create')}}" class="btn btn-primary pull-right">Add a new family</a>
		</td><td>&nbsp</td><td>
		<a href="{{ url('items')}}" class="btn btn-warning pull-right">List Items</a>
		</td><td>&nbsp</td><td>
		<a href="{{ url('languages')}}" class="btn btn-warning pull-right">List Languages</a>
		</td></tr></table>		
	</h2>
@stop
@section('content')
<table class="relative"><tr><th style="padding:2px; width:180px;">Family Name</th><th style="padding:2px; width:180px;">Family Description</th><th style="padding:2px; width:180px;">Count of Languages</th></tr>
@foreach ($families as $family)
<tr><td style="padding:2px; width:180px;"><a href="{{ url('families/'.$family->family_id)}}">
<strong>{{ $family->family_name}}</strong></a></td><td style="padding:2px; width:180px;">{{ $family->family_description}}</td><td style="padding:2px; width:180px;"> {{ $family->language_count}}</td></tr>		
@endforeach
</table>
@stop