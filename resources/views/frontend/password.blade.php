@extends('layouts.frontend')

@section('title', 'Forgot Password')

@section('heading', 'Please provide your e-mail to reset your password.')

@section('content')
<div class="login-form panel panel-default">

    <div class="panel-heading">Please provide your e-mail to reset your password.</div>
    <div class="panel-body">
        
   
    {!! Form::open() !!}

    <div class="form-group">
        {!! Form::label('email') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
</div>
@endsection
