
@extends('layouts.frontend')
@section('title', 'Login')

@section('heading', 'Welcome, please login.')

@section('content')
@if (count($errors) > 0)
<ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
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

        <a href="{{ route('auth.password.email') }}" class="small">Forgot password?</a>

        {!! Form::close() !!}
    </div>
</div>
@endsection
