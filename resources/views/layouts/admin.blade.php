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
  </head>
  <body class="">
    <div class="page">
      <div class="flex-fill">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="/admin/home">
                <img src="{{ asset('/images/logo/thumbnail_logopanjang.png') }}" class="header-brand-img" alt="tabler logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
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
                    <a class="dropdown-item" href="{{ route('user_profile.index') }}">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('changepassword.index') }}">
                      <i class="dropdown-icon fe fe-settings"></i> Change Password
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
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                        <a href="/admin/home" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>
                <?php
                if ( $profile->role == '1' )
                {
                ?>
                    <li class="nav-item">
                        <a href="/admin/user-role" class="nav-link"><i class="fe fe-settings"></i> User Role</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/user-management" class="nav-link"><i class="fe fe-user"></i> User Management</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-database"></i> Master Data</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="/admin/province" class="dropdown-item ">Province</a>
                            <a href="/admin/city" class="dropdown-item ">City</a>
                            <a href="/admin/district" class="dropdown-item ">District</a>
                            <a href="/admin/subdistrict" class="dropdown-item ">SubDistrict</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-bar-chart"></i> Log Data</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="/admin/user_activity" class="dropdown-item ">User Activity</a>
                            <a href="/admin/user_network" class="dropdown-item ">User Network Info</a>
                        </div>
                    </li>
                <?php
                }
                ?>
                    <li class="nav-item">
                        <a href="/admin/posts" class="nav-link"><i class="fe fe-image"></i> Posts</a>
                    </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        @yield('content')

      <footer class="footer" id="footer" name="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="row align-items-center">
                <div class="col-auto">
                  <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="./docs/index.html">Documentation</a></li>
                    <li class="list-inline-item"><a href="./faq.html">FAQ</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © 2019 <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>&nbsp; All rights reserved.
            </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html>
