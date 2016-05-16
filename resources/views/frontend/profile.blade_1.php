@extends('layouts.frontend')
@section('title', 'Profile')
@section('content')
<div>
    <div>
        <div>
           
        </div>
        <div>
            {{Auth::User()->name}}
            <a href="{{url('frontend/profile/edit')}}">Edit Profile</a>
        </div>
        <div>
            Logout
            <a href="{{url('auth/logout')}}">Logout</a>
        </div>
    </div>
</div>
@endsection
