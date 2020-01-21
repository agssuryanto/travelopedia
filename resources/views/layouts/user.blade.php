@if(Session::has('token') && Session::has('profile'))
@else
  <?php header('Location: http://localhost:8000/admin/login'); die(); ?>
@endif

<?php
  $profile = Session::get('profile');
?>

<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('/images/logo/thumbnail_logoaja.png') }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="{{ asset('/assets/js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/popper.js') }}"></script>
    <script src="{{ asset('/assets/js/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootbox.min.js') }}"></script>
    <script src="{{ asset('/assets/js/require.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/plugin.js') }}"></script>
    <script src="{{ asset('/assets/js/cookies_utillity.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/travel.css') }}">
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="{{ asset('/assets/css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ asset('/assets/js/dashboard.js') }}"></script>
    <!-- c3.js Charts Plugin -->
    <link href="{{ asset('/assets/plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('/assets/plugins/charts-c3/plugin.js') }}"></script>
    <!-- Google Maps Plugin -->
    <link href="{{ asset('/assets/plugins/maps-google/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('/assets/plugins/maps-google/plugin.js') }}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{ asset('/assets/plugins/input-mask/plugin.js') }}"></script>
    <!-- Datatables Plugin -->
    <script src="{{ asset('/assets/plugins/datatables/plugin.js') }}"></script>

    <style>
      #map {
        height: 80%;
      }
    </style>

  </head>
  <body class="">
    <div class="page">
      <div class="flex-fill">
        <div class="header">
          <div class="container">
            <div class="d-flex">
                    <div class="pt-2">
                        <a class="header-brand" href="{{ config('app.url') }}/user/home">
                            <img src="{{ asset('/images/logo/thumbnail_logoaja.png') }}" class="header-brand-img" alt="Travelomedia">
                            Travelomedia
                        </a>
                    </div>
                    <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                        <li class="nav-item">
                            <a href="{{ config('app.url') }}/user/home" class="nav-link"><i class="fe fe-home"></i> Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="./form-elements.html" class="nav-link"><i class="fe fe-check-square"></i> Top Destination</a>
                        </li>
                        <li class="nav-item">
                            <a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Recommended Places</a>
                        </li>
                        <li class="nav-item">
                            <a href="/contact" class="nav-link"><i class="fe fe-phone"></i> Contact Us</a>
                        </li>
                    </ul>
              <div class="d-flex order-lg-2 ml-auto pt-2">
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                        <?php
                            $avatar = ( $profile->avatar != '' ) ? $profile->avatar : config('app.url').'/assets/images/user.png' ;
                        ?>
                        <span class="avatar" style="background-image: url(<?php echo $avatar; ?>)"></span>
                        <span class="ml-2 d-none d-lg-block">
                            <span class="text-default">{{ $profile->name }}</span>
                            <small class="text-muted d-block mt-1"><div id="role" name="role"></div></small>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('changepassword.index') }}">
                            <i class="dropdown-icon fe fe-settings"></i> Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon fe fe-clock"></i> Action History
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout.index') }}">
                            <i class="dropdown-icon fe fe-log-out"></i> Sign out
                        </a>
                    </div>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>

        @yield('content')

    </div>
  </body>
</html>
