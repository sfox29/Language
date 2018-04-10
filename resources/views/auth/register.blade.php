<!-- resources/views/auth/register.blade.php -->
@extends('layouts.master')
@section('header')
<h2>
Register a User
</h2>
@stop
@section('content')
{!! Form::open(array('url' => '/auth/register', 'method' => 'post')) !!}
{!! csrf_field() !!}
<table class="item"><tr><td>
{!! Form::label('username','Username');!!}</td><td> {!! Form::text('username') !!} </td>
</tr>
<tr><td>
{!! Form::label('email','Email');!!}</td><td> {!! Form::text('email') !!} </td>
</tr>
<tr><td>
{!! Form::label('password','Password');!!}</td><td> {!! Form::password('password') !!} </td>
</tr>
<tr><td>
{!! Form::label('confirmpassword','Confirm Password');!!}</td><td> {!! Form::password('password_confirmation') !!} </td>
</tr>
</table>
{!! Form::submit('Register User', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop	