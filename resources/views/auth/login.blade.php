<!-- resources/views/auth/login.blade.php -->
@extends('layouts.master')
@section('header')
<h2>
Log In
</h2>
@stop
@section('content')
{!! Form::open(array('url' => '/auth/login', 'method' => 'post')) !!}
{!! csrf_field() !!}
<table class="item"><tr><td>
{!! Form::label('email','Email');!!}</td><td> {!! Form::text('email') !!} </td>
</tr>
<tr><td>
{!! Form::label('password','Password');!!}</td><td> {!! Form::password('password') !!} </td>
</tr>
<tr><td>
{!! Form::label('rememberme','Remember Me');!!}</td><td> {!! Form::checkbox('remember') !!} </td>
</tr>
</table>
{!! Form::submit('Log In', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop