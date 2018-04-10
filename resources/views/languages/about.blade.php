@extends('layouts.master')
@section('header')
<h2>About this site</h2>
@stop
@section('content')
<p>There are over <?php echo $number_of_languages; ?> languages on this site.</p>
@stop