<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token()}}">
        <title>@yield('title') &mdash; The Sunday Sim</title>       
        <script src="{{ theme('js/jquery.js') }}" type="text/javascript"></script>
        <script src="{{ theme('js/jquery-ui.js') }}" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="{{ theme('css/frontend.css') }}">
        <script src="{{ theme('js/bootstrap.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
$(document).ready(function() {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    });
});
        </script>
    </head>
    <body>
        @if(Auth::check())
        <div class="container-fluid con-main-dashboard">
            <div class="layout-container ng-scope container">
                <header class="profile-header">
                    <nav class="text-center">
                        <ul class="pull-left left-header menu-left">
                            <li class="mobile-menu-icon">
                                <a href="#"><img src="{{ theme('images/mobile-menu-icon-new.png') }}" alt=""/></a>
                            </li>
                            <li class="home">
                                <a href="{{url('/frontend/dashboard')}}"><img src="{{ theme('images/home.png') }}" alt=""/></a>
                            </li>
                            <li>
                                <img src="{{ theme('images/search.png') }}" alt=""/>
                            </li>
                        </ul>
                        <h1>Kansanääni</h1>
                        <ul class="pull-right right-header menu-right">
                            <li>
                                <img class="profile-img" style="height: 38px; width: 37px;" src="{{ url('/') . '/' . Auth::User()->user_image }}" alt=""/>
                                <span>{{ Auth::User()->first_name }}</span>    
                                <img class="header-check-img" src="{{ theme('images/header-check.png') }}" alt=""/>
                            </li>
                            <li>
                                <img class="ring-image" src="{{ theme('images/ring.png') }}" alt=""/>
                            </li>
                            <li>
                                <img class="people-images" src="{{ theme('images/people.png') }}" alt=""/>
                            </li>
                            <li>
                                <a href="{{url('frontend/profile')}}">
                                <?php
                                function first_letter($str) {
                                    $arr2 = array_filter(array_map('trim', explode(' ', $str)));
                                    $result = '';
                                    foreach ($arr2 as $v) {
                                        $result.=$v[0];
                                    }
                                    return $result;
                                }                                                                
                                echo first_letter(Auth::User()->name);
                                ?>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </header>
            </div>
        </div>
        @else 
        <header class="main-header">
            <div class="container">
                <nav class="navbar navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="{{url('/')}}" class="navbar-brand">
                            <img src="{{ theme('images/logo.png') }}" alt="kansanani-logo">
                            <span class="logo-text">Kansanääni</span>
                        </a>
                    </div>
                    <ul id="navbar" class="navbar-collapse collapse nav navbar-nav nav-list text-uppercase">
                        @include('partials.navigation')
                        <li class="<?php echo (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/kansanani/public/frontend/login') ? 'active': ''; ?>">
                            <a href="{{url('/auth/login')}}">
                                Login
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        @endif
        @yield('content')
        <footer class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text-center">
                        <h3>Say Hi & Get in Touch</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit suspendisse. </p>
                        <ul class="list-unstyled list-inline social-list">
                            <li>
                                <a href="#">
                                    <img src="{{ theme('images/twitter-icon.png') }}" alt="twitter-icon"/>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ theme('images/facebook-icon.png') }}" alt="facebook-icon"/>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ theme('images/pin-interest-icon.png') }}" alt="pin-interest-icon"/>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ theme('images/google-plus-icon.png') }}" alt="google-plus-icon"/>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ theme('images/linked-in-icon.png') }}" alt="linked-in-icon"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
