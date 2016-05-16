
@extends('layouts.frontend')
@section('title', 'Login')

@section('heading', 'Welcome, please login.')

@section('content')
<div class="login-form panel panel-default">
    <div class="panel-heading">Welcome, please login.</div>
    <div class="panel-body">
    {!! Form::open(array('route' => 'auth.login')) !!}

    <div class="form-group">
        {!! Form::label('email') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}

    <a href="{{ url('/frontend/forget') }}" class="small">Forgot password?</a>

    {!! Form::close() !!}
    </div>
</div>
@endsection
