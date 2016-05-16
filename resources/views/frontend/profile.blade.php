@extends('layouts.frontend')
@section('title', 'Dashboard')
@section('content')

<div class="container content-main">
    @include('partials.frontendsidebar')
    <main class="main-container-document">
        <div class="row" style="min-height: 500px;">
            <div>
                <a href="{{url('frontend/profile/edit')}}">Edit Profile</a>
            </div>
            <div>
                <a href="{{url('auth/logout')}}">Logout</a>
            </div>
        </div>
    </main>
</div>
@endsection
